<?php


use BatchRecord\dao\MateriaPrimaDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$materiaPrimaDao = new MateriaPrimaDao();

$app->get('/materiasp/{idProduct}', function (Request $request, Response $response, $args) use ($materiaPrimaDao) {
  $batch = $materiaPrimaDao->findByProduct($args["idProduct"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});