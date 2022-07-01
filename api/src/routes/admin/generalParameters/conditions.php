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

  $dataid = $request->getParsedBody();
  $dataT_min = $request->getParsedBody();
  $dataT_max =  $request->getParsedBody();

  $Conditions = $conditionsDao->saveConditions($dataT_min, $dataT_max, $dataid);
  /*if ($id)
    $Conditions = $conditionsDao->updateConditions($t_min, $t_max, $id);
  else
    $Conditions = $conditionsDao->saveConditions($dataConditions);

  if ($Conditions == null)
    $resp = array('success' => true, 'message' => 'Condiciones del medio almacenado/actualizado correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');*/
});

/* $app->get('/deleteConditions/{id}', function (Request $request, Response $response, $args) use ($conditionsDao) {
  $Conditions = $conditionsDao->deleteConditions($args['id']);

  if ($Conditions == null)
    $resp = array('success' => true, 'message' => 'Modulo eliminado correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

 */
