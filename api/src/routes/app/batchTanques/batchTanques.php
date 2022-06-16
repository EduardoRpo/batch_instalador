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
    $controlEspecificacionesDao
) {
    $dataBatch = $request->getParsedBody();

    $modulo = $dataBatch['modulo'];
    $tanques = $dataBatch['tanques'];
    $tanquesOk = $dataBatch['tanquesOk'];


    if ($modulo != 9) {
        $resp = $tanquesChksDao->saveTanquesChks($dataBatch);
    }
    // Actualiza el estado de los modulo pesaje y preparacion
    if ($modulo == 2) {
        $lotesMateriales = $loteMaterialesDao->registrarLotes($dataBatch);
        if ($lotesMateriales == null) $explosionMateriales = $explosionMaterialesBatchDao->registrarExplosionMaterialesUso($dataBatch);
        if ($explosionMateriales == null) $estado = $estadoDao->actualizarEstado($dataBatch);
        if ($estado == null) {
            $batch = $batchDao->findBatch($dataBatch);
            $dataBatch['referencia'] = $batch['id_producto'];
            //Insertar flag_start
            $resp = $flagStartDao->insertFlagStart($dataBatch);
        }
    }
    //Insertar flags correspondientes
    if ($modulo == 3 || $modulo == 5 || $modulo == 6) {
        $batch = $batchDao->findBatch($dataBatch);
        $dataBatch['referencia'] = $batch['id_producto'];
        //Guardar flag_start
        $resp = $flagStartDao->saveFlagStart($dataBatch);
    }
    if ($modulo == 3) {
        // Insertar equipos
        $resp = $equipoDao->insertEquipos($dataBatch);
        // validar que todos los tanques esten hechos para aprobacion
        if ($tanques == $tanquesOk && $resp == null)
            $resp = $estadoDao->actualizarEstado($dataBatch);
    }
    // Almacena el desinfectante del modulo de aprobacion y fisicoquimico
    if ($modulo == 4) {
        $desinfectante = $desinfectanteDao->desinfectanteRealizo($dataBatch);
        if ($desinfectante == null) $firmas2Seccion = $firmas2SeccionDao->segundaSeccionRealizo($dataBatch);
        if ($firmas2Seccion == null) $resp = $controlFirmasDao->registrarFirmas($dataBatch);
    }

    // Almacena el formulario de control del módulo de preparación
    if ($modulo == 3 || $modulo == 4) {
        $resp = $controlEspecificacionesDao->insertCEspecificacionesByPreparacion($dataBatch);
    }

    // Almacena informacion del control de especificaciones para el modulo de fisicoquimico
    if ($modulo == 4 && $tanques == $tanquesOk) {
        $controlEspecificaciones = $controlEspecificacionesDao->insertCEspecificacionesByFisicoquimico($dataBatch);
        // Almacenar datos para el modulo de fisicoquimico de acuerdo con la informacion entregada por el modulo de aprobacion
        if ($controlEspecificaciones == null) {
            $dataBatch['modulo'] = 9;
            $desinfectante = $desinfectanteDao->desinfectanteRealizo($dataBatch);
        }
        if ($desinfectante == null) $resp = $firmas2SeccionDao->segundaSeccionRealizo($dataBatch);
        // Actualiza estado  modulo fisicoquimico
        if ($modulo == 9 && $resp == null)
            $resp = $estadoDao->actualizarEstado($dataBatch);
    }

    if ($resp == null)
        $resp = array('success' => true, 'message' => "Tanque No. {$tanquesOk} ejecutado con éxito.");
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error durante la firma de tanques.');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
