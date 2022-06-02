<?php


use BatchRecord\Dao\ProductDao;
use BatchRecord\dao\ControlProcesoDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$productDao = new ProductDao();
$controlProcesoDao = new ControlProcesoDao();

$app->get('/products', function (Request $request, Response $response, $args) use ($productDao) {
    $products = $productDao->findAll();
    $response->getBody()->write(json_encode($products), JSON_NUMERIC_CHECK);
    return $response;
});

$app->get('/product/{ref}', function (Request $request, Response $response, $args) use ($productDao) {
    $products = $productDao->findProductByRef($args['ref']);
    $response->getBody()->write(json_encode($products), JSON_NUMERIC_CHECK);
    return $response;
});

$app->get('/productsDetails/{idProducto}', function (Request $request, Response $response, $args) use ($productDao) {
    $products = $productDao->findDetailsByProduct($args["idProducto"]);
    $response->getBody()->write(json_encode($products), JSON_NUMERIC_CHECK);
    return $response->withHeader('Content-Type', 'application/json');
    return $response;
});

$app->get('/controlproceso', function (Request $request, Response $response, $args) use ($controlProcesoDao) {
    $array = $controlProcesoDao->findAll();
    $response->getBody()->write(json_encode($array));

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/controlproceso/{idBatch}', function (Request $request, Response $response, $args) use ($controlProcesoDao) {
    $array = $controlProcesoDao->findByBatch($args["idBatch"]);
    $response->getBody()->write(json_encode($array));

    return $response->withHeader('Content-Type', 'application/json');
});
