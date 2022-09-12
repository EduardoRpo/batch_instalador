<?php


use BatchRecord\dao\labelDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$labelDao = new labelDao();

$app->get('/labels', function (Request $request, Response $response, $args) use ($labelDao) {
    $Label = $labelDao->findAllLabel();
    $response->getBody()->write(json_encode($Label, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteLabel/{id}', function (Request $request, Response $response, $args) use ($labelDao) {
    $Label = $labelDao->deleteLabel($args['id']);

    if ($Label == null)
        $resp = array('success' => true, 'message' => 'Etiqueta eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveLabel', function (Request $request, Response $response, $args) use ($labelDao) {

    $dataLabel = $request->getParsedBody();

    if ($dataLabel['ref']) {
        $data = $labelDao->findLabelByRef($dataLabel['ref']);

        if ($data) {
            $Label = $labelDao->updateLabel($dataLabel);
            if ($Label == null)
                $resp = array('success' => true, 'message' => 'Etiqueta actualizada correctamente');
        } else {
            $Label = $labelDao->saveLabel($dataLabel);
            if ($Label == null)
                $resp = array('success' => true, 'message' => 'Etiqueta almacenada correctamente');
        }
    } else
        $resp = array('error' => true, 'message' => 'Ingrese todos los datos e Intentelo nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
