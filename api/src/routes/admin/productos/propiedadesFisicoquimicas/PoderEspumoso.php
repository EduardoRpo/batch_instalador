<?php


use BatchRecord\dao\SparklingPowerDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$powerDao = new SparklingPowerDao();

$app->get('/SparkPower', function (Request $request, Response $response, $args) use ($powerDao) {
    $SparkPower = $powerDao->findAllSparkPowers();
    $response->getBody()->write(json_encode($SparkPower, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteSparkPower/{id}', function (Request $request, Response $response, $args) use ($powerDao) {
    $SparkPower = $powerDao->deleteSparkPower($args['id']);

    if ($SparkPower == null)
        $resp = array('success' => true, 'message' => 'Poder espumoso eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/saveSparkPower', function (Request $request, Response $response, $args) use ($powerDao) {

    $dataSparkPower = $request->getParsedBody();

    if ($dataSparkPower['id']) {
        $SparkPower = $powerDao->updateSparkPower($dataSparkPower);

        if ($SparkPower == null)
            $resp = array('success' => true, 'message' => 'Poder espumoso actualizado correctamente');
    } else {
        $SparkPower = $powerDao->saveSparkPower($dataSparkPower);

        if ($SparkPower == null)
            $resp = array('success' => true, 'message' => 'Poder espumoso almacenado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});