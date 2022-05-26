<?php


use BatchRecord\dao\BatchDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$batchDao = new BatchDao();

$app->get('/batch/{id}', function (Request $request, Response $response, $args) use ($batchDao) {
  $batch = $batchDao->findById($args["id"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/batch', function (Request $request, Response $data, $args) use ($batchDao) {
  $batch = $batchDao->findAll();
  $data->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $data->withHeader('Content-Type', 'application/json');
});

$app->get('/batchcerrados', function (Request $request, Response $response, $args) use ($batchDao) {
  $batchcerrados = $batchDao->findAllClosed();
  $response->getBody()->write(json_encode($batchcerrados, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveBatch', function (Request $request, Response $response, $args) use ($batchDao) {
  $dataBatch = $request->getParsedBody();
  $savedBatch = $batchDao->saveBatch($dataBatch);
  $response->getBody()->write(json_encode($savedBatch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/updateBatch', function (Request $request, Response $response, $args) use ($batchDao) {
  $dataBatch = $request->getParsedBody();
  $updatedBatch = $batchDao->updateBatch($dataBatch);
  $response->getBody()->write(json_encode($updatedBatch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});