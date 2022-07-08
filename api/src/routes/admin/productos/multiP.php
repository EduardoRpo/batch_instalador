<?php


use BatchRecord\dao\MultiPrecentacionDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$multiPDao = new MultiPrecentacionDao();

$app->get('/multiAdmin', function (Request $request, Response $response, $args) use ($multiPDao) {
  $MultiP = $multiPDao->findAllMulti();
  $response->getBody()->write(json_encode($MultiP, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteMulti/{multi}', function (Request $request, Response $response, $args) use ($multiPDao) {
  $MultiP = $multiPDao->deleteMulti($args['multi']);


  if ($MultiP == null)
    $resp = array('success' => true, 'message' => 'Multipresentacion eliminada correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

/*$app->post('/saveMulti', function (Request $request, Response $response, $args) use ($multiPDao) {

  $dataMulti = $request->getParsedBody();

  if ($dataMulti['id']) {
    $Multi = $multiPDao->updateMulti($dataMulti);

    if ($Multi == null)
      $resp = array('success' => true, 'message' => 'Modulo almacenado correctamente');
  } else {
    $Multi = $multiPDao->saveMulti($dataMulti);

    if ($Multi == null)
      $resp = array('success' => true, 'message' => 'Modulo actualizado correctamente');
  }

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
*/