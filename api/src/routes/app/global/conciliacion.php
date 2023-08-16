<?php

use BatchRecord\dao\ConciliacionDao;
use BatchRecord\dao\EstadoDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$conciliacionDao = new ConciliacionDao();
$estadosDao = new EstadoDao();

$app->get('/loadConciliacion/{id_batch}/{ref_multi}', function (Request $request, Response $response, $args) use ($conciliacionDao) {
    $data = $conciliacionDao->findAllConciliacionByBatchAndRef($args['id_batch'], $args['ref_multi']);
    $response->getBody()->write(json_encode($data, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveConciliacion', function (Request $request, Response $response, $args) use ($conciliacionDao, $estadosDao) {
    $dataBatch = $request->getParsedBody();

    $conciliacion = $conciliacionDao->findAllConciliacion($dataBatch);

    $result = $conciliacionDao->insertConciliacionParciales($dataBatch, $conciliacion);

    if ($result == 1)
        $result = $conciliacionDao->almacenar_muestras_retencion($dataBatch);

    if ($result == null)
        $result = $estadosDao->actualizarEstado($dataBatch);

    if ($result == null) {
        $conciliacion = $conciliacionDao->findAllConciliacion($dataBatch);
        $resp = array('success' => true, 'message' => 'Conciliación parcial registrada satisfactoriamente', 'data' => $conciliacion);
    } elseif (isset($result['info'])) {
        $resp = array('info' => true, 'message' => $result['message']);
    } else {
        $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

// $app->post('/loadRealizoVerifico2seccion', function (Request $request, Response $response, $args) use ($firmas2SeccionDao) {
//     $dataBatch = $request->getParsedBody();

//     $data = $firmas2SeccionDao->findFirmas2seccionRealizoVerifico($dataBatch);

//     if (!$data) {
//         $data = $firmas2SeccionDao->findFirmas2seccionRealizo($dataBatch);
//     }

//     $response->getBody()->write(json_encode($data, JSON_NUMERIC_CHECK));
//     return $response->withHeader('Content-Type', 'application/json');
// });

// $app->post('/despeje', function (Request $request, Response $response, $args) use (
//     $desinfectanteDao,
//     $controFirmasDao
// ) {
//     $dataBatch = $request->getParsedBody();
//     $result = $desinfectanteDao->desinfectanteVerifico($dataBatch);

//     if ($result == null && $dataBatch['modulo'] != 4 && $dataBatch['modulo'] != 8 && $dataBatch['modulo'] != 9)
//         $result = $controFirmasDao->registrarFirmas($dataBatch);

//     if ($result == null)
//         $resp = array('success' => true, 'message' => 'Firmado correctamente');
//     elseif (isset($result['info']))
//         $resp = array('info' => true, 'message' => $result['message']);
//     else
//         $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

//     $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
//     return $response->withHeader('Content-Type', 'application/json');
// });

// $app->post('/calidad1seccion', function (Request $request, Response $response, $args) use (
//     $materialSobranteDao,
//     $estadosDao,
//     $controFirmasDao
// ) {
//     $dataBatch = $request->getParsedBody();

//     $result = $materialSobranteDao->materialSobranteVerifico($dataBatch);

//     if ($result == null)
//         $result = $estadosDao->CerrarBatch($dataBatch);
//     if ($result == null)
//         $result = $controFirmasDao->registrarFirmas($dataBatch);

//     if ($result == null)
//         $resp = array('success' => true, 'message' => 'Firmado correctamente');
//     elseif (isset($result['info']))
//         $resp = array('info' => true, 'message' => $result['message']);
//     else
//         $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

//     $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
//     return $response->withHeader('Content-Type', 'application/json');
// });

// $app->post('/calidad2seccion', function (Request $request, Response $response, $args) use ($firmas2SeccionDao, $estadosDao) {
//     $dataBatch = $request->getParsedBody();

//     $result = $firmas2SeccionDao->segundaSeccionVerifico($dataBatch);

//     if ($result == null)
//         $result = $estadosDao->CerrarBatch($dataBatch);

//     if ($result == null)
//         $resp = array('success' => true, 'message' => 'Firmado correctamente');
//     elseif (isset($result['info']))
//         $resp = array('info' => true, 'message' => $result['message']);
//     else
//         $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

//     $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
//     return $response->withHeader('Content-Type', 'application/json');
// });

// $app->post('/saveRealizo2seccion', function (Request $request, Response $response, $args) use ($firmas2SeccionDao, $controFirmasDao) {
//     $dataBatch = $request->getParsedBody();

//     $result = $firmas2SeccionDao->segundaSeccionRealizo($dataBatch);

//     if ($result == null)
//         $result = $controFirmasDao->registrarFirmas($dataBatch);

//     if ($result == null)
//         $resp = array('success' => true, 'message' => 'Firmado correctamente');
//     elseif (isset($result['info']))
//         $resp = array('info' => true, 'message' => $result['message']);
//     else
//         $resp = array('error' => true, 'message' => 'Ocurrio un error. Intenta nuevamente');

//     $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
//     return $response->withHeader('Content-Type', 'application/json');
// });
