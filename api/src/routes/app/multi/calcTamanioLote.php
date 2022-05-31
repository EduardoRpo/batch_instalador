<?php


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
  }

  $dataGranel = [];
  $dataGranel['tamanio_lote'] = 0;

  for ($i = 0; $i < sizeof($dataPedidos); $i++)
    for ($j = $i + 1; $j < sizeof($dataPedidos); $j++) {
      if ($dataPedidos[$i]['granel'] == $dataPedidos[$j]['granel']) {
        $dataGranel['granel'] = $dataPedidos[$i]['granel'];
        $dataGranel['tamanio_lote'] = $dataGranel['tamanio_lote'] + $dataPedidos[$i]['tamanio_lote'] + $dataPedidos[$j]['tamanio_lote'];
      }
    }

  $response->getBody()->write(json_encode($dataGranel, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
