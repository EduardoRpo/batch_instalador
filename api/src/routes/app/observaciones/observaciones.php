<?php

use BatchRecord\dao\ObservacionesDao;
use BatchRecord\dao\ObservacionesInactivosDao;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$inactivosDao = new ObservacionesInactivosDao();
$observacionesDao = new ObservacionesDao();

/* Batch Envasado y acondicionamiento */
$app->post('/observaciones', function (Request $request, Response $response, $args) use ($observacionesDao) {
    $dataBatch = $request->getParsedBody();
    $observaciones = $observacionesDao->findObservaciones($dataBatch);

    if (!$observaciones)
        $observaciones = array('empty' => true);

    $response->getBody()->write(json_encode($observaciones, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/addObservacion', function (Request $request, Response $response, $args) use ($observacionesDao) {
    $dataBatch = $request->getParsedBody();
    $observaciones = $observacionesDao->insertObservacion($dataBatch);

    if ($observaciones == null)
        $resp = array('success' => true, 'message' => 'Observación creada correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras ingresaba la observación. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Batch planeacion inactivos y activos */
$app->post('/observacionesInactivos', function (Request $request, Response $response, $args) use ($inactivosDao) {
    $dataBatch = $request->getParsedBody();
    $inactivos = $inactivosDao->findObservaciones($dataBatch);

    if (!$inactivos)
        $inactivos = array('empty' => true);

    $response->getBody()->write(json_encode($inactivos, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/addObservacionInactivos', function (Request $request, Response $response, $args) use ($inactivosDao) {
    $dataBatch = $request->getParsedBody();
    $inactivos = $inactivosDao->insertObservacion($dataBatch);

    if ($inactivos == null)
        $resp = array('success' => true, 'message' => 'Observación creada correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras ingresaba la observación. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
