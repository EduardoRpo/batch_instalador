<?php


use BatchRecord\dao\ValidacionesCierreDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$vaidacionesCierreDao = new ValidacionesCierreDao();

$app->get('/validacionesCierreProceso/{batch}/{modulo}', function (Request $request, Response $response, $args) use ($vaidacionesCierreDao) {
    $array = $vaidacionesCierreDao->findControlFirmas($args['batch'], $args['modulo']);
    $response->getBody()->write(json_encode($array));
    return $response->withHeader('Content-Type', 'application/json');
});