<?php


use BatchRecord\dao\PositionDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$positionDao = new PositionDao();

$app->get('/position', function (Request $request, Response $response, $args) use ($positionDao) {
$position = $positionDao->findAllposition();
$response->getBody()->write(json_encode($position, JSON_NUMERIC_CHECK));
return $response->withHeader('Content-Type', 'application/json');

});
$app->get('/deletePosition/{id}', function (Request $request, Response $response, $args) use ($positionDao) {
$position = $positionDao->deletePosition($args['id']);

if ($position == null)
    $resp = array('success' => true, 'message' => 'Cargo eliminado correctamente');

$response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveposition', function (Request $request, Response $response, $args) use ($positionDao) {

$dataposition = $request->getParsedBody();

if ($dataposition['id']) {
    $position = $positionDao->updatePosition($dataposition);

    if ($position == null)
    $resp = array('success' => true, 'message' => 'Cargo actualizado correctamente');
} else {
    $position = $positionDao->savePosition($dataposition);

    if ($position == null)
    $resp = array('success' => true, 'message' => 'Cargo almacenado correctamente');
}

$response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
return $response->withHeader('Content-Type', 'application/json');
});
