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
        $dataPedidosReferencias[$i]['cantidad_acumulada'] += $t['cantidad_acumulada'];
        $repeat = true;
        break;
      }
    }
    if ($repeat == false)
      $dataPedidosReferencias[] = array(
        'granel' => $t['granel'],
        'referencia' => $t['referencia'],
        'producto' => $t['producto'],
        'cantidad_acumulada' => $t['cantidad_acumulada']
      );
  }

  // Calcular el tamaño del lote

  for ($i = 0; $i < sizeof($dataPedidosReferencias); $i++) {
    $dataMulti = $multiDao->findProductMultiByRef($dataPedidosReferencias[$i]['referencia']);
    $tamanio_lote = $calcTamanioMultiDao->calcularTamanioLote($dataMulti, $dataPedidosReferencias[$i]['cantidad_acumulada']);
    $dataPedidosReferencias[$i]['tamanio_lote'] = $tamanio_lote;
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

  //Eliminar las referencias de los graneles que la suma supera los 2500 kg

  /*  for ($i = 0; $i < $dataPedidosGranel; $i++) {
    if ($dataPedidosGranel[$i]['tamanio_lote'] > 2500) {
      $EMPRegistroDao->updateEstado($dataPedidosGranel[$i]); //Modifica estado a 2
    } else
      unset($dataPedidosGranel[$i]);
  } */

  //Adiciona la multipresentacion al Granel

  for ($i = 0; $i < sizeof($dataPedidosGranel); $i++)
    for ($j = 0; $j < sizeof($dataPedidosReferencias); $j++)
      if ($dataPedidosGranel[$i]['granel'] == $dataPedidosReferencias[$j]['granel'])
        $dataPedidosGranel[$i]['multi'][$j] = $dataPedidosReferencias[$j];


  //Almacenar en variables de session la variable $dataPedidos
  $_SESSION['dataGranel'] = $dataPedidosGranel;

  //$array = array('granel' => array_keys($sumArrayGranel), 'producto' => $producto, 'tamanio' => array_values($sumArrayGranel), 'cantidades' => array_values($sumArrayCantidades));

  $response->getBody()->write(json_encode($dataPedidosGranel, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

//No programar lotes
$app->get('/eliminarLote', function (Request $request, Response $response, $args) {
  session_start();
  unset($_SESSION['dataPedidos'], $_SESSION['dataMulti']);
  $response->getBody()->write(json_encode(JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
