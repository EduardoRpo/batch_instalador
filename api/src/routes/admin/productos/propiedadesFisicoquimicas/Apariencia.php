<?php


use BatchRecord\dao\AppearanceDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$apperanceDao = new AppearanceDao();

$app->get('/Appearance', function (Request $request, Response $response, $args) use ($apperanceDao) {
    $Appearance = $apperanceDao->findAllAppearance();
    $response->getBody()->write(json_encode($Appearance, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteAppearance/{id}', function (Request $request, Response $response, $args) use ($apperanceDao) {
    $Appearance = $apperanceDao->deleteAppearance($args['id']);

    if ($Appearance == null)
        $resp = array('success' => true, 'message' => 'Apariencias eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveAppearance', function (Request $request, Response $response, $args) use ($apperanceDao) {

    $dataAppearance = $request->getParsedBody();

    if ($dataAppearance['id']) {
        $Appearance = $apperanceDao->updateAppearance($dataAppearance);

        if ($Appearance == null)
            $resp = array('success' => true, 'message' => 'Apariencias actualizada correctamente');
    } else {
        $Appearance = $apperanceDao->saveAppearance($dataAppearance);

        if ($Appearance == null)
            $resp = array('success' => true, 'message' => 'Apariencias almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
    