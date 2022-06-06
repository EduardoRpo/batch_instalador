<?php


use BatchRecord\dao\CargosDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$cargosDao = new CargosDao();

$app->get('/cargos', function (Request $request, Response $response, $args) use ($cargosDao) {
    $array = $cargosDao->findAll();
    $response->getBody()->write(json_encode($array));
    return $response->withHeader('Content-Type', 'application/json');
});