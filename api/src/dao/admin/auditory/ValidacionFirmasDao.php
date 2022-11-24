<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ValidacionFirmasDao extends ControlFirmasMultiDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findDesinfectanteByDate($fecha_hoy)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT batch FROM batch_desinfectante_seleccionado 
                WHERE fecha_registro LIKE '%$fecha_hoy%' GROUP BY batch";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $batchsDS = $stmt->fetchAll($connection::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($batchsDS); $i++) {
            $sql = "SELECT realizo, verifico, batch, modulo 
                    FROM batch_desinfectante_seleccionado 
                    WHERE batch = :batch";
            $stmt = $connection->prepare($sql);
            $stmt->execute(['batch' => $batchsDS[$i]['batch']]);
            $firmas_despeje = $stmt->fetchAll($connection::FETCH_ASSOC);

            foreach ($firmas_despeje as $value) {
                $cantidad = 0;
                $fmodulo = $value['modulo'];

                if ($fmodulo != 9 && $fmodulo != 8) {
                    $value['realizo'] > 0 ? $cantidad = 1 : $cantidad;
                    $value['verifico'] > 0 ? $cantidad = $cantidad + 1 : $cantidad;
                }

                $batchsDS[$i]['modulo'] = $fmodulo;
                $batchsDS[$i]['cantidad'] = $cantidad;
            }
        }

        $this->validarFirmasGestionadas($batchsDS, 1);
    }

    public function findFirmas2SeccionByDate($fecha_hoy)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT batch FROM batch_firmas2seccion 
                WHERE fecha_registro LIKE '$fecha_hoy%' GROUP BY batch";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $batchsF2S = $stmt->fetchAll($connection::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($batchsF2S); $i++) {
            $sql = "SELECT realizo, verifico, batch, modulo 
                    FROM batch_firmas2seccion WHERE batch = :batch GROUP BY modulo";
            $stmt = $connection->prepare($sql);
            $stmt->execute(['batch' => $batchsF2S[$i]['batch']]);
            $firmas_proceso = $stmt->fetchAll($connection::FETCH_ASSOC);

            for ($i = 0; $i < sizeof($firmas_proceso); $i++) {
                $cantidad = 0;

                if ($firmas_proceso[$i]['modulo'] != 4 && $firmas_proceso[$i]['modulo'] != 8) {
                    $firmas_proceso[$i]['realizo'] > 0 ? $cantidad = 1 : $cantidad = 0;
                    $firmas_proceso[$i]['verifico'] > 0 ? $cantidad = $cantidad + 1 : $cantidad;
                }

                $modulo = $firmas_proceso[$i]['modulo'];
                $batchsF2S[$i]['modulo'] = $modulo;
                $batchsF2S[$i]['cantidad'] = $cantidad;
            }
        }

        $this->validarFirmasGestionadas($batchsF2S, 2);
    }

    public function findAnalisisMicrobiologicoByDate($fecha_hoy)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT batch FROM batch_analisis_microbiologico WHERE fecha_registro LIKE '$fecha_hoy%' GROUP BY batch");
        $stmt->execute();
        $batchsAM = $stmt->fetchAll($connection::FETCH_ASSOC);

        foreach ($batchsAM as $arr) {
            $stmt = $connection->prepare("SELECT realizo, verifico, batch, modulo FROM batch_analisis_microbiologico WHERE batch = :batch");
            $stmt->execute(['batch' => $arr['batch']]);
            $firmas_microbiologico = $stmt->fetchAll($connection::FETCH_ASSOC);

            foreach ($firmas_microbiologico as $value) {
                $cantidad = 0;

                if ($value['realizo'] > 0)
                    $cantidad += 1;
                if ($value['verifico'] > 0)
                    $cantidad += 1;

                $modulo = $value['modulo'];
                $indice = array_key_exists($modulo);

                if ($indice)
                    $firmas[$value['modulo']] = $firmas[$modulo] + $cantidad;
                else
                    $firmas[$modulo] = $cantidad;
            }
        }

        return $firmas;
    }

    public function findConciliacionRendimientoByDate($fecha_hoy, $firmas)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT batch FROM batch_conciliacion_rendimiento WHERE fecha_registro LIKE '$fecha_hoy%' GROUP BY batch");
        $stmt->execute();
        $batchsCR = $stmt->fetchAll($connection::FETCH_ASSOC);


        foreach ($batchsCR as $arr) {
            $stmt = $connection->prepare("SELECT entrego, batch, modulo FROM batch_conciliacion_rendimiento WHERE batch = :batch");
            $stmt->execute(['batch' => $arr['batch']]);
            $firmas_conciliacion = $stmt->fetchAll($connection::FETCH_ASSOC);

            foreach ($firmas_conciliacion as $value) {
                $cantidad = 0;

                if ($value['entrego'] > 0)
                    $cantidad += 1;

                $modulo = $value['modulo'];
                $indice = array_key_exists($modulo, $firmas);

                if ($indice)
                    $firmas[$value['modulo']] = $firmas[$modulo] + $cantidad;
                else
                    $firmas[$modulo] = $cantidad;
            }
        }

        return $firmas;
    }

    public function findMaterialSobranteByDate($fecha_hoy, $firmas)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT batch FROM batch_material_sobrante WHERE fecha_registro LIKE '$fecha_hoy%' GROUP BY batch");
        $stmt->execute();
        $batchMS = $stmt->fetchAll($connection::FETCH_ASSOC);

        foreach ($batchMS as $arr) {
            $stmt = $connection->prepare("SELECT realizo, verifico, batch, modulo FROM batch_material_sobrante WHERE batch = :batch GROUP by ref_producto, modulo");
            $stmt->execute(['batch' => $arr['batch']]);
            $firmas_material = $stmt->fetchAll($connection::FETCH_ASSOC);

            if ($firmas_material > 0) {
                $cantidad = 0;

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
            }
        }

        return $firmas;
    }

    public function findLiberacionByDate($fecha_hoy, $firmas)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_liberacion WHERE fecha_registro LIKE '$fecha_hoy%' GROUP BY batch");
        $stmt->execute();
        $batchL = $stmt->fetch($connection::FETCH_ASSOC);

        foreach ($batchL as $arr) {
            $stmt = $connection->prepare("SELECT * FROM batch_liberacion WHERE batch = :batch");
            $stmt->execute(['batch' => $arr['batch']]);
            $firmas_liberacion = $stmt->fetch($connection::FETCH_ASSOC);

            if (isset($firmas_liberacion)) {
                $cantidad = 0;

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
            }
        }
        // Validar firmas gestionadas
        $this->validarFirmasGestionadas($arr['batch'], $firmas);

        // Validar firmas totales
        $this->controlFirmasMulti($arr['batch']);
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
