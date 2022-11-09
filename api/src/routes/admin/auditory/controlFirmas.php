<?php

use BatchRecord\dao\AuditoriaControlFirmasDao;
use BatchRecord\dao\BatchDao;

$batchDao = new BatchDao();
$controlFirmasDao = new AuditoriaControlFirmasDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/validacionFirmas/{id_batch}', function (Request $request, Response $response, $args) use ($batchDao, $controlFirmasDao) {
    $batch = $batchDao->findBatch($args['id_batch']);

    if ($batch['estado'] == 0 || !$batch)
        $resp = array('error' => true, 'message' => 'Batch Eliminado');
    else {
        $resp = $controlFirmasDao->findAllControlFirmasByBatch($args['id_batch']);
    }
    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
