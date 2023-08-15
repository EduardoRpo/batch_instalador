<?php

use BatchRecord\dao\MuestrasDao;

$muestrasDao = new MuestrasDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/muestras/{id_batch}', function (Request $request, Response $response, $args) use ($muestrasDao) {
    $muestras = $muestrasDao->findAllByIdBatch($args['id_batch']);
    $response->getBody()->write(json_encode($muestras, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/muestras-acondicionamiento/{id_batch}', function (Request $request, Response $response, $args) use ($muestrasDao) {
    $acondicionamiento = $muestrasDao->findAllAcondicionamientoByBatchAndModulo($args['id_batch']);
    $response->getBody()->write(json_encode($acondicionamiento, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/muestras', function (Request $request, Response $response, $args) use ($muestrasDao) {
    $dataBatch = $request->getParsedBody();
    $muestras = $muestrasDao->findByIdBatchAndModulo($dataBatch);
    $response->getBody()->write(json_encode($muestras, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/promedio-muestras', function (Request $request, Response $response, $args) use ($muestrasDao) {
    $dataBatch = $request->getParsedBody();
    $muestras = $muestrasDao->findPromedioByBatch($dataBatch);
    $response->getBody()->write(json_encode($muestras, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/muestras-acondicionamiento', function (Request $request, Response $response, $args) use ($muestrasDao) {
    $dataBatch = $request->getParsedBody();
    $acondicionamiento = $muestrasDao->findAllAcondicionamientoByBatchAndModulo($dataBatch);
    $response->getBody()->write(json_encode($acondicionamiento, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/muestras-envasado', function (Request $request, Response $response, $args) use ($muestrasDao) {
    $dataBatch = $request->getParsedBody();

    $rows = $muestrasDao->findByIdBatchAndModulo($dataBatch);

    $result = null;

    if (sizeof($rows) > 0) {
        $muestras = $dataBatch['muestras'];

        for ($i = 0; $i < sizeof($muestras); $i++) {
            $result = $muestrasDao->insertMuestrasByBatch($dataBatch, $muestras[$i]);

            if (isset($result['info'])) break;
        }
    }

    if ($result == null)
        $resp = array('success' => true, 'message' => 'Firmado correctamente');
    elseif (isset($result['info']))
        $resp = array('info' => true, 'message' => $result['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
