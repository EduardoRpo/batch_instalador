<?php

use BatchRecord\dao\ExplosionMaterialesPedidosRegistroDao;
use BatchRecord\dao\PreBatchDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$preBatchDao = new PreBatchDao();
$EMPedidosRegistroDao = new ExplosionMaterialesPedidosRegistroDao();

$app->get('/preBatch', function (Request $request, Response $response, $args) use ($preBatchDao, $EMPedidosRegistroDao) {
  $preBatch = $preBatchDao->findAllPreBatch();
  $EMPedidosRegistroDao->resetEstado();
  $response->getBody()->write(json_encode($preBatch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
