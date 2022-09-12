<?php


use BatchRecord\dao\othersDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$othersDao = new othersDao();

$app->get('/others', function (Request $request, Response $response, $args) use ($othersDao) {
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

    if ($dataOthers['ref']) {
        $data = $othersDao->findOthersByRef($dataOthers['ref']);

        if ($data) {
            $others = $othersDao->updateOthers($dataOthers);
            if ($others == null)
                $resp = array('success' => true, 'message' => 'Otro actualizado correctamente');
        } else {
            $others = $othersDao->saveOthers($dataOthers);

            if ($others == null)
                $resp = array('success' => true, 'message' => 'Otro almacenado correctamente');
        }
    } else
        $resp = array('error' => true, 'message' => 'Ingrese todos los datos e Intentelo nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
