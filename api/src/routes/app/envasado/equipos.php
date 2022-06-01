<?php


use BatchRecord\dao\EquipoDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$equipoDao = new EquipoDao();

$app->get('/equipos', function (Request $request, Response $response, $args) use ($equipoDao) {
    $equipos = $equipoDao->findAll();
    $response->getBody()->write(json_encode($equipos, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/equipos/{idBatch}', function (Request $request, Response $response, $args) use ($equipoDao) {
    $array = $equipoDao->findByBatch($args["idBatch"]);
    $response->getBody()->write(json_encode($array));

    return $response->withHeader('Content-Type', 'application/json');
});
