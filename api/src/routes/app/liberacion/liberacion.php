<?php

use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\LiberacionDao;

$liberacionDao = new LiberacionDao();
$controlFirmasDao = new ControlFirmasDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/liberacion', function (Request $request, Response $response, $args) use ($liberacionDao, $controlFirmasDao) {
    $dataBatch = $request->getParsedBody();
    $dataBatch = $dataBatch['data'][0];

    $batch = $dataBatch['idBatch'];
    $btn = $dataBatch['id'];

    $result = null;

    if ($btn == 'tecnica_realizado') {
        $firmas = $liberacionDao->findFirmasControlRealizado($batch, 7);

        $data = [];

        if (!is_array($firmas)) {
            $data['cantidad_firmas'] = 0;
            $data['total_firmas'] = 0;
        } else
            $data = $firmas;

        if ($data['cantidad_firmas'] != $data['total_firmas']) $result = 1;
    }

    if ($result == null) {
        $result = $liberacionDao->liberacionLote($dataBatch);

        $dataBatch['modulo'] = 10;
        $controlFirmasDao->registrarFirmas($dataBatch);
    }

    $response->getBody()->write(json_encode($result, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/countFirmasLiberacion/{batch}', function (Request $request, Response $response, $args) use ($liberacionDao,) {
    $liberacion = $liberacionDao->findFirmasControlRealizado($args['batch'], 10);
    $response->getBody()->write(json_encode($liberacion, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
