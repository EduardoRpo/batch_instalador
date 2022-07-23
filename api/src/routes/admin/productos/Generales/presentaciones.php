<?php


use BatchRecord\dao\presentationDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$PresentationDao = new presentationDao();

$app->get('/Presentation', function (Request $request, Response $response, $args) use ($PresentationDao) {
    $Presentation = $PresentationDao->findAllPresentation();
    $response->getBody()->write(json_encode($Presentation, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deletePresentation/{id}', function (Request $request, Response $response, $args) use ($PresentationDao) {
    $Presentation = $PresentationDao->deletePresentation($args['id']);

    if ($Presentation == null)
        $resp = array('success' => true, 'message' => 'Presentacion eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/savePresentation', function (Request $request, Response $response, $args) use ($PresentationDao) {

    $dataPresentation = $request->getParsedBody();

    if ($dataPresentation['id']) {
        $Presentation = $PresentationDao->updatePresentation($dataPresentation);

        if ($Presentation == null)
            $resp = array('success' => true, 'message' => 'Presentacion actualizada correctamente');
    } else {
        $Presentation = $PresentationDao->savePresentation($dataPresentation);

        if ($Presentation == null)
            $resp = array('success' => true, 'message' => 'Presentacion almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
    