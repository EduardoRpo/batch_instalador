<?php


use BatchRecord\dao\GranelDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$granelDao = new GranelDao();

$app->get('/granel', function (Request $request, Response $response, $args) use ($granelDao) {
  $granel = $granelDao->findAll();
  $response->getBody()->write(json_encode($granel, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/granelNoFormula', function (Request $request, Response $response, $args) use ($granelDao) {
  $granel = $granelDao->findGranelesNoFormula();
  $response->getBody()->write(json_encode($granel, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});