<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $app->get('/api/test', function (Request $request, Response $response) {
        return $response->withJson([
            'success' => true,
            'message' => 'API funcionando correctamente',
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    });
    
    $app->post('/api/test', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        return $response->withJson([
            'success' => true,
            'message' => 'POST funcionando correctamente',
            'data_received' => $data,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    });
}; 