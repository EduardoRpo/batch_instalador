<?php


use BatchRecord\dao\PhDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$phDao = new PhDao();

$app->get('/ph', function (Request $request, Response $response, $args) use ($phDao) {
    $ph = $phDao->findAllPh();
    $response->getBody()->write(json_encode($ph, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteph/{id}', function (Request $request, Response $response, $args) use ($phDao) {
    $ph = $phDao->deletePh($args['id']);

    if ($ph == null)
        $resp = array('success' => true, 'message' => 'PH eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveph', function (Request $request, Response $response, $args) use ($phDao) {

    $dataph = $request->getParsedBody();

    if ($dataph['id']) {
        $ph = $phDao->updatePh($dataph);

        if ($ph == null)
            $resp = array('success' => true, 'message' => 'PH actualizado correctamente');
    } else {
        $ph = $phDao->savePh($dataph);

        if ($ph == null)
            $resp = array('success' => true, 'message' => 'PH almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});