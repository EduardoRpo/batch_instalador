<?php


use BatchRecord\dao\TanksDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$tanksDao = new TanksDao();

$app->get('/tanks', function (Request $request, Response $response, $args) use ($tanksDao) {
$tanks = $tanksDao->findAlltanks();
$response->getBody()->write(json_encode($tanks, JSON_NUMERIC_CHECK));
return $response->withHeader('Content-Type', 'application/json');

});
$app->get('/deletetanks/{id}', function (Request $request, Response $response, $args) use ($tanksDao) {
$tanks = $tanksDao->deletetanks($args['id']);

if ($tanks == null)
    $resp = array('success' => true, 'message' => 'tanque eliminado correctamente');

$response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/savetanks', function (Request $request, Response $response, $args) use ($tanksDao) {

$datatanks = $request->getParsedBody();

if ($datatanks['id']) {
    $tanks = $tanksDao->updatetanks($datatanks);

    if ($tanks == null)
    $resp = array('success' => true, 'message' => 'tanque actualizado correctamente');
} else {
    $tanks = $tanksDao->savetanks($datatanks);

    if ($tanks == null)
    $resp = array('success' => true, 'message' => 'tanque almacenado correctamente');
}

$response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
return $response->withHeader('Content-Type', 'application/json');
});
