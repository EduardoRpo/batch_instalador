<?php

use BatchRecord\dao\calcTamanioMultiDao;
use BatchRecord\dao\PlanPedidosDao;
use BatchRecord\dao\PlanPrePlaneadosDao;

$planPrePlaneadosDao = new PlanPrePlaneadosDao();
$planPedidosDao = new PlanPedidosDao();
$calcTamanioMultiDao = new calcTamanioMultiDao();


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/prePlaneados', function (Request $request, Response $response, $args) use ($planPrePlaneadosDao) {
    $prePlaneados = $planPrePlaneadosDao->findAllPrePlaneados();

    $response->getBody()->write(json_encode($prePlaneados, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/addPrePlaneados', function (Request $request, Response $response, $args) use ($planPrePlaneadosDao, $planPedidosDao) {
    session_start();
    $dataPedidos = $request->getParsedBody();
    $date = $dataPedidos['date'];
    $sim = $dataPedidos['simulacion'];
    
    // Validar que dataGranel existe en la sesión
    if (!isset($_SESSION['dataGranel']) || empty($_SESSION['dataGranel'])) {
        $resp = array('error' => true, 'message' => 'No hay datos de granel en la sesión');
        $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
        return $response->withHeader('Content-Type', 'application/json');
    }
    
    $dataPedidos = $_SESSION['dataGranel'];

    for ($i = 0; $i < sizeof($dataPedidos); $i++) {
        $dataPedidos[$i]['programacion'] = $date;
        $dataPedidos[$i]['simulacion'] = $sim;
        
        // Log para debugging
        error_log('🔍 Insertando pedido: ' . json_encode($dataPedidos[$i]));
        
        // Guardar pedidos a pre planeado
        $prePlaneados = $planPrePlaneadosDao->insertPrePlaneados($dataPedidos[$i]);
        
        // Log del resultado
        error_log('🔍 Resultado de inserción: ' . json_encode($prePlaneados));
    }

    if ($prePlaneados == null)
        $resp = array('success' => true, 'message' => 'Pedidos pre planeados correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras ingresaba la información. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/updatePlaneados', function (Request $request, Response $response, $args) use ($planPrePlaneadosDao) {
    $dataPedidos = $request->getParsedBody();
    $dataPedidos = $dataPedidos['data'];

    for ($i = 0; $i < sizeof($dataPedidos); $i++) {
        $prePlaneados = $planPrePlaneadosDao->updatePlaneado($dataPedidos[$i]);
    }

    if ($prePlaneados == null)
        $resp = array('success' => true, 'message' => 'Pedidos planeados correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras planeaba la información. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/updateUnidadLote', function (Request $request, Response $response, $args) use ($planPrePlaneadosDao, $calcTamanioMultiDao) {
    $dataPedidos = $request->getParsedBody();

    /* Recalcular tamanio lote */
    $tamano_lote = $calcTamanioMultiDao->calcularTamanioLote($dataPedidos, $dataPedidos['unidad']);

    $prePlaneados = $planPrePlaneadosDao->updateUnidadLote($dataPedidos, $tamano_lote);

    if ($prePlaneados == null)
        $resp = array('success' => true, 'message' => 'Pedido modificado correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras modificaba la información. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/clearPrePlaneados/{simulacion}', function (Request $request, Response $response, $args) use ($planPrePlaneadosDao) {
    $prePlaneados = $planPrePlaneadosDao->clearPlanPrePlaneados($args['simulacion']);

    if ($prePlaneados == null)
        $resp = array('success' => true, 'message' => 'Pedidos pre planeados limpiados correctamente');

    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras limpiaba la información. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deletePrePlaneacion/{id}', function (Request $request, Response $response, $args) use ($planPrePlaneadosDao) {
    $prePlaneados = $planPrePlaneadosDao->deletePlaneado($args['id']);

    if ($prePlaneados == null)
        $resp = array('success' => true, 'message' => 'Pedido eliminado correctamente');

    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras eliminaba la información. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
