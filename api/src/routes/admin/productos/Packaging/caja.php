<?php


use BatchRecord\dao\boxDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$boxDao = new boxDao();

$app->get('/Box', function (Request $request, Response $response, $args) use ($boxDao) {
    $Box = $boxDao->findAllBox();
    $response->getBody()->write(json_encode($Box, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteBox/{id}', function (Request $request, Response $response, $args) use ($boxDao) {
    $Box = $boxDao->deleteBox($args['id']);

    if ($Box == null)
        $resp = array('success' => true, 'message' => 'Caja eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveBox', function (Request $request, Response $response, $args) use ($boxDao) {

    $dataBox = $request->getParsedBody();

    if ($dataBox['operacion']) {
        $Box = $boxDao->updateBox($dataBox);

        if ($Box == null)
            $resp = array('success' => true, 'message' => 'Caja actualizada correctamente');
    } else {
        $Box = $boxDao->saveBox($dataBox);

        if ($Box == null)
            $resp = array('success' => true, 'message' => 'Caja almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
    