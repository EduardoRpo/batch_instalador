<?php


use BatchRecord\dao\lidDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$lidDao = new lidDao();

$app->get('/lids', function (Request $request, Response $response, $args) use ($lidDao) {
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

    if ($dataLid['ref']) {
        $data = $lidDao->findLidByRef($dataLid['ref']);

        if ($data) {
            $Lid = $lidDao->updateLid($dataLid);
            if ($Lid == null)
                $resp = array('success' => true, 'message' => 'Tapa actualizada correctamente');
        } else {
            $Lid = $lidDao->saveLid($dataLid);
            if ($Lid == null)
                $resp = array('success' => true, 'message' => 'Tapa almacenada correctamente');
        }
    } else
        $resp = array('error' => true, 'message' => 'Ingrese todos los datos e Intentelo nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
