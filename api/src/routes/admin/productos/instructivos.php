<?php


use BatchRecord\dao\IntructivoPreparacionDao;
use BatchRecord\dao\BatchDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$instructivoPreparacionDao = new IntructivoPreparacionDao();
$batchDao = new BatchDao();

$app->get('/instructivos/{idProducto}', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao) {
  $batch = $instructivoPreparacionDao->findInstructiveByProduct($args["idProducto"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveInstructivos', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao, $batchDao) {
  $dataInstructive = $request->getParsedBody();
  if ($dataInstructive['id']) {
    $instructivo = $instructivoPreparacionDao->updateInstructive($dataInstructive);
    if ($instructivo == null)
      $resp = array('success' => true, 'message' => 'Instructivo actualizado correctamente');
  } else {
    /* $instructiveBatch = $instructivoPreparacionDao->findInstructiveByProduct($dataInstructive["referencia"]);
   
    if (sizeof($instructiveBatch) == 0) {
      $dataBatch['estado'] = 2;
      $dataBatch['ref_producto'] = $dataInstructive['referencia'];
      $batchDao->updateEstadoBatch($dataBatch);
    } */

    $instructivo = $instructivoPreparacionDao->saveInstructive($dataInstructive);

    if ($instructivo == null)
      $resp = array('success' => true, 'message' => 'Instructivo credo correctamente');
  }
  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/deleteInstructivos', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao) {
  $dataInstructive = $request->getParsedBody();
  $instructivo = $instructivoPreparacionDao->deleteInstructive($dataInstructive);
  if ($instructivo == null) {
    $resp = array('success' => true, 'message' => 'Instructivo actualizado correctamente');
  }
  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
