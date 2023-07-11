<?php


use BatchRecord\dao\AutenticacionDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$autenticacionDao = new AutenticacionDao();

$app->post('/auth', function (Request $request, Response $response, $args) use ($autenticacionDao) {
    $dataUser = $request->getParsedBody();
    $resp = $autenticacionDao->findUser($dataUser);
    $btn = $dataUser['btn_id'];

    if ($resp != null) {
        if ($resp['estado'] == 0)
            $resp = array('info' => true, 'message' => 'Usuario No autorizado para firmar.');

        if ($resp['rol'] !== 3 && $resp['rol'] !== 4)
            $resp = array('info' => true, 'message' => 'Usuario No autorizado para firmar.');

        if ($btn === 'firma1' && $btn === 'firma3' && $resp['rol'] !== 3)
            $resp = array('info' => true, 'message' => 'Usuario No autorizado para firmar.');

        if ($btn === 'firma2' && $btn === 'firma4' && $resp['rol'] !== 4)
            $resp = array('info' => true, 'message' => 'Usuario No autorizado para firmar.');
    } else if ($resp == false)
        $resp = array('error' => true, 'message' => 'Usuario y/o contraseña no coinciden.');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
