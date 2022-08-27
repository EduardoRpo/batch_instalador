<?php

use BatchRecord\dao\EnvasadoDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$envasadoDao = new EnvasadoDao();

$app->post('/cargarEntregasParciales', function (Request $request, Response $response, $args) use ($envasadoDao) {
    $data = $request->getParsedBody();
    $entregasParciales = $envasadoDao->findAllEntregasParciales($data);

    $response->getBody()->write(json_encode($entregasParciales, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/entregasparciales', function (Request $request, Response $response, $args) use ($envasadoDao) {
    $entregasParciales = $request->getParsedBody();
    $respons = $envasadoDao->saveEntregasParciales($entregasParciales);

    if ($respons > 0)
        $resp = array('success' => true, 'message' => 'Entrega parcial realizada correctamente', 'value' => $respons);
    else
        $resp = array('error' => true, 'message' => 'Mientras se intentaba guardar se generó un error, intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/entregastotales', function (Request $request, Response $response, $args) use ($envasadoDao) {
    $entregasTotal = $request->getParsedBody();
    $respons = $envasadoDao->saveEntregasTotales($entregasTotal);

    if ($respons > 0)
        $resp = array('success' => true, 'message' => 'Entrega total realizada correctamente', 'value' => $respons);
    else
        $resp = array('error' => true, 'message' => 'Mientras se intentaba guardar se generó un error, intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
