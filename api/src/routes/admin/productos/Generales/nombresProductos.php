<?php


use BatchRecord\dao\NameProductsDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$NameProductsDao = new NameProductsDao();

$app->get('/nameProducts', function (Request $request, Response $response, $args) use ($NameProductsDao) {
    $NameProducts = $NameProductsDao->findAllNameProducts();
    $response->getBody()->write(json_encode($NameProducts, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteNameProducts/{id}', function (Request $request, Response $response, $args) use ($NameProductsDao) {
    $NameProducts = $NameProductsDao->deleteNameProducts($args['id']);

    if ($NameProducts == null)
        $resp = array('success' => true, 'message' => 'producto eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveNameProducts', function (Request $request, Response $response, $args) use ($NameProductsDao) {

    $dataNameProducts = $request->getParsedBody();

    if ($dataNameProducts['id']) {
        $NameProducts = $NameProductsDao->updateNameProducts($dataNameProducts);

        if ($NameProducts == null)
            $resp = array('success' => true, 'message' => 'producto actualizado correctamente');
    } else {
        $NameProducts = $NameProductsDao->saveNameProducts($dataNameProducts);

        if ($NameProducts == null)
            $resp = array('success' => true, 'message' => 'producto almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});