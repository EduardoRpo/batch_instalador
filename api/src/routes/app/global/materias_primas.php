<?php


use BatchRecord\dao\MateriaPrimaDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$materiaPrimaDao = new MateriaPrimaDao();

$app->get('/materiasp/{idProduct}', function (Request $request, Response $response, $args) use ($materiaPrimaDao) {
  $batch = $materiaPrimaDao->findByProduct($args["idProduct"]);
  //$batch = $materiaPrimaDao->findByProductInv($args["idProduct"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/pesajeDispensacion/{idProduct}/{tamanioLote}', function (Request $request, Response $response, $args) use ($materiaPrimaDao) {
  $pesajeMP = $materiaPrimaDao->findByProduct($args["idProduct"]);

  $tamanioLote = $args["tamanioLote"];

  for ($i = 0; $i < sizeof($pesajeMP); $i++) {
    $pesoTotal = $pesajeMP[$i]['porcentaje'] / 100 * $tamanioLote;
    $pesajeMP[$i]['pesoTotal'] = $pesoTotal;
  }

  $response->getBody()->write(json_encode($pesajeMP, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
