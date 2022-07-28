<?php


use BatchRecord\dao\EscherichiaDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$escherichiaDao = new EscherichiaDao();

$app->get('/Escherichia', function (Request $request, Response $response, $args) use ($escherichiaDao) {
    $Escherichia = $escherichiaDao->findAllEscherichia();
    $response->getBody()->write(json_encode($Escherichia, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteEscherichia/{id}', function (Request $request, Response $response, $args) use ($escherichiaDao) {
    $Escherichia = $escherichiaDao->deleteEscherichia($args['id']);

    if ($Escherichia == null)
        $resp = array('success' => true, 'message' => 'Recuento eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveEscherichia', function (Request $request, Response $response, $args) use ($escherichiaDao) {

    $dataEscherichia = $request->getParsedBody();

    if ($dataEscherichia['id']) {
        $Escherichia = $escherichiaDao->updateEscherichia($dataEscherichia);

        if ($Escherichia == null)
            $resp = array('success' => true, 'message' => 'Recuento actualizado correctamente');
    } else {
        $Escherichia = $escherichiaDao->saveEscherichia($dataEscherichia);

        if ($Escherichia == null)
            $resp = array('success' => true, 'message' => 'Recuento almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});