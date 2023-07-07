<?php

use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\LiberacionDao;

$liberacionDao = new LiberacionDao();
$controlFirmasDao = new ControlFirmasDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/liberacion', function (Request $request, Response $response, $args) use ($liberacionDao, $controlFirmasDao) {
    $dataBatch = $request->getParsedBody();
    $dataBatch = $dataBatch['data'][0];

    $batch = $dataBatch['idBatch'];
    $btn = $dataBatch['id'];

    $result = null;

    if ($btn == 'tecnica_realizado') {
        $firmas = $liberacionDao->findFirmasControlRealizado($batch, 7);

        if ($firmas['cantidad_firmas'] != $firmas['total_firmas']) $result = 1;
    }

    if ($result == null) {
        $result = $liberacionDao->liberacionLote($dataBatch);
        $controlFirmasDao->registrarFirmas($dataBatch);
    }

    $response->getBody()->write(json_encode($result, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
