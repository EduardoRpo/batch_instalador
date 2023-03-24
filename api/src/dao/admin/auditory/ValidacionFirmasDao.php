<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ValidacionFirmasDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findDesinfectanteByDate($batch, $fecha_hoy)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE batch = :batch AND fecha_registro LIKE '%:$fecha_hoy%'";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['batch' => $batch]);
        $batchsDS = $stmt->fetchAll($connection::FETCH_ASSOC);

        if (sizeof($batchsDS) == 0) {
            for ($i = 2; $i <= 9; $i++) {
                if ($i != 7 && $i != 8) {
                    $batchsDS = array_merge($batchsDS, array(array('modulo' => $i, 'batch' => $batch, 'cantidad' => 0)));
                }
            }
        }

        for ($i = 0; $i < sizeof($batchsDS); $i++) {
            $cantidad = 0;
            $fmodulo = $batchsDS[$i]['modulo'];

            if ($fmodulo != 4 && $fmodulo != 9 && $fmodulo != 8) {
                $batchsDS[$i]['realizo'] > 0 ? $cantidad = 1 : $cantidad;
                $batchsDS[$i]['verifico'] > 0 ? $cantidad = $cantidad + 1 : $cantidad;
            }

            $batchsDS[$i]['modulo'] = $fmodulo;
            $batchsDS[$i]['cantidad'] = $cantidad;
        }

        $this->validarFirmasGestionadas($batchsDS, 1);
    }

    public function findFirmas2SeccionByDate($batch, $fecha_hoy)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT * FROM batch_firmas2seccion WHERE batch = :batch AND fecha_registro LIKE '%:$fecha_hoy%'";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['batch' => $batch]);
        $batchsF2S = $stmt->fetchAll($connection::FETCH_ASSOC);

        if (sizeof($batchsF2S) == 0) {
            for ($i = 2; $i <= 9; $i++) {
                if ($i != 7 && $i != 8) {
                    $batchsF2S = array_merge($batchsF2S, array(array('modulo' => $i, 'batch' => $batch, 'cantidad' => 0)));
                }
            }
        }

        for ($i = 0; $i < sizeof($batchsF2S); $i++) {
            $cantidad = 0;

            if ($batchsF2S[$i]['modulo'] != 8) {
                $batchsF2S[$i]['realizo'] > 0 ? $cantidad = 1 : $cantidad = 0;
                $batchsF2S[$i]['verifico'] > 0 ? $cantidad = $cantidad + 1 : $cantidad;
            }

            $modulo = $batchsF2S[$i]['modulo'];
            $batchsF2S[$i]['modulo'] = $modulo;
            $batchsF2S[$i]['cantidad'] = $cantidad;
        }

        $this->validarFirmasGestionadas($batchsF2S, 2);
    }

    public function findConciliacionRendimientoByDate($batch, $fecha_hoy)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT * FROM batch_conciliacion_rendimiento 
                WHERE batch = :batch AND modulo = 6 AND fecha_registro LIKE '%:$fecha_hoy%'";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['batch' => $batch]);
        $batchsCR = $stmt->fetchAll($connection::FETCH_ASSOC);

        if (sizeof($batchsCR) == 0) {
            $batchsCR[0]['cantidad'] = 0;
            $batchsCR[0]['batch'] = $batch;
            $batchsCR[0]['modulo'] = 6;
        }

        for ($i = 0; $i < sizeof($batchsCR); $i++) {
            $cantidad = 0;

            if ($batchsCR[$i]['entrego'] > 0)
                $cantidad += 1;

            $batchsCR[$i]['cantidad'] = $cantidad;
        }

        $this->validarFirmasGestionadas($batchsCR, 2);
    }

    public function findMaterialSobranteByDate($batch, $fecha_hoy)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT DISTINCT ref_producto, modulo, batch, realizo, verifico 
                FROM batch_material_sobrante 
                WHERE batch = :batch AND fecha_registro LIKE '%:$fecha_hoy%'";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['batch' => $batch]);
        $batchMS = $stmt->fetchAll($connection::FETCH_ASSOC);

        if (sizeof($batchMS) == 0) {
            $batchMS[0]['cantidad'] = 0;
            $batchMS[0]['batch'] = $batch;
            $batchMS[0]['modulo'] = 5;
            $batchMS[1]['cantidad'] = 0;
            $batchMS[1]['batch'] = $batch;
            $batchMS[1]['modulo'] = 6;
        }

        for ($i = 0; $i < sizeof($batchMS); $i++) {
            $cantidad = 0;

            if ($batchMS[$i]['modulo'] == 5 || $batchMS[$i]['modulo'] == 6) {
                $batchMS[$i]['realizo'] > 0 ? $cantidad = 1 : $cantidad = 0;
                $batchMS[$i]['verifico'] > 0 ? $cantidad = $cantidad + 1 : $cantidad;

                $batchMS[$i]['cantidad'] = $cantidad;
            }
        }

        $this->validarFirmasGestionadas($batchMS, 2);
    }

    public function findAnalisisMicrobiologicoByDate($batch, $fecha_hoy)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_analisis_microbiologico WHERE batch = :batch AND fecha_registro LIKE '%:$fecha_hoy%'");
        $stmt->execute(['batch' => $batch]);
        $batchsAM = $stmt->fetchAll($connection::FETCH_ASSOC);

        if (sizeof($batchsAM) == 0) {
            $batchsAM[0]['cantidad'] = 0;
            $batchsAM[0]['batch'] = $batch;
            $batchsAM[0]['modulo'] = 8;
        }

        for ($i = 0; $i < sizeof($batchsAM); $i++) {
            $cantidad = 0;
            $batchsAM[$i]['realizo'] > 0 ? $cantidad = 1 : $cantidad = 0;
            $batchsAM[$i]['verifico'] > 0 ? $cantidad = $cantidad + 1 : $cantidad;
            $batchsAM[$i]['cantidad'] = $cantidad;
        }

        $this->validarFirmasGestionadas($batchsAM, 1);
    }

    public function findLiberacionByDate($batch, $fecha_hoy)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_liberacion WHERE batch = :batch AND fecha_registro LIKE '%:$fecha_hoy%'");
        $stmt->execute(['batch' => $batch]);
        $batchL = $stmt->fetchAll($connection::FETCH_ASSOC);

        if (sizeof($batchL) == 0) {
            $batchL[0]['cantidad'] = 0;
            $batchL[0]['batch'] = $batch;
        }

        for ($i = 0; $i < sizeof($batchL); $i++) {
            $cantidad = 0;

            $batchL[$i]['dir_produccion'] > 0 ? $cantidad = 1 : $cantidad = 0;
            $batchL[$i]['dir_calidad'] > 0 ? $cantidad = $cantidad + 1 : $cantidad;
            $batchL[$i]['dir_tecnica'] > 0 ? $cantidad = $cantidad + 1 : $cantidad;

            $batchL[$i]['cantidad'] = $cantidad;
        }
        // Validar firmas gestionadas
        $batchL[0]['modulo'] = 10;
        $this->validarFirmasGestionadas($batchL, 1);
    }

    public function validarFirmasGestionadas($batchs, $seccion)
    {
        $connection = Connection::getInstance()->getConnection();

        foreach ($batchs as $batch) {

            $sql = "SELECT * FROM batch_control_firmas 
                    WHERE modulo= :modulo AND batch = :batch";
            $stmt = $connection->prepare($sql);
            $stmt->execute(['batch' => $batch['batch'], 'modulo' => $batch['modulo']]);
            $controlFirmas = $stmt->fetch($connection::FETCH_ASSOC);

            $seccion == 2
                ? $cantidad = $controlFirmas['cantidad_firmas'] + $batch['cantidad']
                : $cantidad = $batch['cantidad'];

            if ($cantidad <= $controlFirmas['total_firmas']) {
                $sql = "UPDATE batch_control_firmas SET cantidad_firmas = :firmas 
                        WHERE modulo = :modulo and batch = :batch";
                $stmt = $connection->prepare($sql);
                $stmt->execute([
                    'batch' => $batch['batch'],
                    'modulo' => $batch['modulo'],
                    'firmas' => $cantidad
                ]);
            }
        }
    }
}
