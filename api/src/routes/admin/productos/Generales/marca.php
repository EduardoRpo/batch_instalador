<?php


use BatchRecord\dao\brandDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$BrandDao = new brandDao();

$app->get('/Brands', function (Request $request, Response $response, $args) use ($BrandDao) {
    $brand = $BrandDao->findAllBrand();
    $response->getBody()->write(json_encode($brand, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deletebrand/{id}', function (Request $request, Response $response, $args) use ($BrandDao) {
    $brand = $BrandDao->deleteBrand($args['id']);

    if ($brand == null)
        $resp = array('success' => true, 'message' => 'marca eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/savebrand', function (Request $request, Response $response, $args) use ($BrandDao) {

    $databrand = $request->getParsedBody();

    if ($databrand['id']) {
        $brand = $BrandDao->updateBrand($databrand);

        if ($brand == null)
            $resp = array('success' => true, 'message' => 'marca actualizada correctamente');
    } else {
        $brand = $BrandDao->saveBrand($databrand);

        if ($brand == null)
            $resp = array('success' => true, 'message' => 'marca almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
    