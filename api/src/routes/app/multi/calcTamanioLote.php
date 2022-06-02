<?php
error_reporting(0);

use BatchRecord\dao\MultiDao;
use BatchRecord\dao\calcTamanioMultiDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$multiDao = new MultiDao();
$calcTamanioMultiDao = new calcTamanioMultiDao();

$app->post('/calcTamanioLote', function (Request $request, Response $response, $args) use ($multiDao, $calcTamanioMultiDao) {
  $dataPedidos = $request->getParsedBody();
  $dataPedidos = $dataPedidos['data'];

  $referencia = array();

  for ($i = 0; $i < sizeof($dataPedidos); $i++) {
    //$dataPedidos[$i]['referencia'] = substr($dataPedidos[$i]['referencia'], 6, 9);
    $dataMulti = $multiDao->findProductMultiByRef($dataPedidos[$i]['referencia']);
    $tamanio_lote = $calcTamanioMultiDao->calcularTamanioLote($dataMulti, $dataPedidos[$i]['cantidad']);
    $dataPedidos[$i]['tamanio_lote'] = $tamanio_lote;

    $granel = $dataPedidos[$i]['granel'];

    $loteGranel[$i][$granel] = $tamanio_lote;
    $loteCantidades[$i][$granel] = $dataPedidos[$i]['cantidad'];

    $referencia[$i] = $dataPedidos[$i]['referencia'];
  }

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

  $sumArrayTotal = array('referencia' => array_values($referencia), 'granel' => array_keys($sumArrayGranel), 'tamanio' => array_values($sumArrayGranel), 'cantidades' => array_values($sumArrayCantidades));

  $response->getBody()->write(json_encode($sumArrayTotal, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
