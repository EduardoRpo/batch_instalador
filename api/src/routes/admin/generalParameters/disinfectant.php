<?php


use BatchRecord\dao\disinfectantDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$disinfecDao = new disinfectantDao();

$app->get('/disinfectant', function (Request $request, Response $response, $args) use ($disinfecDao) {
  $disinfec = $disinfecDao->findAllDisinfectant();
  $response->getBody()->write(json_encode($disinfec, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteDisinfectant/{id}', function (Request $request, Response $response, $args) use ($disinfecDao) {
  $disinfec = $disinfecDao->deleteDisinfectant($args['id']);

  if ($disinfec == null)
    $resp = array('success' => true, 'message' => 'Modulo eliminado correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveDisinfectant', function (Request $request, Response $response, $args) use ($disinfecDao) {

  $dataDisinfect = $request->getParsedBody();

  if ($dataDisinfect['id']) {
    $disinfec = $disinfecDao->updateDisinfect($dataDisinfect);

    if ($disinfec == null)
      $resp = array('success' => true, 'message' => 'Desinfectante almacenado correctamente');
  } else {
    $disinfec = $disinfecDao->saveDisinfectant($dataDisinfect);

    if ($disinfec == null)
      $resp = array('success' => true, 'message' => 'Desinfectante actualizado correctamente');
  }

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

