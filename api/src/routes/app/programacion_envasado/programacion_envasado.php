<?php

use BatchRecord\dao\ProgramacionEnvasadoDao;

$prgEnvasadoDao = new ProgramacionEnvasadoDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/addFechaEnvasado', function (Request $request, Response $response, $args) use ($prgEnvasadoDao) {
    $dataEnvasado = $request->getParsedBody();

    $envasado = $dataEnvasado['data'];

    for ($i = 0; $i < sizeof($envasado); $i++) {
        $programaEnvasado = $prgEnvasadoDao->updateFechaEnvasado($envasado[$i]);
    }
    if ($programaEnvasado == null)
        $resp = array('success' => true, 'message' => 'Envasado programado correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras programaba el envasado');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
