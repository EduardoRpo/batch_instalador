<?php

use BatchRecord\dao\ValidacionFirmasDao;
use BatchRecord\dao\BatchDao;

$batchDao = new BatchDao();
$controlFirmasDao = new ValidacionFirmasDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/validacionFirmas', function (Request $request, Response $response, $args) use ($batchDao, $controlFirmasDao) {
    $batch = $controlFirmasDao->findAllBatchByDate();

    if (sizeof($batch) >= 1) {
        for ($i = 0; $i < sizeof($batch); $i++) {
            $controlFirmas = $controlFirmasDao->updateControlFirmas($batch[$i]['id_batch']);
        }

        if ($controlFirmas == null)
            $resp = array('success' => true, 'message' => 'Validación de firmas del dia se ejecuto correctamente');
        else
            $resp = array('error' => true, 'message' => 'Ocurrio un error mientras se validaba la información. Intente nuevamente');
    } else
        $resp = array('info' => true, 'message' => 'No se ha firmado ningun batch el dia de hoy');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
