<?php


use BatchRecord\dao\ProductsDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$productsDao = new ProductsDao();

$app->get('/productsGranel', function (Request $request, Response $response, $args) use ($productsDao) {
  $batch = $productsDao->findAllProductsGranel();
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});