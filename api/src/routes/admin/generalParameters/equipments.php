<?php


use BatchRecord\dao\EquipmentsDao;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$equipmentsDao = new EquipmentsDao();

$app->get('/equipments', function (Request $request, Response $response, $args) use ($equipmentsDao) {
  $equipments = $equipmentsDao->findAllEquipments();
  $response->getBody()->write(json_encode($equipments, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/findEquipmentsByType', function(Request $request, Response $response, $args) use ($equipmentsDao){
    $dataEquipment = $request->getParsedBody();
    $equipments = $equipmentsDao->findEquipmentsByType();
    $response->getBody()->write(json_encode($equipments, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteEquipments/{id}', function (Request $request, Response $response, $args) use ($equipmentsDao) {
  $equipments = $equipmentsDao->deleteEquipments($args['id']);

  if ($equipments == null)
    $resp = array('success' => true, 'message' => 'Registro eliminado correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveEquipment', function (Request $request, Response $response, $args) use ($equipmentsDao) {

  $dataEquipment = $request->getParsedBody();

  if ($dataEquipment['id']) {
    $equipments = $equipmentsDao->updateEquipments($dataEquipment);

    if ($equipments == null)
      $resp = array('success' => true, 'message' => 'Desinfectante almacenado correctamente');
  } else {
    $equipments = $equipmentsDao->saveEquipments($dataEquipment);

    if ($equipments == null)
      $resp = array('success' => true, 'message' => 'Desinfectante actualizado correctamente');
  }

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
