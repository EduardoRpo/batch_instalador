<?php


use BatchRecord\dao\unctuousnessDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$unctuousnessDao = new unctuousnessDao();

$app->get('/Unctuousness', function (Request $request, Response $response, $args) use ($unctuousnessDao) {
    $Unctuousness = $unctuousnessDao->findAllUnctuousness();
    $response->getBody()->write(json_encode($Unctuousness, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteUnctuousness/{id}', function (Request $request, Response $response, $args) use ($unctuousnessDao) {
    $Unctuousness = $unctuousnessDao->deleteUnctuousness($args['id']);

    if ($Unctuousness == null)
        $resp = array('success' => true, 'message' => 'Untuosidad eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveUnctuousness', function (Request $request, Response $response, $args) use ($unctuousnessDao) {

    $dataUnctuousness = $request->getParsedBody();

    if ($dataUnctuousness['id']) {
        $Unctuousness = $unctuousnessDao->updateUnctuousness($dataUnctuousness);

        if ($Unctuousness == null)
            $resp = array('success' => true, 'message' => 'Untuosidad actualizada correctamente');
    } else {
        $Unctuousness = $unctuousnessDao->saveUnctuousness($dataUnctuousness);

        if ($Unctuousness == null)
            $resp = array('success' => true, 'message' => 'Untuosidad almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
    