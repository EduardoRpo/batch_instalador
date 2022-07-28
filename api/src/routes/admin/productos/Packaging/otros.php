<?php


use BatchRecord\dao\othersDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$othersDao = new othersDao();

$app->get('/Others', function (Request $request, Response $response, $args) use ($othersDao) {
    $Others = $othersDao->findAllOthers();
    $response->getBody()->write(json_encode($Others, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteOthers/{id}', function (Request $request, Response $response, $args) use ($othersDao) {
    $Others = $othersDao->deleteOthers($args['id']);

    if ($Others == null)
        $resp = array('success' => true, 'message' => 'Otro eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveOthers', function (Request $request, Response $response, $args) use ($othersDao) {

    $dataOthers = $request->getParsedBody();

    if ($dataOthers['operacion']) {
        $Others = $othersDao->updateOthers($dataOthers);

        if ($Others == null)
            $resp = array('success' => true, 'message' => 'Otro actualizado correctamente');
    } else {
        $Others = $othersDao->saveOthers($dataOthers);

        if ($Others == null)
            $resp = array('success' => true, 'message' => 'Otro almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
    