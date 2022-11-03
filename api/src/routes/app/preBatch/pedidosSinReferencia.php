<?php

use BatchRecord\dao\PedidosSinReferenciaDao;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$pedidosSinRefDao = new PedidosSinReferenciaDao();

$app->get('/sendNonExistentProducts', function (Request $request, Response $response, $args) use ($pedidosSinRefDao) {
    session_start();
    $data = $_SESSION['nonExistentProducts'];

    if ($data) {
        $resp = $data;
        unset($_SESSION['nonExistentProducts']);
    } else {
        $resp = $pedidosSinRefDao->findAllPedidoSinReferencia();

        if (!$resp)
            $resp = array('error' => true, 'message' => 'Importe un nuevo archivo');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
