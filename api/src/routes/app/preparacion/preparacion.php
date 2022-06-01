<?php


use BatchRecord\dao\IntructivoPreparacionDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$instructivoPreparacionDao = new IntructivoPreparacionDao();

$app->get('/instructivos/{idProducto}', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao) {
  $batch = $instructivoPreparacionDao->findByProduct($args["idProducto"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});