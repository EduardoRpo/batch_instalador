<?php

use BatchRecord\dao\PlaneacionDao;
use BatchRecord\dao\PlanPedidosDao;

$planeacionDao = new PlaneacionDao();
$planPedidosDao = new PlanPedidosDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/programPlan', function (Request $request, Response $response, $args) use ($planeacionDao, $planPedidosDao) {
    session_start();
    $dataPedidos = $request->getParsedBody();
    $dataPedidos = $dataPedidos['data'];

    $_SESSION['dataPedidos'] = $dataPedidos;

    $dataPedidosGranel = $planeacionDao->setDataPedidos($dataPedidos);

    $dataPedidosLotes = $planPedidosDao->checkTamanioLote($dataPedidosGranel);

    $_SESSION['dataGranel'] = $dataPedidosLotes;

    $response->getBody()->write(json_encode($dataPedidosGranel, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
