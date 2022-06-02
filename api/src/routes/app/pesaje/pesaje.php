<?php


use BatchRecord\dao\PesajeDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$pesajeDao = new PesajeDao();

$app->get('/pesaje', function (Request $request, Response $response, $args) use ($pesajeDao) {
    $array = $pesajeDao->findAll();
    $response->getBody()->write(json_encode($array));

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/pesaje/{referencia}', function (Request $request, Response $response, $args) use ($pesajeDao) {
    $array = $pesajeDao->findByReference($args["referencia"]);
    $response->getBody()->write(json_encode($array));

    return $response->withHeader('Content-Type', 'application/json');
});
