<?php

use BatchRecord\dao\PlanPedidosDao;
use BatchRecord\dao\PreBatchDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$EMPedidosRegistroDao = new PlanPedidosDao();
$preBatchDao = new PreBatchDao();

$app->get('/preBatch', function (Request $request, Response $response, $args) use ($EMPedidosRegistroDao, $preBatchDao) {
  $EMPedidosRegistroDao->resetEstadoColorProgramacion();
  $preBatch = $preBatchDao->findAllPreBatch();
  $response->getBody()->write(json_encode($preBatch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
