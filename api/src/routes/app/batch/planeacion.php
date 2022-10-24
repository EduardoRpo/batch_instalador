<?php

use BatchRecord\dao\PlaneacionDao;

$planeacionDao = new PlaneacionDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/programPlan', function (Request $request, Response $response, $args) use ($planeacionDao) {
    session_start();
    $dataPedidos = $request->getParsedBody();

    $dataPedidosGranel = $planeacionDao->setDataPedidos($dataPedidos);

    $_SESSION['dataPedidos'] = $dataPedidosGranel;
});

$app->get('/destroyPedidos', function (Request $request, Response $response, $args) {
    session_start();
    unset($_SESSION['dataPedidos']);
    $response->getBody()->write(json_encode(JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
