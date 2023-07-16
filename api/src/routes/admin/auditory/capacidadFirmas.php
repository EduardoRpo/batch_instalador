<?php

use BatchRecord\dao\BatchDao;
use BatchRecord\dao\validacionFirmasDao;
use BatchRecord\dao\ControlFirmasMultiDao;
use BatchRecord\dao\MultipresentacionDao;

$validacionFirmasDao = new ValidacionFirmasDao();
$batchDao = new BatchDao();
$controlFirmasMultiDao = new ControlFirmasMultiDao();
$multiDao = new MultipresentacionDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/validacionFirmas', function (Request $request, Response $response, $args) use ($batchDao, $validacionFirmasDao, $controlFirmasMultiDao, $multiDao) {
    $dataBatch = $request->getParsedBody();

    // Consultar batchs
    $batchs = $batchDao->findBatchByMinAndMax($dataBatch);

    //Consultar cantidad multipresentacion
    for ($i = 0; $i < sizeof($batchs); $i++) {
        $multi = $multiDao->findMulti($batchs[$i]['id_batch']);
        $batchs[$i]['multi'] = $multi['multi'];
    }

    //Validar Batch si es eliminado 
    if ($batchs[0]['estado']) {
        for ($i = 0; $i < sizeof($batchs); $i++) {
            $firmas = array('2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '8' => 0, '9' => 0, '10' => 0);
            // Consultar firmas y cantidad
            $firmas = $validacionFirmasDao->findDesinfectanteByDate($batchs[$i]['id_batch'], $firmas);
            $firmas = $validacionFirmasDao->findFirmas2SeccionByDate($batchs[$i]['id_batch'], $firmas, intval($batchs[$i]['multi']));
            $firmas = $validacionFirmasDao->findConciliacionRendimientoByDate($batchs[$i]['id_batch'], $firmas);
            $firmas = $validacionFirmasDao->findMaterialSobranteByDate($batchs[$i]['id_batch'], $firmas);
            $firmas = $validacionFirmasDao->findAnalisisMicrobiologicoByDate($batchs[$i]['id_batch'], $firmas);
            $firmas = $validacionFirmasDao->findLiberacionByDate($batchs[$i]['id_batch'], $firmas);

            // Actualizar tbl de control
            $resp = $validacionFirmasDao->validarFirmasGestionadas($batchs[$i]['id_batch'], $firmas);

            // Validar firmas totales
            $resp = $controlFirmasMultiDao->controlCantidadFirmas($batchs[$i]['id_batch']);
            $resp = $controlFirmasMultiDao->controlFirmasMulti($batchs[$i]['id_batch']);

            //Cambio de estado
            if ($batchs[0]['estado'] == 10) {
                $firmasBatch = $controlFirmasMultiDao->findAllFirmasByBatch($batchs[$i]['id_batch']);
                for ($i = 0; $i < sizeof($firmasBatch); $i++) {
                    if ($firmasBatch[$i]['cantidad_firmas'] != $firmasBatch[$i]['total_firmas']) {
                        if ($firmasBatch[$i]['modulo'] == 5) {
                            $estado = 6;
                            break;
                        } else if ($firmasBatch[$i]['modulo'] == 6) {
                            $estado = 6.5;
                            break;
                        } else if ($firmasBatch[$i]['modulo'] == 8) {
                            $estado = 8;
                            break;
                        } else $estado = 9;
                    }
                }
                $batchDao->updateEstadoBatch($batchs[0]['id_batch'], $estado);
            } else {
                //Modificar estado a 10 si firmas estan completas
                $firmasBatch = $controlFirmasMultiDao->findTotalFirmasByBatch($batchs[$i]['id_batch']);

                if ($firmasBatch[0]['cantidad_firmas'] == $firmasBatch[0]['total_firmas']) {
                    $estado = 10;
                    $batchDao->updateEstadoBatch($batchs[0]['id_batch'], $estado);
                }
            }
        }

        if ($resp == null)
            $resp = array('success' => true, 'message' => 'Validación de firmas del dia se ejecuto correctamente');
        else
            $resp = array('error' => true, 'message' => 'Ocurrio un error mientras se validaba la información. Intente nuevamente');
    } else {
        $resp = array('error' => true, 'message' => 'No se puede ejecutar el proceso - Batch Eliminado');
    }


    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
