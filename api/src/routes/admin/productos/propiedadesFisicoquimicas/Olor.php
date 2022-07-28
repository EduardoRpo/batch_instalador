<?php


use BatchRecord\dao\SmellDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$smellDao = new SmellDao();

$app->get('/Smell', function (Request $request, Response $response, $args) use ($smellDao) {
    $Smell = $smellDao->findAllSmells();
    $response->getBody()->write(json_encode($Smell, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteSmell/{id}', function (Request $request, Response $response, $args) use ($smellDao) {
    $Smell = $smellDao->deleteSmell($args['id']);

    if ($Smell == null)
        $resp = array('success' => true, 'message' => 'Olor eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveSmell', function (Request $request, Response $response, $args) use ($smellDao) {

    $dataSmell = $request->getParsedBody();

    if ($dataSmell['id']) {
        $Smell = $smellDao->updateSmell($dataSmell);

        if ($Smell == null)
            $resp = array('success' => true, 'message' => 'Olor actualizado correctamente');
    } else {
        $Smell = $smellDao->saveSmell($dataSmell);

        if ($Smell == null)
            $resp = array('success' => true, 'message' => 'Olor almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});