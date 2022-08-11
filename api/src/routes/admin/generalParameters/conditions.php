<?php


use BatchRecord\dao\ConditionsDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$conditionsDao = new ConditionsDao();

$app->get('/conditions', function (Request $request, Response $response, $args) use ($conditionsDao) {
  $Conditions = $conditionsDao->findAllConditions();
  $response->getBody()->write(json_encode($Conditions, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveConditions', function (Request $request, Response $response, $args) use ($conditionsDao) {

  $dataConditions = $request->getParsedBody();

  if ($dataConditions['id']) {
    $resp = $conditionsDao->updateConditions($dataConditions);

    if ($resp == null)
      $resp = array('success' => true, 'message' => 'Condicion actualizada correctamente');
  } else {
    $resp = $conditionsDao->saveConditions($dataConditions);

    if ($resp == null)
      $resp = array('success' => true, 'message' => 'Condiciones del medio guardada correctamente');
  }

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteConditions/{id}', function (Request $request, Response $response, $args) use ($conditionsDao) {
  $Conditions = $conditionsDao->deleteConditions($args['id']);

  if ($Conditions == null)
    $resp = array('success' => true, 'message' => 'Condiciones eliminadas correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
