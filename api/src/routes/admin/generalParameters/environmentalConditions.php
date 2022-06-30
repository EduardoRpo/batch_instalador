<?php


use BatchRecord\dao\CondicionesMediosDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$CondicionesMediosDao = new CondicionesMediosDao();

$app->get('/condicionesMedio', function (Request $request, Response $response, $args) use ($CondicionesMediosDao) {
  $modules = $CondicionesMediosDao->findAllenvironmentalConditions();
  $response->getBody()->write(json_encode($modules, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteModules/{id}', function (Request $request, Response $response, $args) use ($modulesDao) {
  $modules = $modulesDao->deleteModules($args['id']);

  if ($modules == null)
    $resp = array('success' => true, 'message' => 'Modulo eliminado correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveModules', function (Request $request, Response $response, $args) use ($modulesDao) {

  $dataModules = $request->getParsedBody();

  $id_module = $modulesDao->findModule($dataModules);

  if ($id_module)
    $modules = $modulesDao->updateModules($id_module, $dataModules);
  else
    $modules = $modulesDao->saveModules($dataModules);

  if ($modules == null)
    $resp = array('success' => true, 'message' => 'Modulo almacenado/actualizado correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
