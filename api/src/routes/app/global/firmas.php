<?php

use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\DesinfectanteDao;
use BatchRecord\dao\EstadoDao;
use BatchRecord\dao\Firmas2SeccionDao;
use BatchRecord\dao\MaterialSobranteDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$desinfectanteDao = new DesinfectanteDao();
$materialSobranteDao = new MaterialSobranteDao();
$controFirmasDao = new ControlFirmasDao();
$firmas2SeccionDao = new Firmas2SeccionDao();
$estadosDao = new EstadoDao();

$app->get('/loadRealizoMaterialSobrante/{id_batch}', function (Request $request, Response $response, $args) use ($materialSobranteDao) {
    $data = $materialSobranteDao->findMaterialSobranteRealizoByBatch($args['id_batch']);
    $response->getBody()->write(json_encode($data, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/loadRealizoVerificoMaterialSobrante', function (Request $request, Response $response, $args) use ($materialSobranteDao) {
    $dataBatch = $request->getParsedBody();

    $data = $materialSobranteDao->findMaterialSobranteRealizoVerifico($dataBatch);

    for ($i = 0; $i < sizeof($data); $i++) {
        $arreglo["data"][] = $data[$i];
    }

    if (empty($arreglo)) {
        $data = $materialSobranteDao->findMaterialSobranteRealizo($dataBatch);

        for ($i = 0; $i < sizeof($data); $i++) {
            $arreglo["data"][] = $data[$i];
        }
    }

    $response->getBody()->write(json_encode($arreglo, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/loadRealizoVerifico2seccion', function (Request $request, Response $response, $args) use ($firmas2SeccionDao) {
    $dataBatch = $request->getParsedBody();

    $data = $firmas2SeccionDao->findFirmas2seccionRealizoVerifico($dataBatch);

    if (!$data) {
        $data = $firmas2SeccionDao->findFirmas2seccionRealizo($dataBatch);
    }

    $response->getBody()->write(json_encode($data, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/despeje', function (Request $request, Response $response, $args) use (
    $desinfectanteDao,
    $controFirmasDao
) {
    $dataBatch = $request->getParsedBody();
    $result = $desinfectanteDao->desinfectanteVerifico($dataBatch);

    if ($result == null && $dataBatch['modulo'] != 4 && $dataBatch['modulo'] != 8 && $dataBatch['modulo'] != 9)
        $result = $controFirmasDao->registrarFirmas($dataBatch);

    if ($result == null)
        $resp = array('success' => true, 'message' => 'Firmado correctamente');
    elseif (isset($result['info']))
        $resp = array('info' => true, 'message' => $result['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/calidad1seccion', function (Request $request, Response $response, $args) use (
    $materialSobranteDao,
    $estadosDao,
    $controFirmasDao
) {
    $dataBatch = $request->getParsedBody();

    $result = $materialSobranteDao->materialSobranteVerifico($dataBatch);

    if ($result == null)
        $result = $estadosDao->CerrarBatch($dataBatch);
    if ($result == null)
        $result = $controFirmasDao->registrarFirmas($dataBatch);

    if ($result == null)
        $resp = array('success' => true, 'message' => 'Firmado correctamente');
    elseif (isset($result['info']))
        $resp = array('info' => true, 'message' => $result['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/calidad2seccion', function (Request $request, Response $response, $args) use ($firmas2SeccionDao, $estadosDao) {
    $dataBatch = $request->getParsedBody();

    $result = $firmas2SeccionDao->segundaSeccionVerifico($dataBatch);

    if ($result == null)
        $result = $estadosDao->CerrarBatch($dataBatch);

    if ($result == null)
        $resp = array('success' => true, 'message' => 'Firmado correctamente');
    elseif (isset($result['info']))
        $resp = array('info' => true, 'message' => $result['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveRealizo2seccion', function (Request $request, Response $response, $args) use ($firmas2SeccionDao, $controFirmasDao) {
    $dataBatch = $request->getParsedBody();

    $result = $firmas2SeccionDao->segundaSeccionRealizo($dataBatch);

    if ($result == null)
        $result = $controFirmasDao->registrarFirmas($dataBatch);

    if ($result == null)
        $resp = array('success' => true, 'message' => 'Firmado correctamente');
    elseif (isset($result['info']))
        $resp = array('info' => true, 'message' => $result['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
