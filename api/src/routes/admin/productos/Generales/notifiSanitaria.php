<?php


use BatchRecord\dao\healtNotificationDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$HealthNotifi = new healtNotificationDao();

$app->get('/HealthNotifications', function (Request $request, Response $response, $args) use ($HealthNotifi) {
    $HealthNotifications = $HealthNotifi->findAllHealthNotifications();
    $response->getBody()->write(json_encode($HealthNotifications, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteHealthNotifications/{id}', function (Request $request, Response $response, $args) use ($HealthNotifi) {
    $HealthNotifications = $HealthNotifi->deleteHealthNotifications($args['id']);

    if ($HealthNotifications == null)
        $resp = array('success' => true, 'message' => 'notificacion eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveHealthNotifications', function (Request $request, Response $response, $args) use ($HealthNotifi) {

    $dataHealthNotifications = $request->getParsedBody();

    if ($dataHealthNotifications['id']) {
        $HealthNotifications = $HealthNotifi->updateHealthNotifications($dataHealthNotifications);

        if ($HealthNotifications == null)
            $resp = array('success' => true, 'message' => 'notificacion almacenado correctamente');
    } else {
        $HealthNotifications = $HealthNotifi->saveHealthNotifications($dataHealthNotifications);

        if ($HealthNotifications == null)
            $resp = array('success' => true, 'message' => 'notificacion actualizado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});