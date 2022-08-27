<?php
error_reporting(0);

use BatchRecord\dao\MultiDao;
use BatchRecord\dao\calcTamanioMultiDao;
use BatchRecord\dao\ProductsDao;
use BatchRecord\dao\ExplosionMaterialesPedidosRegistroDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$multiDao = new MultiDao();
$calcTamanioMultiDao = new calcTamanioMultiDao();
$productsDao = new ProductsDao();
$EMPRegistroDao = new ExplosionMaterialesPedidosRegistroDao();

$app->post('/calcTamanioLote', function (Request $request, Response $response, $args) use ($multiDao, $calcTamanioMultiDao, $productsDao, $EMPRegistroDao) {
  $dataPedidos = $request->getParsedBody();
  $dataPedidos = $dataPedidos['data'];

  $referencia = array();

  // Almacena las cantidades registradas por pedido y referencia individualmente
  session_start();
  $_SESSION['dataPedidos'] = $dataPedidos;

  // Consolidar referencias

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

  // Calcular el tamaño del lote

  for ($i = 0; $i < sizeof($dataPedidosReferencias); $i++) {
    $dataMulti = $multiDao->findProductMultiByRef($dataPedidosReferencias[$i]['referencia']);
    $tamanio_lote = $calcTamanioMultiDao->calcularTamanioLote($dataMulti, $dataPedidosReferencias[$i]['cantidad_acumulada']);
    $dataPedidosReferencias[$i]['tamanio_lote'] = $tamanio_lote;
  }

  // Eliminar granel donde tamanio_lote sea mayor a 2500
  for ($i = 0; $i < sizeof($dataPedidosReferencias); $i++) {
    if ($dataPedidosReferencias[$i]['tamanio_lote'] > 2500) {
      $EMPRegistroDao->checkPedidos($dataPedidosReferencias[$i]); // Cambiar estado a 2
      // Capturar data de lotes programados, para mostrar en la ventana de calculo
      $dataPedidosLotes[$i] = $dataPedidosReferencias[$i];
      unset($dataPedidosReferencias[$i]);
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
    $dataPedidosLotes = $dataPedidosGranel;

  //Almacenar en variables de session la variable $dataPedidosGranel
  $_SESSION['dataGranel'] = $dataPedidosGranel;

  if (sizeof($dataPedidosGranel) == 0) {
    $resp = array('error' => true, 'message' => 'Los tamaños de lotes calculados exceden los 2500, intente nuevamente');
    $dataPedidosLotes = array_merge($dataPedidosLotes, $resp);
  }

  //$array = array('granel' => array_keys($sumArrayGranel), 'producto' => $producto, 'tamanio' => array_values($sumArrayGranel), 'cantidades' => array_values($sumArrayCantidades));

  $response->getBody()->write(json_encode($dataPedidosLotes, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

//No programar lotes
$app->get('/eliminarLote', function (Request $request, Response $response, $args) {
  session_start();
  unset($_SESSION['dataPedidos'], $_SESSION['dataMulti']);
  $response->getBody()->write(json_encode(JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
