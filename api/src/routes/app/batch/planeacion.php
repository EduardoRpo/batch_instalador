<?php

use BatchRecord\dao\PlaneacionDao;

$planeacionDao = new PlaneacionDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/programPlan', function (Request $request, Response $response, $args) use ($planeacionDao) {
    session_start();
    $dataPedidos = $request->getParsedBody();
    $dataPedidos = $dataPedidos['data'];

    $_SESSION['dataPedidos'] = $dataPedidos;

    $dataPedidosGranel = $planeacionDao->setDataPedidos($dataPedidos);

    $_SESSION['dataGranel'] = $dataPedidosGranel;

    $response->getBody()->write(json_encode($dataPedidosGranel, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
