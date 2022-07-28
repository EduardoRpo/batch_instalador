<?php


use BatchRecord\dao\containersDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$containersDao = new containersDao();

$app->get('/Containers', function (Request $request, Response $response, $args) use ($containersDao) {
    $Containers = $containersDao->findAllContainers();
    $response->getBody()->write(json_encode($Containers, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteContainers/{id}', function (Request $request, Response $response, $args) use ($containersDao) {
    $Containers = $containersDao->deleteContainers($args['id']);

    if ($Containers == null)
        $resp = array('success' => true, 'message' => 'Envase eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveContainers', function (Request $request, Response $response, $args) use ($containersDao) {

    $dataContainers = $request->getParsedBody();

    if ($dataContainers['operacion']) {
        $Containers = $containersDao->updateContainers($dataContainers);

        if ($Containers == null)
            $resp = array('success' => true, 'message' => 'Envase actualizado correctamente');
    } else {
        $Containers = $containersDao->saveContainers($dataContainers);

        if ($Containers == null)
            $resp = array('success' => true, 'message' => 'Envase almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
    