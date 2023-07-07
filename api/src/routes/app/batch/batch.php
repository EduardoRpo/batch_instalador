<?php


use BatchRecord\dao\BatchDao;
use BatchRecord\dao\UltimoBatchCreadoDao;
use BatchRecord\dao\TanquesDao;
use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\MultiDao;
use BatchRecord\dao\PlanPedidosDao;
use BatchRecord\dao\ObservacionesInactivosDao;
use BatchRecord\dao\PlanPrePlaneadosDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$batchDao = new BatchDao();
$ultimoBatchDao = new UltimoBatchCreadoDao();
$tanquesDao = new TanquesDao();
$controlFirmasDao = new ControlFirmasDao();
$multiDao = new MultiDao();
$EMPedidosRegistroDao = new PlanPedidosDao();
$planPrePlaneadosDao = new PlanPrePlaneadosDao();
$observacionesDao = new ObservacionesInactivosDao();


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

$app->post('/saveBatch', function (Request $request, Response $response, $args) use ($batchDao, $ultimoBatchDao, $tanquesDao, $controlFirmasDao, $multiDao, $EMPedidosRegistroDao, $observacionesDao, $planPrePlaneadosDao) {
  session_start();
  $dataBatch = $request->getParsedBody();
  // $flag_tanques = 1;


  if ($dataBatch['data']) {
    $pedidos = $dataBatch['data'];
    $dataBatch = $_SESSION['dataGranel'];

    for ($i = 0; $i < sizeof($dataBatch); $i++) {
      if ($dataBatch[$i]['granel'] == $pedidos[$i]['granel']) {
        $dataBatch[$i]['date'] = $pedidos[sizeof($pedidos) - 1]['date'];
        $dataBatch[$i]['tanque'] = $pedidos[$i]['tanque'];
        $dataBatch[$i]['cantidades'] = $pedidos[$i]['cantidades'];
      }
    }
  }

  /* Crear el batch */
  for ($i = 0; $i < sizeof($dataBatch); $i++) {

    //validar si el multi es de planeacion o es creado manualmente
    $array = is_array($dataBatch[$i]['multi']);

    if ($array) // planeacion
      $multi = $dataBatch[$i]['multi'];
    else // batch manual
      $multi = json_decode($dataBatch[$i]['multi'], true);

    //Guarda Batch
    $resp = $batchDao->saveBatch($dataBatch[$i], $multi);

    /* Identifica el ultimo Batch ingresado */
    if ($resp == null)
      $id_batch = $ultimoBatchDao->ultimoBatchCreado();

    /* Crea los tanques */
    if ($resp == null)
      $resp = $tanquesDao->saveTanques($id_batch['id'], $dataBatch[$i]);

    /* Crea el control de formulas */
    if ($resp == null)
      $resp = $controlFirmasDao->saveControlFirmas($id_batch['id']);

    /* Crea la multipresentacion */
    if ($resp == null)
      $resp = $multiDao->saveMulti($id_batch['id'], $dataBatch[$i], $multi);

    /* Actualizar pedido batch */
    if ($resp == null) {

      // Almacena los pedidos en los batch creados
      for ($j = 0; $j < sizeof($multi); $j++) {
        if ($multi[$j]['numPedido']) {
          $resp = $batchDao->updateBatchPedido($id_batch['id'], $multi[$j]);
          // Agregar batch a observacion de planeacion
          $observaciones = $observacionesDao->findObservaciones($multi[$j]);
          if ($observaciones)
            $resp = $observacionesDao->updateObservacion($id_batch['id'], $multi[$j]);

          // Eliminar campos de preplaneados
          $resp = $planPrePlaneadosDao->deletePlaneado($multi[$j]['id']);
        } else {
          //$resp = $batchDao->updateBatchPedido($id_batch['id'], $dataBatch[0]);
          $_SESSION['dataPedidos'] = $multi;
        }
      }
    }
  }
  $resp = $EMPedidosRegistroDao->checkEMPedidosRegistro();

  /* Notificaciones*/
  if ($resp == null && $dataBatch[0]['ref'])
    $resp = array('success' => true, 'message' => 'Batch creado correctamente');
  else if ($resp == null)
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
  else if (isset($resp['info']))
    $resp = array('info' => true, 'message' => $resp['message']);
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras eliminaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/savePdf', function (Request $request, Response $response, $args) use ($batchDao) {
  $pdf = $batchDao->loadImagePdf();

  if ($pdf == null)
    $resp = array('success' => true, 'message' => 'Documento pdf descargado correctamente');
  else if (isset($pdf['info']))
    $resp = array('info' => true, 'message' => $pdf['message']);
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras descargaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
