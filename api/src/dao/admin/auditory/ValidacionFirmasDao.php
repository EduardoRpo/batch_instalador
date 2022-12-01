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

    public function findDesinfectanteByDate($batch)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE batch = :batch";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['batch' => $batch]);
        $batchsDS = $stmt->fetchAll($connection::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($batchsDS); $i++) {
            $cantidad = 0;
            $fmodulo = $batchsDS[$i]['modulo'];

            if ($fmodulo != 9 && $fmodulo != 8) {
                $batchsDS[$i]['realizo'] > 0 ? $cantidad = 1 : $cantidad;
                $batchsDS[$i]['verifico'] > 0 ? $cantidad = $cantidad + 1 : $cantidad;
            }

            $batchsDS[$i]['modulo'] = $fmodulo;
            $batchsDS[$i]['cantidad'] = $cantidad;
        }

        $this->validarFirmasGestionadas($batchsDS, 1);
        return 1;
    }

    public function findFirmas2SeccionByDate($batch)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT * FROM batch_firmas2seccion WHERE batch = :batch";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['batch' => $batch]);
        $batchsF2S = $stmt->fetchAll($connection::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($batchsF2S); $i++) {
            $cantidad = 0;

            if ($batchsF2S[$i]['modulo'] != 4 && $batchsF2S[$i]['modulo'] != 8) {
                $batchsF2S[$i]['realizo'] > 0 ? $cantidad = 1 : $cantidad = 0;
                $batchsF2S[$i]['verifico'] > 0 ? $cantidad = $cantidad + 1 : $cantidad;
            }

            $modulo = $batchsF2S[$i]['modulo'];
            $batchsF2S[$i]['modulo'] = $modulo;
            $batchsF2S[$i]['cantidad'] = $cantidad;
        }

        $this->validarFirmasGestionadas($batchsF2S, 2);
    }

    public function findAnalisisMicrobiologicoByDate($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_analisis_microbiologico WHERE batch = :batch");
        $stmt->execute(['batch' => $batch]);
        $batchsAM = $stmt->fetchAll($connection::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($batchsAM); $i++) {
            $cantidad = 0;

            if ($batchsAM[$i]['realizo'] > 0 || $batchsAM[$i]['verifico'] > 0)
                $cantidad += 1;

            $batchsAM[$i]['cantidad'] = $cantidad;
        }

        $this->validarFirmasGestionadas($batchsAM, 1);
    }

    public function findConciliacionRendimientoByDate($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_conciliacion_rendimiento WHERE batch = :batch");
        $stmt->execute(['batch' => $batch]);
        $batchsCR = $stmt->fetchAll($connection::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($batchsCR); $i++) {
            $cantidad = 0;

            if ($batchsCR[$i]['entrego'] > 0)
                $cantidad += 1;

            $batchsCR[$i]['cantidad'] = $cantidad;
        }

        $this->validarFirmasGestionadas($batchsCR, 1);
    }

    public function findMaterialSobranteByDate($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_material_sobrante WHERE batch = :batch");
        $stmt->execute(['batch' => $batch]);
        $batchMS = $stmt->fetchAll($connection::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($batchMS); $i++) {
            $cantidad = 0;

            if ($batchMS[$i]['modulo'] == 5 || $batchMS[$i]['modulo'] == 6) {
                if ($batchMS[$i]['realizo'] > 0 || $batchMS[$i]['verifico'] > 0)
                    $cantidad += 1;

                $batchMS[$i]['cantidad'] = $cantidad;
            }
        }

        $this->validarFirmasGestionadas($batchMS, 1);
    }

    public function findLiberacionByDate($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_liberacion WHERE batch = :batch");
        $stmt->execute(['batch' => $batch]);
        $batchL = $stmt->fetchAll($connection::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($batchL); $i++) {
            $cantidad = 0;

            if ($batchL[$i]['dir_produccion'] > 0 || $batchL[$i]['dir_calidad'] > 0 || $batchL[$i]['dir_tecnica'] > 0)
                $cantidad = $cantidad + 1;

            $batchL[$i]['cantidad'] = $cantidad;
        }
        // Validar firmas gestionadas
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

            //if ($controlFirmas['cantidad_firmas'] != $batch['cantidad']) {

            $seccion == 2
                ? $cantidad = $controlFirmas['cantidad_firmas'] + $batch['cantidad']
                : $cantidad = $batch['cantidad'];

            $sql = "UPDATE batch_control_firmas SET cantidad_firmas = :firmas 
                        WHERE modulo = :modulo and batch = :batch";
            $stmt = $connection->prepare($sql);
            $stmt->execute([
                'batch' => $batch['batch'],
                'modulo' => $batch['modulo'],
                'firmas' => $cantidad
            ]);
            //}
        }
    }
}
