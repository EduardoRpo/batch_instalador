<?php

use BatchRecord\dao\PlaneacionDao;
use BatchRecord\dao\PlanPedidosDao;

$planeacionDao = new PlaneacionDao();
$planPedidosDao = new PlanPedidosDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/batchPlaneados', function (Request $request, Response $response, $args) use ($planeacionDao) {
    $planeados = $planeacionDao->findAllBatchPlaneados();
    $response->getBody()->write(json_encode($planeados, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/programPlan', function (Request $request, Response $response, $args) use ($planeacionDao, $planPedidosDao) {
    session_start();
    $dataPedidos = $request->getParsedBody();
    $dataPedidos = $dataPedidos['data'];

    $dataPedidosGranel = $planeacionDao->setDataPedidos($dataPedidos);

    $dataPedidosLotes = $planPedidosDao->checkTamanioLote($dataPedidosGranel);

    /* Guardar dataPedidos */
    for ($i = 0; $i < sizeof($dataPedidosLotes); $i++) {
        foreach ($dataPedidosLotes[$i]['multi'] as $array) {
            $dataSPedidos[$i] = $array;
        }
    }

    $_SESSION['dataPedidos'] = $dataSPedidos;

    $_SESSION['dataGranel'] = $dataPedidosLotes;

    $response->getBody()->write(json_encode($dataPedidosGranel, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
