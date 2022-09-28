<?php

use BatchRecord\dao\MuestrasDespachosDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$muestrasDespachosDao = new MuestrasDespachosDao();

$app->get('/muestrasDespachos/{ref}', function (Request $request, Response $response, $args) use ($microDao, $equipmentsDao, $userDao, $muestrasDespachosDao) {

  $result = $muestrasDespachosDao->findMuestrasDespachos($args['ref']);
  $response->getBody()->write(json_encode($result, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
