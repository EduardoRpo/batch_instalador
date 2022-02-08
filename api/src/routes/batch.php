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

$app->post('/clonebatch', function (Request $request, Response $response, $args) use ($batchDao) {
  $requestBody = json_decode($request->getBody(), true);
  $batch = $batchDao->findById($requestBody['idbatch']);
  //$batch["unidad_lote"] = $requestBody['unidades'];
  $duplicates = $requestBody['cantidad'];
  for ($i = 0; $i < $duplicates; $i++) {
    $rows = $batchDao->saveBatch($batch);
  }
  $resp = array('success' => ($rows > 0));
  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
