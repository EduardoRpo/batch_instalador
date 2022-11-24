<?php

use BatchRecord\dao\ValidacionFirmasDao;

$controlFirmasDao = new ValidacionFirmasDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/validacionFirmas', function (Request $request, Response $response, $args) use ($controlFirmasDao) {
    $mDate = new DateTime('now', new DateTimeZone('America/Bogota'));
    $fecha_hoy = $mDate->format("Y") . '-' . $mDate->format("m") . '-' . $mDate->format("d");

    // Consultar firmas y cantidad y actualizar en la tbl de control
    $resp = $controlFirmasDao->findDesinfectanteByDate($fecha_hoy);
    $resp = $controlFirmasDao->findFirmas2SeccionByDate($fecha_hoy);
    $resp = $controlFirmasDao->findConciliacionRendimientoByDate($fecha_hoy);
    $resp = $controlFirmasDao->findMaterialSobranteByDate($fecha_hoy);
    $resp = $controlFirmasDao->findAnalisisMicrobiologicoByDate($fecha_hoy);
    $resp = $controlFirmasDao->findLiberacionByDate($fecha_hoy);

    if ($resp == null)
        $resp = array('success' => true, 'message' => 'Validación de firmas del dia se ejecuto correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras se validaba la información. Intente nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
