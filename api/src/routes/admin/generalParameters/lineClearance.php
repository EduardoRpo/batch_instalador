<?php


use BatchRecord\dao\LineClearanceDao;
use BatchRecord\dao\ModulesDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$lineClarenceDao = new LineClearanceDao();


$app->get('/lines', function (Request $request, Response $response, $args) use ($lineClarenceDao) {
    $linesC = $lineClarenceDao->findAllLinesC();
    $response->getBody()->write(json_encode($linesC, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/deletelinesC/{id}', function (Request $request, Response $response, $args) use ($lineClarenceDao) {
    $linesC = $lineClarenceDao->deleteLinesC($args['id']);

    if ($linesC == null)
    $resp = array('success' => true, 'message' => 'linea eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/savelinesC', function (Request $request, Response $response, $args) use ($lineClarenceDao) {

    $datalinesC = $request->getParsedBody();

    if ($datalinesC['id']) {
    $linesC = $lineClarenceDao->updatelinesC($datalinesC);

    if ($linesC == null)
        $resp = array('success' => true, 'message' => 'linea almacenada correctamente');
    } else {
    $linesC = $lineClarenceDao->savelinesC($datalinesC);

    if ($linesC == null)
        $resp = array('success' => true, 'message' => 'linea actualizada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


