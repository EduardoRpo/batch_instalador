<?php


use BatchRecord\dao\ColorDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$colorDao = new ColorDao();

$app->get('/Color', function (Request $request, Response $response, $args) use ($colorDao) {
    $Color = $colorDao->findAllColor();
    $response->getBody()->write(json_encode($Color, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteColor/{id}', function (Request $request, Response $response, $args) use ($colorDao) {
    $Color = $colorDao->deleteColor($args['id']);

    if ($Color == null)
        $resp = array('success' => true, 'message' => 'Color eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveColor', function (Request $request, Response $response, $args) use ($colorDao) {

    $dataColor = $request->getParsedBody();

    if ($dataColor['id']) {
        $Color = $colorDao->updateColor($dataColor);

        if ($Color == null)
            $resp = array('success' => true, 'message' => 'Color actualizado correctamente');
    } else {
        $Color = $colorDao->saveColor($dataColor);

        if ($Color == null)
            $resp = array('success' => true, 'message' => 'Color almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});