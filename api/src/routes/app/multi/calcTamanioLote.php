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

  for ($i = 0; $i < sizeof($dataPedidos); $i++) {
    $dataMulti = $multiDao->findProductMultiByRef($dataPedidos[$i]['referencia']);
    $tamanio_lote = $calcTamanioMultiDao->calcularTamanioLote($dataMulti, $dataPedidos[$i]['cantidad_acumulada']);
    $dataPedidos[$i]['tamanio_lote'] = $tamanio_lote;
    $dataPedidos[$i]['presentacion_ref'] = $dataMulti['presentacion'];

    $granel = $dataPedidos[$i]['granel'];

    $loteGranel[$i][$granel] = $tamanio_lote;
    $loteCantidades[$i][$granel] = $dataPedidos[$i]['cantidad_acumulada'];

    $producto[$i] = $dataPedidos[$i]['producto'];
    $referencia[$i] = $dataPedidos[$i]['referencia'];
  }

  //Consolidado tamaño Graneles

  $sumArrayGranel = array();
  $sumArrayCantidades = array();

  foreach ($loteGranel as $k => $subArray) {
    foreach ($subArray as $id => $value) {
      $sumArrayGranel[$id] += $value;
    }
  }

  foreach ($loteCantidades as $k => $subArray) {
    foreach ($subArray as $id => $value) {
      $sumArrayCantidades[$id] += $value;
    }
  }

  $newDataPedidos = array();
  $count = sizeof($dataPedidos);
  $cantReferencias = $count;

  // Buscar cantidad de refencias
  for ($i = 0; $i < $count; $i++) {
    for ($j = $i; $j < $count; $j++) {
      $j == $i ? $j = $j + 1 : $j;
      if ($dataPedidos[$i]['referencia'] == $dataPedidos[$j]['referencia']) $cantReferencias = $cantReferencias - 1;
    }
  }

  for ($i = 0; $i < $count; $i++) {
    //Buscar lotePresentacion Granel
    $presentacion = $productsDao->findProductGranel($dataPedidos[$i]['granel']);

    //Definir nombre llaves
    $newDataPedidos[$i]['ref'] = $dataPedidos[$i]['granel'];
    $newDataPedidos[$i]['lote'] = $sumArrayGranel[$dataPedidos[$i]['granel']];
    $newDataPedidos[$i]['programacion'] = '';
    $newDataPedidos[$i]['presentacion'] = $presentacion['presentacion'];
    $newDataPedidos[$i]['multi'][$i] = array(
      'pedido' => $dataPedidos[$i]['numPedido'], 'referencia' => $dataPedidos[$i]['referencia'], 'cantidadunidades' => $dataPedidos[$i]['cantidad_acumulada'],
      'tamaniopresentacion' => $dataPedidos[$i]['tamanio_lote'], 'fecha_insumo' => $dataPedidos[$i]['fecha_insumo']
    );

    //Agregar al multi con la misma referencia
    for ($j = 0; $j < $count; $j++) {
      $j == $i ? $j = $j + 1 : $j;
      if ($dataPedidos[$j]['granel'] == $newDataPedidos[$i]['ref'])
        $newDataPedidos[$i]['multi'][$j] = array(
          'pedido' => $dataPedidos[$j]['numPedido'], 'referencia' => $dataPedidos[$j]['referencia'], 'cantidadunidades' => $dataPedidos[$j]['cantidad_acumulada'],
          'tamaniopresentacion' => $dataPedidos[$j]['tamanio_lote'], 'fecha_insumo' => $dataPedidos[$j]['fecha_insumo']
        );
    }

    //Eliminar las referencias de los graneles que la suma supera los 2500 kg
    if ($sumArrayGranel[$dataPedidos[$i]['granel']] > 2500) {
      //Cambiar estado a 2
      for ($j = 0; $j < sizeof($newDataPedidos[$i]['multi']); $j++) {
        $EMPRegistroDao->updateEstado($newDataPedidos[$i]['multi'][$j]);
      }
      unset($newDataPedidos[$i]);
    } else {
      //Resetear llaves multi y convertirlo a objeto
      $newDataPedidos[$i]['multi'] = array_values($newDataPedidos[$i]['multi']);
      $newDataPedidos[$i]['multi'] = json_encode($newDataPedidos[$i]['multi']);
    }
  }

  //Eliminar referencias duplicadas
  for ($i = 0; $i < $count; $i++) {
    for ($j = 0; $j < $count; $j++) {
      $j == $i ? $j = $j + 1 : $j;
      if ($newDataPedidos[$i]['ref'] == $dataPedidos[$j]['granel']) unset($newDataPedidos[$j]);
    }
  }

  //Resetear llaves arrays
  $newDataPedidos = array_values($newDataPedidos);

  //Almacenar en variables de session la variable $dataPedidos
  session_start();
  $_SESSION['dataPedidos'] = $newDataPedidos;


  $sumArrayTotal = array(
    'cantidad_pedidos' => $count, 'cantidad_referencias' => $cantReferencias, 'granel' => array_keys($sumArrayGranel),
    'producto' => $producto, 'tamanio' => array_values($sumArrayGranel), 'cantidades' => array_values($sumArrayCantidades)
  );

  $response->getBody()->write(json_encode($sumArrayTotal, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

//No programar lotes
$app->get('/eliminarLote', function (Request $request, Response $response, $args) {
  session_start();
  unset($_SESSION['dataPedidos']);
  $response->getBody()->write(json_encode(JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
