<?php

use BatchRecord\dao\TanquesChksDao;
use BatchRecord\dao\FlagStartDao;
use BatchRecord\dao\BatchDao;
use BatchRecord\dao\LoteMaterialesDao;
use BatchRecord\dao\ExplosionMaterialesBatchDao;
use BatchRecord\dao\EstadoDao;
use BatchRecord\dao\EquipoDao;
use BatchRecord\dao\DesinfectanteDao;
use BatchRecord\dao\Firmas2SeccionDao;
use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\ControlEspecificacionesDao;
use BatchRecord\dao\batchAprobadoDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$tanquesChksDao = new TanquesChksDao();
$flagStartDao = new FlagStartDao();
$batchDao = new BatchDao();
$loteMaterialesDao = new LoteMaterialesDao();
$explosionMaterialesBatchDao = new ExplosionMaterialesBatchDao();
$estadoDao = new EstadoDao();
$equipoDao = new EquipoDao();
$desinfectanteDao = new DesinfectanteDao();
$firmas2SeccionDao = new Firmas2SeccionDao();
$controlFirmasDao = new ControlFirmasDao();
$controlEspecificacionesDao = new ControlEspecificacionesDao();
$batchAprobadoDao = new BatchAprobadoDao();

$app->post('/saveBatchTanques', function (Request $request, Response $response, $args) use (
    $tanquesChksDao,
    $flagStartDao,
    $batchDao,
    $loteMaterialesDao,
    $explosionMaterialesBatchDao,
    $estadoDao,
    $equipoDao,
    $desinfectanteDao,
    $firmas2SeccionDao,
    $controlFirmasDao,
    $controlEspecificacionesDao,
    $batchAprobadoDao,
) {
    try {
        error_log('🔍 saveBatchTanques - Iniciando endpoint');
        
        $dataBatch = $request->getParsedBody();
        error_log('🔍 saveBatchTanques - Datos recibidos: ' . json_encode($dataBatch));

        $modulo = $dataBatch['modulo'];
        $tanques = $dataBatch['tanques'];
        $tanquesOk = $dataBatch['tanquesOk'];
        
        error_log("🔍 saveBatchTanques - Módulo: $modulo, Tanques: $tanques, TanquesOk: $tanquesOk");

        $resp = null;

        if ($modulo != 9) {
            error_log('🔍 saveBatchTanques - Ejecutando saveTanquesChks');
            $resp = $tanquesChksDao->saveTanquesChks($dataBatch);
            error_log('🔍 saveBatchTanques - Resultado saveTanquesChks: ' . ($resp ? 'error' : 'null'));
        }

        // Actualiza el estado de los modulo pesaje y preparacion
        if ($modulo == 2) {
            error_log('🔍 saveBatchTanques - Procesando módulo 2 (pesaje)');
            
            error_log('🔍 saveBatchTanques - Ejecutando registrarLotes');
            $lotesMateriales = $loteMaterialesDao->registrarLotes($dataBatch);
            error_log('🔍 saveBatchTanques - Resultado registrarLotes: ' . ($lotesMateriales ? 'error' : 'null'));

            if ($lotesMateriales == null) {
                error_log('🔍 saveBatchTanques - Ejecutando registrarExplosionMaterialesUso');
                $explosionMateriales = $explosionMaterialesBatchDao->registrarExplosionMaterialesUso($dataBatch);
                error_log('🔍 saveBatchTanques - Resultado registrarExplosionMaterialesUso: ' . ($explosionMateriales ? 'error' : 'null'));
            }

            if ($explosionMateriales == null) {
                error_log('🔍 saveBatchTanques - Ejecutando actualizarEstado');
                $estado = $estadoDao->actualizarEstado($dataBatch);
                error_log('🔍 saveBatchTanques - Resultado actualizarEstado: ' . ($estado ? 'error' : 'null'));
            }

            if ($estado == null) {
                error_log('🔍 saveBatchTanques - Ejecutando findBatch');
                $batch = $batchDao->findBatch($dataBatch['idBatch']);
                error_log('🔍 saveBatchTanques - Batch encontrado: ' . json_encode($batch));
                
                $dataBatch['referencia'] = $batch['id_producto'];
                error_log('🔍 saveBatchTanques - Ejecutando insertFlagStart');
                $resp = $flagStartDao->insertFlagStart($dataBatch);
                error_log('🔍 saveBatchTanques - Resultado insertFlagStart: ' . ($resp ? 'error' : 'null'));
            }
        }
        
        //Insertar flags correspondientes
        if ($modulo == 3 || $modulo == 5 || $modulo == 6) {
            error_log("🔍 saveBatchTanques - Procesando módulo $modulo");
            $batch = $batchDao->findBatch($dataBatch['idBatch']);
            $dataBatch['referencia'] = $batch['id_producto'];
            //Guardar flag_start
            error_log('🔍 saveBatchTanques - Ejecutando saveFlagStart');
            $resp = $flagStartDao->saveFlagStart($dataBatch);
            error_log('🔍 saveBatchTanques - Resultado saveFlagStart: ' . ($resp ? 'error' : 'null'));
        }
        
        if ($modulo == 3) {
            error_log('🔍 saveBatchTanques - Procesando equipos para módulo 3');
            // Insertar equipos
            error_log('🔍 saveBatchTanques - Ejecutando insertEquipos');
            $resp = $equipoDao->insertEquipos($dataBatch);
            error_log('🔍 saveBatchTanques - Resultado insertEquipos: ' . ($resp ? 'error' : 'null'));
            
            // validar que todos los tanques esten hechos para aprobacion
            if ($tanques == $tanquesOk && $resp == null) {
                error_log('🔍 saveBatchTanques - Ejecutando actualizarEstado para módulo 3');
                $resp = $estadoDao->actualizarEstado($dataBatch);
                error_log('🔍 saveBatchTanques - Resultado actualizarEstado módulo 3: ' . ($resp ? 'error' : 'null'));
            }
        }
        
        // Almacena el desinfectante del modulo de aprobacion y fisicoquimico
        if ($modulo == 4) {
            error_log('🔍 saveBatchTanques - Procesando módulo 4 (aprobación)');
            error_log('🔍 saveBatchTanques - Ejecutando desinfectanteRealizo');
            $desinfectante = $desinfectanteDao->desinfectanteRealizo($dataBatch);
            error_log('🔍 saveBatchTanques - Resultado desinfectanteRealizo: ' . ($desinfectante ? 'error' : 'null'));
            
            if ($desinfectante == null) {
                error_log('🔍 saveBatchTanques - Ejecutando segundaSeccionRealizo');
                $firmas2Seccion = $firmas2SeccionDao->segundaSeccionRealizo($dataBatch);
                error_log('🔍 saveBatchTanques - Resultado segundaSeccionRealizo: ' . ($firmas2Seccion ? 'error' : 'null'));
            }
            /* registrar cantidad firmas solo al finalizar los tanques */
            if ($firmas2Seccion == null && $dataBatch['tanques'] == $dataBatch['tanquesOk']) {
                error_log('🔍 saveBatchTanques - Ejecutando registrarFirmas');
                $resp = $controlFirmasDao->registrarFirmas($dataBatch);
                error_log('🔍 saveBatchTanques - Resultado registrarFirmas: ' . ($resp ? 'error' : 'null'));
            }
        }

        // Almacena el formulario de control del módulo de preparación
        if ($modulo == 3 || $modulo == 4) {
            error_log('🔍 saveBatchTanques - Ejecutando insertCEspecificacionesByPreparacion');
            $resp = $controlEspecificacionesDao->insertCEspecificacionesByPreparacion($dataBatch);
            error_log('🔍 saveBatchTanques - Resultado insertCEspecificacionesByPreparacion: ' . ($resp ? 'error' : 'null'));
        }

        // Almacena informacion del control de especificaciones para el modulo de fisicoquimico
        if ($modulo == 4 && $tanques == $tanquesOk) {
            error_log('🔍 saveBatchTanques - Procesando especificaciones para módulo 4');
            error_log('🔍 saveBatchTanques - Ejecutando insertCEspecificacionesByFisicoquimico');
            $controlEspecificaciones = $controlEspecificacionesDao->insertCEspecificacionesByFisicoquimico($dataBatch);
            error_log('🔍 saveBatchTanques - Resultado insertCEspecificacionesByFisicoquimico: ' . ($controlEspecificaciones ? 'error' : 'null'));
            
            // Almacenar datos para el modulo de fisicoquimico de acuerdo con la informacion entregada por el modulo de aprobacion
            if ($controlEspecificaciones == null) {
                $dataBatch['modulo'] = 9;
                error_log('🔍 saveBatchTanques - Ejecutando desinfectanteRealizo para módulo 9');
                $desinfectante = $desinfectanteDao->desinfectanteRealizo($dataBatch);
                error_log('🔍 saveBatchTanques - Resultado desinfectanteRealizo módulo 9: ' . ($desinfectante ? 'error' : 'null'));
            }
            if ($desinfectante == null) {
                error_log('🔍 saveBatchTanques - Ejecutando segundaSeccionRealizo para módulo 9');
                $resp = $firmas2SeccionDao->segundaSeccionRealizo($dataBatch);
                error_log('🔍 saveBatchTanques - Resultado segundaSeccionRealizo módulo 9: ' . ($resp ? 'error' : 'null'));
            }
            // Actualiza estado  modulo fisicoquimico
            if ($modulo == 9 && $resp == null) {
                error_log('🔍 saveBatchTanques - Ejecutando actualizarEstado para módulo 9');
                $resp = $estadoDao->actualizarEstado($dataBatch);
                error_log('🔍 saveBatchTanques - Resultado actualizarEstado módulo 9: ' . ($resp ? 'error' : 'null'));
            }
        }

        if ($resp == null) {
            $resp = array('success' => true, 'message' => "Tanque No. {$tanquesOk} ejecutado con éxito.");
            error_log('✅ saveBatchTanques - Éxito: ' . $resp['message']);
        } else {
            $resp = array('error' => true, 'message' => 'Ocurrio un error durante la ejecución del tanque. intente Nuevamente.');
            error_log('❌ saveBatchTanques - Error: ' . $resp['message']);
        }

        $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
        return $response->withHeader('Content-Type', 'application/json');
        
    } catch (Exception $e) {
        error_log('❌ saveBatchTanques - Excepción capturada: ' . $e->getMessage());
        error_log('❌ saveBatchTanques - Stack trace: ' . $e->getTraceAsString());
        
        $resp = array('error' => true, 'message' => 'Error interno del servidor: ' . $e->getMessage());
        $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});
