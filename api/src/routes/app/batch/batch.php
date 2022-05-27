<?php


use BatchRecord\dao\BatchDao;
use BatchRecord\dao\UltimoBatchCreadoDao;
use BatchRecord\dao\TanquesDao;
use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\MultiDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$batchDao = new BatchDao();
$ultimoBatchDao = new UltimoBatchCreadoDao();
$tanquesDao = new TanquesDao();
$controlFirmasDao = new ControlFirmasDao();
$multiDao = new MultiDao();

$app->get('/batch/{id}', function (Request $request, Response $response, $args) use ($batchDao, $tanquesDao) {
  $dataBatch = $batchDao->findBatchById($args["id"]);
  $tanques = $tanquesDao->findTanquesById($args["id"]);
  $batch = array_merge($dataBatch, $tanques);

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

$app->post('/saveBatch', function (Request $request, Response $response, $args) use ($batchDao, $ultimoBatchDao, $tanquesDao, $controlFirmasDao, $multiDao) {
  $dataBatch = $request->getParsedBody();

  /* Crear el batch */
  $resp = $batchDao->saveBatch($dataBatch);

  /* Indentifica el ultimo Batch ingresado */
  if ($resp == null)
    $id_batch = $ultimoBatchDao->ultimoBatchCreado();

  /* Crea los tanques */
  if ($resp == null)
    $resp = $tanquesDao->saveTanques($id_batch['id'], $dataBatch);

  /* Crea el control de formulas */
  if ($resp == null)
    $resp = $controlFirmasDao->saveControlFirmas($id_batch['id']);

  /* Crea la multipresentacion */
  if ($resp == null)
    $resp = $multiDao->saveMulti($id_batch['id'], $dataBatch);

  /* Notificaciones*/
  if ($resp == null)
    $resp = array('success' => true, 'message' => 'Nuevo Batch creado correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras creaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/updateBatch', function (Request $request, Response $response, $args) use ($batchDao) {
  $dataBatch = $request->getParsedBody();
  $resp = $batchDao->updateBatch($dataBatch);

  /* Notificaciones*/
  if ($resp == null)
    $resp = array('success' => true, 'message' => 'Batch actualizado correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras actualizaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
