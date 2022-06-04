<?php


use BatchRecord\dao\InstructivosDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$instructivosDao = new InstructivosDao();

$app->post('/instructivosAdmin', function (Request $request, Response $response, $args) use ($instructivosDao) {
/*     $productos = $productosDao->findAllProducts();
    $data->getBody()->write(json_encode($productos, JSON_NUMERIC_CHECK));
    return $data->withHeader('Content-Type', 'application/json'); */
});
