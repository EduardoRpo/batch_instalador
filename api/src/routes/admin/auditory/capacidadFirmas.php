<?php

use BatchRecord\dao\ValidacionFirmasDao;
use BatchRecord\dao\BatchDao;
use BatchRecord\dao\ControlFirmasMultiDao;

$batchDao = new BatchDao();
$controlFirmasDao = new ValidacionFirmasDao();
$controlFirmasMultiDao = new ControlFirmasMultiDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/validacionFirmas', function (Request $request, Response $response, $args) use ($controlFirmasDao, $controlFirmasMultiDao) {
    $batch = $controlFirmasDao->findAllBatchByDate();

    if (sizeof($batch) >= 1 && $batch['estado'] != 0) {
        for ($i = 0; $i < sizeof($batch); $i++) {
            /* Validacion firmas gestionadas */
            $firmas = [];
            $cantidad = 0;

            // Consultar desinfectante
            $firmas_despeje = $controlFirmasDao->findDesinfectanteByBatch($batch[$i]['id_batch']);

            foreach ($firmas_despeje as $value) {
                $fmodulo = $value['modulo'];

                if ($fmodulo != 9 && $fmodulo != 8) {
                    if ($value['realizo'] > 0)
                        $cantidad += 1;
                    if ($value['verifico'] > 0)
                        $cantidad += 1;
                }
                $firmas[$value['modulo']] = $cantidad;
                $cantidad = 0;
            }

            // Consultar firmas2Seccion
            $firmas_proceso = $controlFirmasDao->findFirmas2SeccionByBatch($batch[$i]['id_batch']);

            foreach ($firmas_proceso as $value) {
                if ($value['modulo'] != 4 && $value['modulo'] != 8)
                    $cantidad = $value['realizo'] + $value['verifico'];
                $modulo = $value['modulo'];
                $indice = array_key_exists($modulo, $firmas);

                if ($indice)
                    $firmas[$value['modulo']] = $firmas[$modulo] + $cantidad;
                else
                    $firmas[$modulo] = $cantidad;
                $cantidad = 0;
            }

            // Consultar Analisis Microbiologico
            $firmas_microbiologico = $controlFirmasDao->findAnalisisMicrobiologicoByBatch($batch[$i]['id_batch']);

            foreach ($firmas_microbiologico as $value) {
                if ($value['realizo'] > 0)
                    $cantidad += 1;
                if ($value['verifico'] > 0)
                    $cantidad += 1;

                $modulo = $value['modulo'];
                $indice = array_key_exists($modulo, $firmas);

                if ($indice)
                    $firmas[$value['modulo']] = $firmas[$modulo] + $cantidad;
                else
                    $firmas[$modulo] = $cantidad;
                $cantidad = 0;
            }

            // Consultar Conciliacion Rendimiento
            $firmas_conciliacion = $controlFirmasDao->findConciliacionRendimientoByBatch($batch[$i]['id_batch']);

            foreach ($firmas_conciliacion as $value) {
                if ($value['entrego'] > 0)
                    $cantidad += 1;

                $modulo = $value['modulo'];
                $indice = array_key_exists($modulo, $firmas);

                if ($indice)
                    $firmas[$value['modulo']] = $firmas[$modulo] + $cantidad;
                else
                    $firmas[$modulo] = $cantidad;
                $cantidad = 0;
            }

            // Consultar Material Sobrante
            $firmas_material = $controlFirmasDao->findMaterialSobranteByBatch($batch[$i]['id_batch']);

            if ($firmas_material > 0) {
                foreach ($firmas_material as $value) {
                    if ($value['modulo'] == 5) {
                        if ($value['realizo'] > 0)
                            $cantidad += 1;
                        if ($value['verifico'] > 0)
                            $cantidad += 1;
                    }
                }
                $modulo = 5;
                $firmas[$modulo] = $firmas[$modulo] + $cantidad;
                $cantidad = 0;

                foreach ($firmas_material as $value) {
                    if ($value['modulo'] == 6) {
                        if ($value['realizo'] > 0)
                            $cantidad += 1;
                        if ($value['verifico'] > 0)
                            $cantidad += 1;
                    }
                }
                $modulo = 6;
                $firmas[$modulo] = $firmas[$modulo] + $cantidad;
                $cantidad = 0;
            }

            // Consultar Liberacion
            $firmas_liberacion = $controlFirmasDao->findLiberacionByBatch($batch[$i]['id_batch']);

            if ($firmas_liberacion) {
                if ($firmas_liberacion['dir_produccion'] > 0)
                    $cantidad = $cantidad + 1;

                if ($firmas_liberacion['dir_calidad'] > 0)
                    $cantidad = $cantidad + 1;

                if ($firmas_liberacion['dir_tecnica'] > 0)
                    $cantidad = $cantidad + 1;

                $modulo = 10;
                $indice = array_key_exists($modulo, $firmas);

                if ($indice)
                    $firmas[$firmas_liberacion['modulo']] = $firmas[$modulo] + $cantidad;
                else
                    $firmas[$modulo] =  $cantidad;
                $cantidad = 0;
            }

            $firmasGestionadas = $controlFirmasDao->validarFirmasGestionadas($batch[$i]['id_batch'], $firmas);

            //Validacion firmas totales
            $firmasTotales = $controlFirmasMultiDao->controlFirmasMulti($batch[$i]['id_batch']);
        }

        if ($firmasGestionadas == null && $firmasTotales == null)
            $resp = array('success' => true, 'message' => 'Validación de firmas del dia se ejecuto correctamente');
        else
            $resp = array('error' => true, 'message' => 'Ocurrio un error mientras se validaba la información. Intente nuevamente');
    } else
        $resp = array('info' => true, 'message' => 'No se ha firmado ningun batch el dia de hoy');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
