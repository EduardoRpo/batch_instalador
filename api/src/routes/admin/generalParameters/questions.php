<?php


use BatchRecord\dao\QuestionsDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$questionsDao = new QuestionsDao();

/* $app->get('/questions', function (Request $request, Response $response, $args) use ($modulesDao) {
  $Questions = $modulesDao->findAllQuestions();
  $response->getBody()->write(json_encode($Questions, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
}); */

/* $app->get('/deleteModules/{id}', function (Request $request, Response $response, $args) use ($modulesDao) {
  $modules = $modulesDao->deleteModules($args['id']);

  if ($modules == null)
    $resp = array('success' => true, 'message' => 'Modulo eliminado correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveModules', function (Request $request, Response $response, $args) use ($modulesDao) {

  $dataModules = $request->getParsedBody();

  if ($dataModules['id']) {
    $modules = $modulesDao->updateModules($dataModules);

    if ($modules == null)
      $resp = array('success' => true, 'message' => 'Modulo almacenado correctamente');
  } else {
    $modules = $modulesDao->saveModules($dataModules);

    if ($modules == null)
      $resp = array('success' => true, 'message' => 'Modulo actualizado correctamente');
  }

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
}); */
