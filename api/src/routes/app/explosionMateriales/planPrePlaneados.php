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
    
    error_log('🔍 addPrePlaneados - dataPedidos recibido: ' . json_encode($dataPedidos));
    error_log('🔍 addPrePlaneados - date: ' . $date);
    error_log('🔍 addPrePlaneados - sim: ' . $sim);
    error_log('🔍 addPrePlaneados - pedidosLotes recibido: ' . json_encode($dataPedidos['pedidosLotes'] ?? 'NO EXISTE'));
    error_log('🔍 addPrePlaneados - session dataGranel existe: ' . (isset($_SESSION['dataGranel']) ? 'SÍ' : 'NO'));
    error_log('🔍 addPrePlaneados - session dataGranel: ' . json_encode($_SESSION['dataGranel'] ?? 'NO EXISTE'));
    
    // Validar que pedidosLotes existe en la request
    if (!isset($dataPedidos['pedidosLotes']) || empty($dataPedidos['pedidosLotes'])) {
        $resp = array('error' => true, 'message' => 'No hay datos de pedidos en la request');
        error_log('❌ addPrePlaneados - Error: No hay datos de pedidos en la request');
        $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
        return $response->withHeader('Content-Type', 'application/json');
    }
    
        // Usar los datos que vienen directamente en la request
    $pedidosLotes = $dataPedidos['pedidosLotes'];
    
    for ($i = 0; $i < sizeof($pedidosLotes); $i++) {
        $pedido = $pedidosLotes[$i];
        $pedido['programacion'] = $date;
        $pedido['simulacion'] = $sim;
        
        // Log para debugging
        error_log('🔍 Insertando pedido ' . $i . ': ' . json_encode($pedido));
        
        // Guardar pedidos a pre planeado
        $prePlaneados = $planPrePlaneadosDao->insertPrePlaneados($pedido);
        
        // Log del resultado
        error_log('🔍 Resultado de inserción ' . $i . ': ' . json_encode($prePlaneados));
        
        // Si hay error, salir del bucle
        if ($prePlaneados !== null) {
            error_log('❌ Error en inserción ' . $i . ': ' . json_encode($prePlaneados));
            break;
        } else {
            error_log('✅ Inserción ' . $i . ' exitosa (prePlaneados es null)');
        }
    }

    error_log('🔍 addPrePlaneados - Resultado final prePlaneados: ' . json_encode($prePlaneados));
    error_log('🔍 addPrePlaneados - Tipo de prePlaneados: ' . gettype($prePlaneados));
    error_log('🔍 addPrePlaneados - prePlaneados === null: ' . ($prePlaneados === null ? 'true' : 'false'));
    
    if ($prePlaneados == null) {
        $resp = array('success' => true, 'message' => 'Pedidos pre planeados correctamente');
        error_log('✅ addPrePlaneados - Respuesta de éxito: ' . json_encode($resp));
    } else {
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras ingresaba la información. Intente nuevamente');
        error_log('❌ addPrePlaneados - Respuesta de error: ' . json_encode($resp));
    }

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
