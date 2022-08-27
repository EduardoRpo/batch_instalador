<?php


use BatchRecord\dao\DensityDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$densityDao = new DensityDao();

$app->get('/Density', function (Request $request, Response $response, $args) use ($densityDao) {
    $Density = $densityDao->findAllDensity();
    $response->getBody()->write(json_encode($Density, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteDensity/{id}', function (Request $request, Response $response, $args) use ($densityDao) {
    $Density = $densityDao->deleteDensity($args['id']);

    if ($Density == null)
        $resp = array('success' => true, 'message' => 'Densidad eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveDensity', function (Request $request, Response $response, $args) use ($densityDao) {

    $dataDensity = $request->getParsedBody();

    if ($dataDensity['id']) {
        $Density = $densityDao->updateDensity($dataDensity);

        if ($Density == null)
            $resp = array('success' => true, 'message' => 'Densidad actualizado correctamente');
    } else {
        $Density = $densityDao->saveDensity($dataDensity);

        if ($Density == null)
            $resp = array('success' => true, 'message' => 'Densidad almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});