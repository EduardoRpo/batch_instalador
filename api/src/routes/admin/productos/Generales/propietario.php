<?php


use BatchRecord\dao\ownerDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$OwnwerDao = new ownerDao();

$app->get('/Owner', function (Request $request, Response $response, $args) use ($OwnwerDao) {
    $Owner = $OwnwerDao->findAllOwner();
    $response->getBody()->write(json_encode($Owner, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteOwner/{id}', function (Request $request, Response $response, $args) use ($OwnwerDao) {
    $Owner = $OwnwerDao->deleteOwner($args['id']);

    if ($Owner == null)
        $resp = array('success' => true, 'message' => 'Propietario eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveOwner', function (Request $request, Response $response, $args) use ($OwnwerDao) {

    $dataOwner = $request->getParsedBody();

    if ($dataOwner['id']) {
        $Owner = $OwnwerDao->updateOwner($dataOwner);

        if ($Owner == null)
            $resp = array('success' => true, 'message' => 'Propietario actualizada correctamente');
    } else {
        $Owner = $OwnwerDao->saveOwner($dataOwner);

        if ($Owner == null)
            $resp = array('success' => true, 'message' => 'Propietario almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
    