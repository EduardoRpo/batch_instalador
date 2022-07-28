<?php


use BatchRecord\dao\StaphylococcusDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$staphylococcusDao = new StaphylococcusDao();

$app->get('/Staphylococcus', function (Request $request, Response $response, $args) use ($staphylococcusDao) {
    $Staphylococcus = $staphylococcusDao->findAllStaphylococcus();
    $response->getBody()->write(json_encode($Staphylococcus, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteStaphylococcus/{id}', function (Request $request, Response $response, $args) use ($staphylococcusDao) {
    $Staphylococcus = $staphylococcusDao->deleteStaphylococcus($args['id']);

    if ($Staphylococcus == null)
        $resp = array('success' => true, 'message' => 'Staphylococcus eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveStaphylococcus', function (Request $request, Response $response, $args) use ($staphylococcusDao) {

    $dataStaphylococcus = $request->getParsedBody();

    if ($dataStaphylococcus['id']) {
        $Staphylococcus = $staphylococcusDao->updateStaphylococcus($dataStaphylococcus);

        if ($Staphylococcus == null)
            $resp = array('success' => true, 'message' => 'Staphylococcus actualizado correctamente');
    } else {
        $Staphylococcus = $staphylococcusDao->saveStaphylococcus($dataStaphylococcus);

        if ($Staphylococcus == null)
            $resp = array('success' => true, 'message' => 'Staphylococcus almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});