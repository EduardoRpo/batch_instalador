<?php
error_reporting(0);

use BatchRecord\dao\MultiDao;
use BatchRecord\dao\calcTamanioMultiDao;
use BatchRecord\dao\ProductsDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$multiDao = new MultiDao();
$calcTamanioMultiDao = new calcTamanioMultiDao();
$productsDao = new ProductsDao();

$app->post('/calcTamanioLote', function (Request $request, Response $response, $args) use ($multiDao, $calcTamanioMultiDao, $productsDao) {
  $dataPedidos = $request->getParsedBody();
  $dataPedidos = $dataPedidos['data'];

  $referencia = array();

  for ($i = 0; $i < sizeof($dataPedidos); $i++) {
    $dataMulti = $multiDao->findProductMultiByRef($dataPedidos[$i]['referencia']);
    $tamanio_lote = $calcTamanioMultiDao->calcularTamanioLote($dataMulti, $dataPedidos[$i]['cantidad']);
    $dataPedidos[$i]['tamanio_lote'] = $tamanio_lote;
    $dataPedidos[$i]['presentacion_ref'] = $dataMulti['presentacion'];

    $granel = $dataPedidos[$i]['granel'];

    $loteGranel[$i][$granel] = $tamanio_lote;
    $loteCantidades[$i][$granel] = $dataPedidos[$i]['cantidad'];

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

  for ($i = 0; $i < $count; $i++) {
    if ($newDataPedidos[$i - 1]['ref'] != $dataPedidos[$i]['granel']) {
      //Buscar lotePresentacion Granel
      $presentacion = $productsDao->findProductGranel($dataPedidos[$i]['granel']);

      //Definir nombre llaves
      $newDataPedidos[$i]['ref'] = $dataPedidos[$i]['granel'];
      $newDataPedidos[$i]['lote'] = $sumArrayGranel[$dataPedidos[$i]['granel']];
      $newDataPedidos[$i]['programacion'] = '';
      $newDataPedidos[$i]['fecha_insumos'] = $dataPedidos[$i]['fecha_insumo'];;
      $newDataPedidos[$i]['presentacion'] = $presentacion['presentacion'];
      $newDataPedidos[$i]['multi'][$i] = array('referencia' => $dataPedidos[$i]['referencia'], 'cantidadunidades' => $dataPedidos[$i]['cantidad'], 'tamaniopresentacion' => $dataPedidos[$i]['tamanio_lote']);

      //Agregar al multi con la misma referencia
      if ($dataPedidos[$i + 1]['granel'] == $newDataPedidos[$i]['ref'])
        $newDataPedidos[$i]['multi'][$i + 1] = array('referencia' => $dataPedidos[$i + 1]['referencia'], 'cantidadunidades' => $dataPedidos[$i + 1]['cantidad'], 'tamaniopresentacion' => $dataPedidos[$i + 1]['tamanio_lote']);

      //Resetear llaves multi y convertirlo a objeto
      $newDataPedidos[$i]['multi'] = array_values($newDataPedidos[$i]['multi']);
      $newDataPedidos[$i]['multi'] = json_encode($newDataPedidos[$i]['multi']);

      //Eliminar las referencias de los graneles que la suma supera los 2500 kg
      if ($sumArrayGranel[$dataPedidos[$i]['granel']] > 2500) {
        unset($newDataPedidos[$i]);
      }
      //Resetear llaves arrays
      $newDataPedidos = array_values($newDataPedidos);
    }
  }

  //Almacenar en variables de session la variable $dataPedidos
  session_start();
  $_SESSION['dataPedidos'] = $newDataPedidos;


  $sumArrayTotal = array(/*'referencia' => array_values($referencia),*/'granel' => array_keys($sumArrayGranel), 'tamanio' => array_values($sumArrayGranel), 'cantidades' => array_values($sumArrayCantidades));

  $response->getBody()->write(json_encode($sumArrayTotal, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

//No programar lotes
$app->get('/eliminarLote', function (Request $request, Response $response, $args) {
  session_start();
  unset($_SESSION['dataPedidos']);
});
