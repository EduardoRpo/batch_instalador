<?php

use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\DesinfectanteDao;
use BatchRecord\dao\EstadoDao;
use BatchRecord\dao\Firmas2SeccionDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$desinfectanteDao = new DesinfectanteDao();
$controFirmasDao = new ControlFirmasDao();
$firmas2SeccionDao = new Firmas2SeccionDao();
$estadosDao = new EstadoDao();

$app->post('/despeje', function (Request $request, Response $response, $args) use (
    $desinfectanteDao,
    $controFirmasDao
) {
    $dataBatch = $request->getParsedBody();
    $result = $desinfectanteDao->desinfectanteVerifico($dataBatch);

    if ($result == null && $dataBatch['modulo'] != 4 && $dataBatch['modulo'] != 8 && $dataBatch['modulo'] != 9)
        $result = $controFirmasDao->registrarFirmas($dataBatch);

    if ($result == null)
        $resp = array('success' => true, 'message' => 'Firmado correctamente');
    elseif (isset($result['info']))
        $resp = array('info' => true, 'message' => $result['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/calidad2seccion', function (Request $request, Response $response, $args) use ($firmas2SeccionDao, $controFirmasDao, $estadosDao) {
    $dataBatch = $request->getParsedBody();

    $result = $firmas2SeccionDao->segundaSeccionVerifico($dataBatch);

    if ($result == null)
        $result = $estadosDao->CerrarBatch($dataBatch);

    if ($result == null)
        $resp = array('success' => true, 'message' => 'Firmado correctamente');
    elseif (isset($result['info']))
        $resp = array('info' => true, 'message' => $result['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
