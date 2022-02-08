<?php


use BatchRecord\dao\CargoDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$cargoDao = new CargoDao();

$app->get('/cargos', function (Request $request, Response $response, $args) use ($cargoDao) {
  $batch = $cargoDao->findAll();
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
