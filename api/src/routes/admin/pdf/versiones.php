<?php


use BatchRecord\dao\VersionesDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$versionPDFDao = new VersionesDao();

$app->get('/getAllVersions/{type}', function (Request $request, Response $data, $args) use ($versionPDFDao) {
  $versiones = $versionPDFDao->findAllVersionsByType($args['type']);
  $data->getBody()->write(json_encode($versiones, JSON_NUMERIC_CHECK));
  return $data->withHeader('Content-Type', 'application/json');
});

$app->get('/getversions/{date}/{type}', function (Request $request, Response $data, $args) use ($versionPDFDao) {
  $version = $versionPDFDao->findCurrentlyVersionByType($args['date'], $args['type']);
  $data->getBody()->write(json_encode($version, JSON_NUMERIC_CHECK));
  return $data->withHeader('Content-Type', 'application/json');
});

$app->post('/saveVersion', function (Request $request, Response $response, $args) use ($versionPDFDao) {
  $dataVersion = $request->getParsedBody();
  $version = $versionPDFDao->saveVersionByType($dataVersion);

  if ($version == null)
    $resp = array('success' => true, 'message' => 'Versión creada correctamente');

  else
    $resp = array('info' => true, 'message' => 'La versión ya existe. Intente con una nueva referencia');


  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/updateVersion', function (Request $request, Response $response, $args) use ($versionPDFDao) {
  $dataVersion = $request->getParsedBody();
  $version = $versionPDFDao->updateVersionByType($dataVersion);

  if ($version == null)
    $resp = array('success' => true, 'message' => 'Versión actualizada correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error, intente nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteVersion/{id}', function (Request $request, Response $response, $args) use ($versionPDFDao) {
  $version = $versionPDFDao->deleteVersionByType($args["id"]);

  if ($version == null)
    $resp = array('success' => true, 'message' => 'Versión eliminada correctamente');
  if ($version != null)
    $resp = array('error' => true, 'message' => 'No es posible eliminar el version, existe información asociada a ella');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
