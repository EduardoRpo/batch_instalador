<?php

use BatchRecord\dao\BatchDao;
use BatchRecord\dao\validacionFirmasDao;
use BatchRecord\dao\ControlFirmasMultiDao;

$validacionFirmasDao = new ValidacionFirmasDao();
$batchDao = new BatchDao();
$controlFirmasMultiDao = new ControlFirmasMultiDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/validacionFirmas', function (Request $request, Response $response, $args) use ($batchDao, $validacionFirmasDao, $controlFirmasMultiDao) {
    $dataBatch = $request->getParsedBody();
    // Consultar batchs
    $batchs = $batchDao->findBatchByMinAndMax($dataBatch);

    $fecha_hoy = date('Y-m-d');

    for ($i = 0; $i < sizeof($batchs); $i++) {
        // Consultar firmas y cantidad y actualizar en la tbl de control
        $resp = $validacionFirmasDao->findDesinfectanteByDate($batchs[$i]['id_batch'], $fecha_hoy);
        $resp = $validacionFirmasDao->findFirmas2SeccionByDate($batchs[$i]['id_batch'], $fecha_hoy);
        $resp = $validacionFirmasDao->findConciliacionRendimientoByDate($batchs[$i]['id_batch'], $fecha_hoy);
        $resp = $validacionFirmasDao->findMaterialSobranteByDate($batchs[$i]['id_batch'], $fecha_hoy);
        $resp = $validacionFirmasDao->findAnalisisMicrobiologicoByDate($batchs[$i]['id_batch'], $fecha_hoy);
        $resp = $validacionFirmasDao->findLiberacionByDate($batchs[$i]['id_batch'], $fecha_hoy);

        // Validar firmas totales
        $resp = $controlFirmasMultiDao->controlCantidadFirmas($batchs[$i]['id_batch']);
        $resp = $controlFirmasMultiDao->controlFirmasMulti($batchs[$i]['id_batch']);
    }

    if ($resp == null)
        $resp = array('success' => true, 'message' => 'Validación de firmas del dia se ejecuto correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras se validaba la información. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
