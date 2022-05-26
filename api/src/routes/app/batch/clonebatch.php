<?php


use BatchRecord\dao\BatchDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$batchDao = new BatchDao();

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
