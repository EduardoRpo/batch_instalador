<?php


use BatchRecord\dao\DesinfectanteDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$desinfectanteDao = new DesinfectanteDao();

$app->get('/desinfectantes', function (Request $request, Response $response, $args) use ($desinfectanteDao) {
  $batch = $desinfectanteDao->findAll();
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});