<?php


use BatchRecord\dao\MultiDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$multiDao = new MultiDao();

$app->get('/multi/{idBatch}', function (Request $request, Response $response, $args) use ($multiDao) {
  $multi = $multiDao->findMultiByBatch($args['idBatch']);
  $response->getBody()->write(json_encode($multi, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
