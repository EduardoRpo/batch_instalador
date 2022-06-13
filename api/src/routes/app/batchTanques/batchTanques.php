<?php

use BatchRecord\dao\TanquesChksDao;
use BatchRecord\dao\FlagStartDao;
use BatchRecord\dao\LoteMaterialesDao;
use BatchRecord\dao\ExplosionMaterialesBatchDao;
use BatchRecord\dao\EstadoDao;
use BatchRecord\dao\EquipoDao;
use BatchRecord\dao\DesinfectanteSeleccionadoDao;
use BatchRecord\dao\Firmas2SeccionDao;
use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\ControlEspecificacionesDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$tanquesChksDao = new TanquesChksDao();
$flagStartDao = new FlagStartDao();
$loteMaterialesDao = new LoteMaterialesDao();
$explosionMaterialesBatchDao = new ExplosionMaterialesBatchDao();
$estadoDao = new EstadoDao();
$equipoDao = new EquipoDao();
$desinfectanteSeleccionadoDao = new DesinfectanteSeleccionadoDao();
$firmas2SeccionDao = new Firmas2SeccionDao();
$controlFirmasDao = new ControlFirmasDao();
$controlEspecificacionesDao = new ControlEspecificacionesDao();

$app->post('/saveBatchTanques', function (Request $request, Response $response, $args) use (
    $tanquesChksDao,
    $flagStartDao,
    $loteMaterialesDao,
    $explosionMaterialesBatchDao,
    $estadoDao,
    $equipoDao,
    $desinfectanteSeleccionadoDao,
    $firmas2SeccionDao,
    $controlFirmasDao,
    $controlEspecificacionesDao
) {
    $dataBatch = $request->getParsedBody();

    $op = $dataBatch['operacion'];
    $modulo = $dataBatch['modulo'];
    $tanques = $dataBatch['tanques'];
    $tanquesOk = $dataBatch['tanquesOk'];

    switch ($op) {
        case 1: //Insertar o actualizar tanques y linea
            if ($modulo != 9) {
                $resp = $tanquesChksDao->saveTanquesChks($dataBatch);
                //Insertar flag_start
                // $resp = $flagStartDao->insertFlagStartPesaje($dataBatch);
            }
            // Actualiza el estado de los modulo pesaje y preparacion
            if ($modulo == 2) {
                $resp = $loteMaterialesDao->registrarLotes($dataBatch);
                $resp = $explosionMaterialesBatchDao->registrarExplosionMaterialesUso($dataBatch);
                $resp = $estadoDao->actualizarEstado($dataBatch);
            }
            if ($modulo == 3) {
                // Insertar equipos
                $resp = $equipoDao->insertEquipos($dataBatch);
                // validar que todos los tanques esten hechos para aprobacion
                if ($tanques == $tanquesOk && $resp == null) $resp = $estadoDao->actualizarEstado($dataBatch);
            }
            // Almacena el desinfectante del modulo de aprobacion y fisicoquimico
            if ($modulo == 4) {
                $resp = $desinfectanteSeleccionadoDao->desinfectanteRealizo($dataBatch);
                $resp = $firmas2SeccionDao->segundaSeccionRealizo($dataBatch);
                $resp = $controlFirmasDao->registrarFirmas($dataBatch);
            }
            // Almacena el formulario de control del módulo de preparación
            if ($modulo == 3 || $modulo == 4) {
                $controlEspecificacionesDao->insertCEspecificacionesByPreparacion($dataBatch);
            }
            // Almacena informacion del control de especificaciones para el modulo de fisicoquimico
            if ($modulo == 4 && $tanques == $tanquesOk) {
                $resp = $controlEspecificacionesDao->insertCEspecificacionesByFisicoquimico($dataBatch);
                // Almacenar datos para el modulo de fisicoquimico de acuerdo con la informacion entregada por el modulo de aprobacion
                $dataBatch['modulo'] = 9;
                $resp = $desinfectanteSeleccionadoDao->desinfectanteRealizo($dataBatch);
                $resp = $firmas2SeccionDao->segundaSeccionRealizo($dataBatch);
                // Actualiza estado  modulo fisicoquimico
                if ($modulo == 9 && $resp == null) $resp = $estadoDao->actualizarEstado($dataBatch);
            }
            break;

        case 2: //Seleccionar toda la informacion de los tanques
            if ($modulo != 9) {
                $tanques = $tanquesChksDao->findAllTanquesChks($dataBatch);
                if (!$tanques) $resp = '1';
            }
            break;

        case 3: //Seleccionar 2da firma 
            $firmas2Seccion = $firmas2SeccionDao->findFirmas2seccion($dataBatch);
            if (!$firmas2Seccion) $resp = '1';
            break;
        case 4: // cargar 2da firma despeje
            $firmas2Seccion = $firmas2SeccionDao->findFirmas2seccionByDespeje($dataBatch);
            if (!$firmas2Seccion) $resp = '1';
            break;
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
