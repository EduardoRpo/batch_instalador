<?php


use BatchRecord\dao\ValidacionesCierreDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$validacionesCierreDao = new ValidacionesCierreDao();

$app->get('/validacionesCierreProceso/{batch}/{modulo}', function (Request $request, Response $response, $args) use ($validacionesCierreDao) {
    if ($args['modulo'] == 7) {
        $result = $validacionesCierreDao->findControlFirmasByModule($args['batch'], $args['modulo']);
        $result = $result['result'];
        if ($result == 'No')
            $resp = array('error' => true, 'message' => 'Faltan firmas en Despachos para cerrar el lote');
        else
            $resp = array('success' => true, 'message' => 'Firmas Completas');

        $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    } else {
        $resp = $validacionesCierreDao->findControlFirmas($args['batch'], $args['modulo']);
        $response->getBody()->write($resp, JSON_NUMERIC_CHECK);
    }

    return $response->withHeader('Content-Type', 'application/json');
});
