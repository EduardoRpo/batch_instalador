<?php


use BatchRecord\dao\ChargueDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$chargueDao = new ChargueDao();

$app->get('/Chargue', function (Request $request, Response $response, $args) use ($chargueDao) {
$Chargue = $chargueDao->findAllChargue();
$response->getBody()->write(json_encode($Chargue, JSON_NUMERIC_CHECK));
return $response->withHeader('Content-Type', 'application/json');

});
$app->get('/deleteChargue/{id}', function (Request $request, Response $response, $args) use ($chargueDao) {
$Chargue = $chargueDao->deleteChargue($args['id']);

if ($Chargue == null)
    $resp = array('success' => true, 'message' => 'Cargo eliminado correctamente');

$response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveChargue', function (Request $request, Response $response, $args) use ($chargueDao) {

$dataChargue = $request->getParsedBody();

if ($dataChargue['id']) {
    $Chargue = $chargueDao->updateChargue($dataChargue);

    if ($Chargue == null)
    $resp = array('success' => true, 'message' => 'Cargo actualizado correctamente');
} else {
    $Chargue = $chargueDao->saveChargue($dataChargue);

    if ($Chargue == null)
    $resp = array('success' => true, 'message' => 'Cargo almacenado correctamente');
}

$response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
return $response->withHeader('Content-Type', 'application/json');
});
