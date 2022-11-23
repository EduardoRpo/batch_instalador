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
    $firmas = [];

    $fecha_hoy = date("Y-m-d");

    // Consultar desinfectante
    $firmas = $controlFirmasDao->findDesinfectanteByDate($fecha_hoy);

    // Consultar firmas2Seccion
    $firmas = $controlFirmasDao->findFirmas2SeccionByDate($fecha_hoy, $firmas);

    // Consultar Analisis Microbiologico
    $firmas = $controlFirmasDao->findAnalisisMicrobiologicoByDate($fecha_hoy, $firmas);

    // Consultar Conciliacion Rendimiento
    $firmas = $controlFirmasDao->findConciliacionRendimientoByDate($fecha_hoy, $firmas);

    // Consultar Material Sobrante
    $firmas = $controlFirmasDao->findMaterialSobranteByDate($fecha_hoy, $firmas);

    // Consultar Liberacion
    $resolution = $controlFirmasDao->findLiberacionByDate($fecha_hoy, $firmas);



    // $firmasGestionadas = $controlFirmasDao->validarFirmasGestionadas($batch[$i]['id_batch'], $firmas);

    //Validacion firmas totales
    // $firmasTotales = $controlFirmasMultiDao->controlFirmasMulti($batch[$i]['id_batch']);
    // }

    if ($resolution == null)
        $resp = array('success' => true, 'message' => 'Validación de firmas del dia se ejecuto correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras se validaba la información. Intente nuevamente');
    // } else
    // $resp = array('info' => true, 'message' => 'No se ha firmado ningun batch el dia de hoy');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
