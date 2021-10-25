<?php

use BatchRecord\dao\ExplosionMaterialesDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$explosionMaterialesDao = new ExplosionMaterialesDao();

$app->get('/explosionMaterialesBatch', function (Request $request, Response $response, $args) use ($explosionMaterialesDao) {
    $explosionMateriales = $explosionMaterialesDao->findAll();
    $response->getBody()->write(json_encode($explosionMateriales, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/explosionMaterialesPedidos', function (Request $request, Response $response, $args) use ($explosionMaterialesDao) {
    $explosionMateriales = $explosionMaterialesDao->findAllPedidos();
    $response->getBody()->write(json_encode($explosionMateriales, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
