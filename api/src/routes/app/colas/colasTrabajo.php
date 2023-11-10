<?php


use BatchRecord\Dao\BatchLineaDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$batchLineaDao = new BatchLineaDao();

$app->get('/batchEliminados', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $batchEliminados = $batchLineaDao->findBatchEliminados();
    $response->getBody()->write(json_encode($batchEliminados, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/pesajes', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $pesajes = $batchLineaDao->findBatchPesajes();
    $response->getBody()->write(json_encode($pesajes, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/preparacion', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $preparacion = $batchLineaDao->findBatchPrepacion();
    $response->getBody()->write(json_encode($preparacion, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/aprobacion', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $aprobacion = $batchLineaDao->findBatchAprobacion();
    $response->getBody()->write(json_encode($aprobacion, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/envasado', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $envasado = $batchLineaDao->findBatchEnvasado();
    $response->getBody()->write(json_encode($envasado, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/programacionEnvasado', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $envasado = $batchLineaDao->findBatchProgramacionEnvasado();
    $response->getBody()->write(json_encode($envasado, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
$app->get('/programacionEnvasado/{fecha}', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $envasado = $batchLineaDao->findBatchProgramacionEnvasadoByFecha($args['fecha']);
    $response->getBody()->write(json_encode($envasado, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/acondicionamiento', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $acondicionamiento = $batchLineaDao->findBatchAcondicionamiento();
    $response->getBody()->write(json_encode($acondicionamiento, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/despachos', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $despachos = $batchLineaDao->findBatchDespachos();
    $response->getBody()->write(json_encode($despachos, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/microbiologia', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $microbiologia = $batchLineaDao->findBatchMicrobiologia();
    $response->getBody()->write(json_encode($microbiologia, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/fisicoquimica', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $fisicoquimica = $batchLineaDao->findBatchFisicoquimica();
    $response->getBody()->write(json_encode($fisicoquimica, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/liberacionlote', function (Request $request, Response $response, $args) use ($batchLineaDao) {
    $liberacionlote = $batchLineaDao->findBatchliberacionlote();
    $response->getBody()->write(json_encode($liberacionlote, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
