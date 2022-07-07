<?php


use BatchRecord\dao\BatchDao;
use BatchRecord\dao\UltimoBatchCreadoDao;
use BatchRecord\dao\TanquesDao;
use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\MultiDao;
use BatchRecord\dao\ExplosionMaterialesPedidosRegistroDao;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$batchDao = new BatchDao();
$ultimoBatchDao = new UltimoBatchCreadoDao();
$tanquesDao = new TanquesDao();
$controlFirmasDao = new ControlFirmasDao();
$multiDao = new MultiDao();
$EMPedidosRegistroDao = new ExplosionMaterialesPedidosRegistroDao();


$app->get('/batch', function (Request $request, Response $data, $args) use ($batchDao) {
  $batch = $batchDao->findActive();
  $data->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $data->withHeader('Content-Type', 'application/json');
});

$app->get('/batch/{id}', function (Request $request, Response $response, $args) use ($batchDao, $tanquesDao) {
  $dataBatch = $batchDao->findBatchById($args["id"]);

  if ($dataBatch != false) {
    $tanques = $tanquesDao->findTanquesById($args["id"]);
    if ($tanques != false)
      $batch = array_merge($dataBatch, $tanques);
    else
      $batch = $dataBatch;
  }

  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/batchInactivos', function (Request $request, Response $data, $args) use ($batchDao) {
  $batch = $batchDao->findInactive();
  $data->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $data->withHeader('Content-Type', 'application/json');
});

$app->get('/batchcerrados', function (Request $request, Response $response, $args) use ($batchDao) {
  $batchcerrados = $batchDao->findAllClosed();
  $response->getBody()->write(json_encode($batchcerrados, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveBatch', function (Request $request, Response $response, $args) use ($batchDao, $ultimoBatchDao, $tanquesDao, $controlFirmasDao, $multiDao, $EMPedidosRegistroDao) {
  $dataBatch = $request->getParsedBody();
  $flag_tanques = 1;

  $date = $dataBatch['date'];

  if ($dataBatch['date'])
    unset($dataBatch['date']);

  //Si el data esta vacio
  if (sizeof($dataBatch) == 0) {
    session_start();
    $dataBatch = $_SESSION['dataPedidos'];
    for ($i = 0; $i < sizeof($dataBatch); $i++)
      $dataBatch[$i]['date'] = $date;

    $flag_tanques = 0;
  }

  /* Crear el batch */
  for ($i = 0; $i < sizeof($dataBatch); $i++) {

    $resp = $batchDao->saveBatch($dataBatch[$i]);

    /* Indentifica el ultimo Batch ingresado */
    if ($resp == null)
      $id_batch = $ultimoBatchDao->ultimoBatchCreado();

    /* Crea los tanques */
    if ($resp == null and $flag_tanques == 1)
      $resp = $tanquesDao->saveTanques($id_batch['id'], $dataBatch[$i]);

    /* Crea el control de formulas */
    if ($resp == null)
      $resp = $controlFirmasDao->saveControlFirmas($id_batch['id']);

    /* Crea la multipresentacion */
    if ($resp == null)
      $resp = $multiDao->saveMulti($id_batch['id'], $dataBatch[$i]);

    /* Actualizar pedido batch */
    if ($resp == null) {
      $multi = json_decode($dataBatch[$i]['multi'], true);
      for ($j = 0; $j < sizeof($multi); $j++)
        if ($multi[$j]['pedido']) {
          $resp = $batchDao->updateBatchPedido($id_batch['id'], $multi[$j]);
          $resp = $EMPedidosRegistroDao->updateEMPedidosRegistro($multi[$j]);
        } else
          $resp = $batchDao->updateBatchPedido($id_batch['id'], $dataBatch[0]);
    }
  }

  /* Notificaciones*/
  if ($resp == null && $flag_tanques == 1)
    $resp = array('success' => true, 'message' => 'Batch creado correctamente');
  else if ($resp == null && $flag_tanques == 0)
    $resp = array('success' => true, 'message' => sizeof($dataBatch) . ' ' . 'Batchs creados correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras creaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/updateBatch', function (Request $request, Response $response, $args) use ($batchDao, $tanquesDao) {
  $dataBatch = $request->getParsedBody();

  $resp = $batchDao->updateBatch($dataBatch);

  /* Crea o modifica los tanques */
  if ($resp == null)
    $resp = $tanquesDao->saveTanques($dataBatch['id_batch'], $dataBatch);


  /* Notificaciones*/
  if ($resp == null)
    $resp = array('success' => true, 'message' => 'Batch actualizado correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras actualizaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteBatch/{id_batch}/{motivo}', function (Request $request, Response $response, $args) use ($batchDao) {

  $resp = $batchDao->deleteBatch($args['id_batch'], $args['motivo']);

  /* Notificaciones*/
  if ($resp == null)
    $resp = array('success' => true, 'message' => 'Batch Record Eliminado correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras eliminaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
