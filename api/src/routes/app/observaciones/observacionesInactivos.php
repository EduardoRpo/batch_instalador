<?php

use BatchRecord\dao\ObservacionesInactivosDao;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$inactivosDao = new ObservacionesInactivosDao();

$app->get('/observacionesInactivos', function (Request $request, Response $response, $args) use ($inactivosDao) {
    $inactivos = $inactivosDao->findAllObservaciones();
    $response->getBody()->write(json_encode($inactivos, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/addObservacion', function (Request $request, Response $response, $args) use ($inactivosDao) {
    $dataBatch = $request->getParsedBody();
    $inactivos = $inactivosDao->updateObservacion($dataBatch);

    if ($inactivos == null)
        $resp = array('success' => true, 'message' => 'Observación creada correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras ingresaba la observación. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
