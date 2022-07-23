<?php


use BatchRecord\dao\lineDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$LineDao = new lineDao();

$app->get('/LineProducts', function (Request $request, Response $response, $args) use ($LineDao) {
    $lines = $LineDao->findAlllines();
    $response->getBody()->write(json_encode($lines, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteLinesproducts/{id}', function (Request $request, Response $response, $args) use ($LineDao) {
    $lines = $LineDao->deleteLines($args['id']);

    if ($lines == null)
        $resp = array('success' => true, 'message' => 'linea eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/savelinesproducts', function (Request $request, Response $response, $args) use ($LineDao) {

    $datalines = $request->getParsedBody();

    if ($datalines['id']) {
        $lines = $LineDao->updatelines($datalines);

        if ($lines == null)
            $resp = array('success' => true, 'message' => 'linea actualizada correctamente');
    } else {
        $lines = $LineDao->savelines($datalines);

        if ($lines == null)
            $resp = array('success' => true, 'message' => 'linea almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
