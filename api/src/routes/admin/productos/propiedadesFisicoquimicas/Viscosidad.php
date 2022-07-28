<?php


use BatchRecord\dao\ViscosityDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$viscosityDao = new ViscosityDao();

$app->get('/Viscosity', function (Request $request, Response $response, $args) use ($viscosityDao) {
    $Viscosity = $viscosityDao->findAllViscosity();
    $response->getBody()->write(json_encode($Viscosity, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteViscosity/{id}', function (Request $request, Response $response, $args) use ($viscosityDao) {
    $Viscosity = $viscosityDao->deleteViscosity($args['id']);

    if ($Viscosity == null)
        $resp = array('success' => true, 'message' => 'Viscosidad eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveViscosity', function (Request $request, Response $response, $args) use ($viscosityDao) {

    $dataViscosity = $request->getParsedBody();

    if ($dataViscosity['id']) {
        $Viscosity = $viscosityDao->updateViscosity($dataViscosity);

        if ($Viscosity == null)
            $resp = array('success' => true, 'message' => 'Viscosidad actualizada correctamente');
    } else {
        $Viscosity = $viscosityDao->saveViscosity($dataViscosity);

        if ($Viscosity == null)
            $resp = array('success' => true, 'message' => 'Viscosidad almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});