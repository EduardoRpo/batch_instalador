<?php


use BatchRecord\dao\PedidosDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$pedidosDao = new PedidosDao();

$app->get('/pedidos', function (Request $request, Response $response, $args) use ($pedidosDao) {
    $array = $pedidosDao->findAll();
    $response->getBody()->write(json_encode($array));

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/pedidos/{idPedido}', function (Request $request, Response $response, $args) use ($pedidosDao) {
    $array = $pedidosDao->findByOrder($args["idPedido"]);
    $response->getBody()->write(json_encode($array));

    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/pedidos/nuevos', function (Request $request, Response $response, $args)  use ($pedidosDao) {
    $data = file_get_contents('../html/pedidos/pedidos.xls');
    $array = $pedidosDao->save($data);
    $response->getBody()->write(json_encode($array));

    return $response->withHeader('Content-Type', 'application/json');
});
