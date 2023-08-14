<?php

use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\DesinfectanteDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$desinfectanteDao = new DesinfectanteDao();
$controFirmasDao = new ControlFirmasDao();

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
