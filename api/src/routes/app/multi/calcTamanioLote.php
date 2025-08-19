<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use BatchRecord\dao\calcTamanioMultiDao;
use BatchRecord\dao\ProductsDao;
use BatchRecord\dao\PlanPedidosDao;
use BatchRecord\dao\PlanPrePlaneadosDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// Crear una clase que implemente el método que necesitamos
class MultiDaoApp {
    
    public function __construct() {
        // Constructor simple sin dependencias
    }
    
    public function findProductMultiByRef($referencia) {
        $connection = \BatchRecord\dao\Connection::getInstance()->getConnection();
        
        $sql = "SELECT p.referencia, p.densidad_producto as densidad, linea.ajuste, pc.nombre as presentacion 
                FROM producto p 
                INNER JOIN linea ON p.id_linea = linea.id 
                INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id 
                WHERE p.referencia = :referencia;";
        $query = $connection->prepare($sql);
        $query->execute(['referencia' => $referencia]);
        $dataProduct = $query->fetch($connection::FETCH_ASSOC);
        return $dataProduct;
    }
}

$multiDao = new MultiDaoApp();
$calcTamanioMultiDao = new calcTamanioMultiDao();
$productsDao = new ProductsDao();
$planPedidosDao = new PlanPedidosDao();
$planPrePlaneadosDao = new PlanPrePlaneadosDao();

$app->post('/calcTamanioLote', function (Request $request, Response $response, $args) use ($multiDao, $calcTamanioMultiDao, $productsDao, $planPedidosDao, $planPrePlaneadosDao) {
  $dataPedidos = $request->getParsedBody();
  $dataPedidos = $dataPedidos['data'];
  session_start();

  // Almacena las cantidades registradas por pedido y referencia individualmente
  // Consolidar referencias
  /*
  $dataPedidosReferencias = array();

  foreach ($dataPedidos as $t) {
    $repeat = false;
    for ($i = 0; $i < count($dataPedidosReferencias); $i++) {
      if ($dataPedidosReferencias[$i]['referencia'] == $t['referencia']) {
        $dataPedidosReferencias[$i]['numPedido'] = "{$dataPedidosReferencias[$i]['numPedido']} - {$t['numPedido']}";
        $dataPedidosReferencias[$i]['cantidad_acumulada'] += $t['cantidad_acumulada'];
        $dataPedidosReferencias[$i]['fecha_insumo'] = "{$dataPedidosReferencias[$i]['fecha_insumo']} - {$t['fecha_insumo']}";
        $repeat = true;
        break;
      }
    }
    if ($repeat == false)
      $dataPedidosReferencias[] = array(
        'granel' => $t['granel'],
        'numPedido' => $t['numPedido'],
        'referencia' => $t['referencia'],
        'producto' => $t['producto'],
        'cantidad_acumulada' => $t['cantidad_acumulada'],
        'fecha_insumo' => $t['fecha_insumo']
      );
  }

  // Eliminar granel donde tamanio_lote sea mayor a 2500
  for ($i = 0; $i < sizeof($dataPedidos); $i++) {
    if ($dataPedidos[$i]['tamanio_lote'] > 2500) {
      $planPedidosDao->checkPedidos($dataPedidos[$i]); // Cambiar estado a 2
      // Capturar data de lotes programados, para mostrar en la ventana de calculo
      $dataPedidosLotes[$i] = $dataPedidos[$i];
      unset($dataPedidos[$i]);
    }
  }

  // Consolidar los graneles
  
  $dataPedidosGranel = array();

  foreach ($dataPedidosReferencias as $t) {
    $repeat = false;
    for ($i = 0; $i < count($dataPedidosGranel); $i++) {
      if ($dataPedidosGranel[$i]['granel'] == $t['granel']) {
        $dataPedidosGranel[$i]['cantidad_acumulada'] += $t['cantidad_acumulada'];
        $dataPedidosGranel[$i]['tamanio_lote'] += $t['tamanio_lote'];
        $repeat = true;
        break;
      }
    }
    if ($repeat == false)
      $dataPedidosGranel[] = array(
        'granel' => $t['granel'],
        'producto' => $t['producto'],
        'cantidad_acumulada' => $t['cantidad_acumulada'],
        'tamanio_lote' => $t['tamanio_lote']
      );
  }

  for ($i = 0; $i < sizeof($dataPedidosGranel); $i++) {
    for ($j = 0; $j < sizeof($dataPedidosReferencias); $j++)
      if ($dataPedidosGranel[$i]['granel'] == $dataPedidosReferencias[$j]['granel'])
        //Adiciona la multipresentacion al Granel
        $dataPedidosGranel[$i]['multi'][$j] = $dataPedidosReferencias[$j];
    // Restablecer llaves de variable $dataPedidosGranel
    $dataPedidosGranel[$i]['multi'] = array_values($dataPedidosGranel[$i]['multi']);
  }

  if (!isset($dataPedidosLotes))
    $dataPedidosLotes = $dataPedidos;
  */

  // Calcular el tamaño del lote

  for ($i = 0; $i < sizeof($dataPedidos); $i++) {
    $dataMulti = $multiDao->findProductMultiByRef($dataPedidos[$i]['referencia']);
    $tamanio_lote = $calcTamanioMultiDao->calcularTamanioLote($dataMulti, $dataPedidos[$i]['cantidad_acumulada']);
    $dataPedidos[$i]['tamanio_lote'] = $tamanio_lote;
  }

  $dataPedidosLotes = $planPedidosDao->checkTamanioLote($dataPedidos);

  //Almacenar en variables de session la variable $dataPedidosGranel
  $_SESSION['dataGranel'] = $dataPedidosLotes;

  $countPrePlaneados = $planPrePlaneadosDao->findCountPrePlaneados();

  $data['pedidosLotes'] = $dataPedidos;
  $data['countPrePlaneados'] = $countPrePlaneados['count'];

  $response->getBody()->write(json_encode($data, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

//No programar lotes
$app->get('/eliminarLote', function (Request $request, Response $response, $args) {
  session_start();
  unset($_SESSION['dataPedidos'], $_SESSION['dataGranel']);
  $response->getBody()->write(json_encode(JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
