<?php

use BatchRecord\dao\CapacidadFirmasDao;
use BatchRecord\dao\BatchDao;

$batchDao = new BatchDao();
$controlFirmasDao = new CapacidadFirmasDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/validacionFirmas', function (Request $request, Response $response, $args) use ($batchDao, $controlFirmasDao) {
    // $dataBatch = $request->getParsedBody();

    // foreach ($dataBatch as $value) {
    //     $batch = $batchDao->findBatch($value);

    //     if(!$bacth)
    //      $
    // }



    // $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    // return $response->withHeader('Content-Type', 'application/json');
});
