<?php


use BatchRecord\dao\RawMaterialDao;
use BatchRecord\dao\RawMaterialFDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$MateriaPrimaDao = new RawMaterialDao();
$MateriaFantasmaDao = new RawMaterialFDao();

$app->post('/SaveRawMaterial', function (Request $request, Response $response, $args) use ($MateriaFantasmaDao, $MateriaPrimaDao) {

    $dataMaterial = $request->getParsedBody();
    if ($dataMaterial['controller'] == 1) {
        if ($dataMaterial['id']) {
            $materiaPrima = $MateriaPrimaDao->updateRawMaterial($dataMaterial);

            if ($materiaPrima == null) {
                $resp = array('success' => true, 'message' => 'Materia Prima Actualizada Correctamente');
            }
        } else {
            $materiaPrima = $MateriaPrimaDao->saveRawMaterial($dataMaterial);
            if ($materiaPrima = null) {
                $resp = array('success' => true, 'message' => 'Materia Prima Almacenada Correctamente');
            }
        }
    } else {
        if ($dataMaterial['id']) {
            $materiaFantasma = $MateriaFantasmaDao->updateRawMaterialF($dataMaterial);
            if ($materiaFantasma == null) {
                $resp = array('success' => true, 'message' => 'Materia Prima fantasma Actualizada Correctamente');
            }
        } else {
            $materiaFantasma = $MateriaFantasmaDao->saveRawMaterialF($dataMaterial);
            if ($materiaFantasma == null) {
                $resp = array('success' => true, 'message' => 'Materia Prima Fantasma Almacenada Correctamente');
            }
        }
    }
    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/RawMaterial', function (Request $request, Response $response, $args) use ($MateriaPrimaDao) {

    $materiaPrima = $MateriaPrimaDao->findAllRawMaterial();
    $response->getBody()->write(json_encode($materiaPrima, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/RawMaterialF', function (Request $request, Response $response, $args) use ($MateriaFantasmaDao) {

    $materiaFantasma = $MateriaFantasmaDao->findAllRawMaterialF();
    $response->getBody()->write(json_encode($materiaFantasma, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
/*
$app->get('/Lid', function (Request $request, Response $response, $args) use ($lidDao) {
    $Lid = $lidDao->findAllLid();
    $response->getBody()->write(json_encode($Lid, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

\*/
$app->get('/deleteRawMaterial/{id}', function (Request $request, Response $response, $args) use ($MateriaPrimaDao) {
    $materiaPrima = $MateriaPrimaDao->deleteRawMaterial($args['id']);

    if ($materiaPrima == null)
        $resp = array('success' => true, 'message' => 'Materia Prima eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteRawMaterialF/{id}', function (Request $request, Response $response, $args) use ($MateriaFantasmaDao) {
    $materiaFantasma = $MateriaFantasmaDao->deleteRawMaterialF($args['id']);

    if ($materiaFantasma == null)
        $resp = array('success' => true, 'message' => 'Materia Prima Fantasma eliminada correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
/* 

$app->post('/saveLid', function (Request $request, Response $response, $args) use ($lidDao) {

    $dataLid = $request->getParsedBody();

    if ($dataLid['operacion']) {
        $Lid = $lidDao->updateLid($dataLid);

        if ($Lid == null)
            $resp = array('success' => true, 'message' => 'Tapas actualizada correctamente');
    } else {
        $Lid = $lidDao->saveLid($dataLid);

        if ($Lid == null)
            $resp = array('success' => true, 'message' => 'Tapas almacenada correctamente');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

*/