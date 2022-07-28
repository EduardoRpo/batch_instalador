<?php


use BatchRecord\dao\PseudomonaDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$PseudomonaDao = new PseudomonaDao();

$app->get('/Pseudomona', function (Request $request, Response $response, $args) use ($PseudomonaDao) {
    $Pseudomona = $PseudomonaDao->findAllPseudomona();
    $response->getBody()->write(json_encode($Pseudomona, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deletePseudomona/{id}', function (Request $request, Response $response, $args) use ($PseudomonaDao) {
    $Pseudomona = $PseudomonaDao->deletePseudomona($args['id']);

    if ($Pseudomona == null)
        $resp = array('success' => true, 'message' => 'Recuento eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/savePseudomona', function (Request $request, Response $response, $args) use ($PseudomonaDao) {

    $dataPseudomona = $request->getParsedBody();

    if ($dataPseudomona['id']) {
        $Pseudomona = $PseudomonaDao->updatePseudomona($dataPseudomona);

        if ($Pseudomona == null)
            $resp = array('success' => true, 'message' => 'Recuento actualizado correctamente');
    } else {
        $Pseudomona = $PseudomonaDao->savePseudomona($dataPseudomona);

        if ($Pseudomona == null)
            $resp = array('success' => true, 'message' => 'Recuento almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});