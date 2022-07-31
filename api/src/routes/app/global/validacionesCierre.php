<?php


use BatchRecord\dao\ValidacionesCierreDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$validacionesCierreDao = new ValidacionesCierreDao();

$app->get('/validacionesCierreProceso/{batch}/{modulo}', function (Request $request, Response $response, $args) use ($validacionesCierreDao) {
    $result = $validacionesCierreDao->findControlFirmas($args['batch'], $args['modulo']);
    $response->getBody()->write($result, JSON_NUMERIC_CHECK);
    return $response->withHeader('Content-Type', 'application/json');
});
