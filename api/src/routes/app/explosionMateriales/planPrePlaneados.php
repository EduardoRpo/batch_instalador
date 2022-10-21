<?php

use BatchRecord\dao\PlanPrePlaneadosDao;

$planPrePlaneadosDao = new PlanPrePlaneadosDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/prePlaneados', function (Request $request, Response $response, $args) use ($planPrePlaneadosDao) {
    $prePlaneados = $planPrePlaneadosDao->findAllPrePlaneados();

    $response->getBody()->write(json_encode($prePlaneados, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/addPrePlaneados', function (Request $request, Response $response, $args) use ($planPrePlaneadosDao) {
    session_start();
    $dataPedidos = $request->getParsedBody();
    $date = $dataPedidos['date'];
    $sim = $dataPedidos['simulacion'];
    $dataPedidos = $_SESSION['dataGranel'];


    for ($i = 0; $i < sizeof($dataPedidos); $i++) {
        $dataPedidos[$i]['programacion'] = $date;
        $dataPedidos[$i]['simulacion'] = $sim;
        // Guardar pedidos a pre planeado
        $prePlaneados = $planPrePlaneadosDao->insertPrePlaneados($dataPedidos[$i], $dataPedidos[$i]['multi']);
    }

    if ($prePlaneados == null)
        $resp = array('success' => true, 'message' => 'Pedidos pre planeados correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras ingresaba la información. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
