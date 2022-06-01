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

  for ($i = 0; $i < sizeof($dataPedidos); $i++) {
    $dataMulti = $multiDao->findProductMultiByRef($dataPedidos[$i]['referencia']);
    $tamanio_lote = $calcTamanioMultiDao->calcularTamanioLote($dataMulti, $dataPedidos[$i]['cantidad']);
    $dataPedidos[$i]['tamanio_lote'] = $tamanio_lote;

    $granel = $dataPedidos[$i]['granel'];
    $lote[$i][$granel] = $tamanio_lote;
  }

  $sumArray = array();

  foreach ($lote as $k => $subArray) {
    foreach ($subArray as $id => $value) {
      $sumArray[$id] += $value;
    }
  }

  $response->getBody()->write(json_encode($sumArray, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
