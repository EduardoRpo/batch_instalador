<?php

use BatchRecord\dao\PlaneacionDao;
use BatchRecord\dao\PlanPedidosDao;

$planeacionDao = new PlaneacionDao();
$planPedidosDao = new PlanPedidosDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/batchPlaneados', function (Request $request, Response $response, $args) use ($planeacionDao) {
  try {
    $planeados = $planeacionDao->findAllBatchPlaneados();
    $response->getBody()->write(json_encode($planeados, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
  } catch (Exception $e) {
    // En caso de error, devolver array vacío
    $errorResponse = [
      'error' => true,
      'message' => 'Error al obtener datos de batch planeados: ' . $e->getMessage(),
      'data' => []
    ];
    $response->getBody()->write(json_encode($errorResponse, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
  }
});

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
