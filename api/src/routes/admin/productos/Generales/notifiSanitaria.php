<?php

use BatchRecord\dao\HealthNotificationDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$healthNotifi = new HealthNotificationDao();

$app->get('/HealthNotifications', function (Request $request, Response $response, $args) use ($healthNotifi) {
    $HealthNotifications = $healthNotifi->findAllHealthNotifications();
    $response->getBody()->write(json_encode($HealthNotifications, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteHealthNotifications/{id}', function (Request $request, Response $response, $args) use ($healthNotifi) {
    $HealthNotifications = $healthNotifi->deleteHealthNotifications($args['id']);

    if ($HealthNotifications == null)
        $resp = array('success' => true, 'message' => 'notificacion eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveHealthNotifications', function (Request $request, Response $response, $args) use ($healthNotifi) {

    $dataHealthNotifications = $request->getParsedBody();

    if ($dataHealthNotifications['id']) {
        $HealthNotifications = $healthNotifi->updateHealthNotifications($dataHealthNotifications);

        if ($HealthNotifications == null)
            $resp = array('success' => true, 'message' => 'notificacion almacenado correctamente');
    } else {
        $HealthNotifications = $healthNotifi->saveHealthNotifications($dataHealthNotifications);

        if ($HealthNotifications == null)
            $resp = array('success' => true, 'message' => 'notificacion actualizado correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});