<?php

use BatchRecord\dao\ValidacionFirmasDao;
use BatchRecord\dao\BatchDao;
use BatchRecord\dao\ControlFirmasMultiDao;

$batchDao = new BatchDao();
$controlFirmasDao = new ValidacionFirmasDao();
$controlFirmasMultiDao = new ControlFirmasMultiDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/validacionFirmas', function (Request $request, Response $response, $args) use ($controlFirmasDao, $controlFirmasMultiDao) {
    // $batch = $controlFirmasDao->findAllBatchByDate();

    // if (sizeof($batch) >= 1 && $batch['estado'] != 0) {
    // for ($i = 0; $i < sizeof($batch); $i++) {
    /* Validacion firmas gestionadas */
    //$firmas = [];

    //$fecha_hoy = date("Y-m-d");
    $mDate = new DateTime('now', new DateTimeZone('America/Bogota'));
    $fecha_hoy = $mDate->format("Y") . '-' . $mDate->format("m") . '-' . $mDate->format("d");

    // Consultar firmas y cantidad y actualizar en la tbl de control
    $resp = $controlFirmasDao->findDesinfectanteByDate($fecha_hoy);
    $resp = $controlFirmasDao->findFirmas2SeccionByDate($fecha_hoy);
    $resp = $controlFirmasDao->findConciliacionRendimientoByDate($fecha_hoy);
    $resp = $controlFirmasDao->findMaterialSobranteByDate($fecha_hoy);
    $resp = $controlFirmasDao->findAnalisisMicrobiologicoByDate($fecha_hoy);
    $resp = $controlFirmasDao->findLiberacionByDate($fecha_hoy);

    //Actualizar firmas gestionadas    

    //$firmasGestionadas = $controlFirmasDao->validarFirmasGestionadas($batch[$i]['id_batch'], $firmas);

    //Validacion firmas totales
    //$firmasTotales = $controlFirmasMultiDao->controlFirmasMulti($batch[$i]['id_batch']);
    // }

    if ($resp == null)
        $resp = array('success' => true, 'message' => 'Validación de firmas del dia se ejecuto correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras se validaba la información. Intente nuevamente');
    // } else
    // $resp = array('info' => true, 'message' => 'No se ha firmado ningun batch el dia de hoy');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
