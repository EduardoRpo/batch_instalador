<?php


use BatchRecord\dao\lidDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$lidDao = new lidDao();

$app->get('/Lid', function (Request $request, Response $response, $args) use ($lidDao) {
    $Lid = $lidDao->findAllLid();
    $response->getBody()->write(json_encode($Lid, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteLid/{id}', function (Request $request, Response $response, $args) use ($lidDao) {
    $Lid = $lidDao->deleteLid($args['id']);

    if ($Lid == null)
        $resp = array('success' => true, 'message' => 'Tapas eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveLid', function (Request $request, Response $response, $args) use ($lidDao) {

    $dataLid = $request->getParsedBody();

    if ($dataLid['operacion']) {
        $Lid = $lidDao->updateLid($dataLid);

        if ($Lid == null)
            $resp = array('success' => true, 'message' => 'Tapas actualizada correctamente');
    } else {
        $Lid = $lidDao->saveLid($dataLid);

        if ($Lid == null)
            $resp = array('success' => true, 'message' => 'Tapas almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
    