<?php


use BatchRecord\dao\BaseDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$baseDao = new BaseDao();

$app->get('/baseInstructive', function (Request $request, Response $response, $args) use ($baseDao) {
    $base = $baseDao->findAllProductsInstructive();
    $response->getBody()->write(json_encode($base, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
$app->get('/getNameBase/{referencia}', function (Request $request, Response $response, $args) use ($baseDao){
    $base = $baseDao->nombreProductBase($args['referencia']);
    $response->getBody()->write(json_encode($base, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/deleteBaseInstructive', function (Request $request, Response $response, $args) use ($baseDao) {
    $dataBase = $request->getParsedBody();
    $base = $baseDao->deleteBase($dataBase);

    if ($base == null)
        $resp = array('success' => true, 'message' => 'base eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveBaseInstructive', function (Request $request, Response $response, $args) use ($baseDao) {

    $database = $request->getParsedBody();

    if ($database['id']) {
        $base = $baseDao->updateBase($database);

        if ($base == null)
            $resp = array('success' => true, 'message' => 'base actualizada correctamente');
    } else {
        $base = $baseDao->saveBase($database);

        if ($base == null)
            $resp = array('success' => true, 'message' => 'base almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});