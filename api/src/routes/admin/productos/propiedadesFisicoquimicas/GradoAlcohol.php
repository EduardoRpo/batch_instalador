<?php


use BatchRecord\dao\AlcoholContentDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$alcoholDao = new AlcoholContentDao();

$app->get('/AlcoholContent', function (Request $request, Response $response, $args) use ($alcoholDao) {
    $AlcoholContent = $alcoholDao->findAllAlcoholContent();
    $response->getBody()->write(json_encode($AlcoholContent, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteAlcoholContent/{id}', function (Request $request, Response $response, $args) use ($alcoholDao) {
    $AlcoholContent = $alcoholDao->deleteAlcoholContent($args['id']);

    if ($AlcoholContent == null)
        $resp = array('success' => true, 'message' => 'Grados de alcohol eliminados correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveAlcoholContent', function (Request $request, Response $response, $args) use ($alcoholDao) {

    $dataAlcoholContent = $request->getParsedBody();

    if ($dataAlcoholContent['id']) {
        $AlcoholContent = $alcoholDao->updateAlcoholContent($dataAlcoholContent);

        if ($AlcoholContent == null)
            $resp = array('success' => true, 'message' => 'Grados de alcohol actualizados correctamente');
    } else {
        $AlcoholContent = $alcoholDao->saveAlcoholContent($dataAlcoholContent);

        if ($AlcoholContent == null)
            $resp = array('success' => true, 'message' => 'Grados de alcohol almacenados correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});