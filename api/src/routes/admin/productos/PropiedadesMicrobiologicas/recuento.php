<?php


use BatchRecord\dao\RecountDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$recountDao = new RecountDao();

$app->get('/Recount', function (Request $request, Response $response, $args) use ($recountDao) {
    $Recount = $recountDao->findAllRecount();
    $response->getBody()->write(json_encode($Recount, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteRecount/{id}', function (Request $request, Response $response, $args) use ($recountDao) {
    $Recount = $recountDao->deleteRecount($args['id']);

    if ($Recount == null)
        $resp = array('success' => true, 'message' => 'Recuento eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveRecount', function (Request $request, Response $response, $args) use ($recountDao) {

    $dataRecount = $request->getParsedBody();

    if ($dataRecount['id']) {
        $Recount = $recountDao->updateRecount($dataRecount);

        if ($Recount == null)
            $resp = array('success' => true, 'message' => 'Recuento actualizado correctamente');
    } else {
        $Recount = $recountDao->saveRecount($dataRecount);

        if ($Recount == null)
            $resp = array('success' => true, 'message' => 'Recuento almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});