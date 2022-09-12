<?php


use BatchRecord\dao\containersDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$containersDao = new containersDao();

$app->get('/containers', function (Request $request, Response $response, $args) use ($containersDao) {
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

    if ($dataContainers['ref']) {
        $data = $containersDao->findContainersByRef($dataContainers['ref']);

        if ($data) {
            $data = $containersDao->updateContainers($dataContainers);
            if ($data == null)
                $resp = array('success' => true, 'message' => 'Envase actualizado correctamente');
            else
                $resp = array('error' => true, 'message' => 'Ocurrio un error. Intentelo nuevamente');
        } else {
            $data = $containersDao->saveContainers($dataContainers);
            if ($data == null)
                $resp = array('success' => true, 'message' => 'Envase almacenado correctamente');
            else
                $resp = array('error' => true, 'message' => 'Ocurrio un error. Intentelo nuevamente');
        }
    } else
        $resp = array('error' => true, 'message' => 'Ingrese todos los datos e Intentelo nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
