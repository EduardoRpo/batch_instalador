<?php

use BatchRecord\dao\CapacidadEnvasadoDao;

$capacidadEnvasadoDao = new CapacidadEnvasadoDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/capacidadEnvasado', function (Request $request, Response $response, $args) use ($capacidadEnvasadoDao) {
    $envasado = $capacidadEnvasadoDao->findCapacidadEnvasado();
    $response->getBody()->write(json_encode($envasado, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/updateCapacidadEnvasado', function (Request $request, Response $response, $args) use ($capacidadEnvasadoDao) {
    $dataEnvasado = $request->getParsedBody();

    if (empty($dataEnvasado['idEnvasado']) || empty($dataEnvasado['turno1']) || empty($dataEnvasado['turno2']) || empty($dataEnvasado['turno3']))
        $resp = array('error' => true, 'message' => 'Ingrese todos los campos');
    else {
        $envasado = $capacidadEnvasadoDao->updateCapacidadEnvasado($dataEnvasado);

        if ($envasado == null)
            $resp = array('success' => true, 'message' => 'Capacidad de envasado modificada correctamente');
        else
            $resp = array('error' => true, 'message' => 'Ocurrio un error mientras modificaba la información. Intente nuevamente');
    }
    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
