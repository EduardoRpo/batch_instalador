<?php

use BatchRecord\dao\EnvasadoDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$envasadoDao = new EnvasadoDao();

$app->get('/envase/{ref}', function (Request $request, Response $response, $args) use ($envasadoDao) {
    $insumos = $envasadoDao->findAllEnvase($args['ref']);
    $response->getBody()->write(json_encode($insumos, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
