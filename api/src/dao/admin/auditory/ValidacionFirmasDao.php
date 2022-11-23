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

        $stmt = $connection->prepare("SELECT batch FROM batch_desinfectante_seleccionado 
                                      WHERE fecha_registro LIKE '$fecha_hoy%' GROUP BY batch");
        $stmt->execute();
        $batchsDS = $stmt->fetchAll($connection::FETCH_ASSOC);


        foreach ($batchsDS as $arr) {
            $stmt = $connection->prepare("SELECT realizo, verifico, batch, modulo FROM batch_desinfectante_seleccionado 
                                      WHERE batch = :batch");
            $stmt->execute(['fecha' => $arr['bacth']]);
            $firmas_despeje = $stmt->fetchAll($connection::FETCH_ASSOC);

            foreach ($firmas_despeje as $value) {
                $cantidad = 0;
                $fmodulo = $value['modulo'];

                if ($fmodulo != 9 && $fmodulo != 8) {
                    if ($value['realizo'] > 0)
                        $cantidad += 1;
                    if ($value['verifico'] > 0)
                        $cantidad += 1;
                }
                $firmas[$value['modulo']] = $cantidad;
            }
        }

        return $firmas;
    }

    public function findFirmas2SeccionByDate($fecha_hoy, $firmas)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT batch FROM batch_firmas2seccion WHERE fecha_registro LIKE '$fecha_hoy%' GROUP BY batch");
        $stmt->execute();
        $bacthsF2S = $stmt->fetchAll($connection::FETCH_ASSOC);

        foreach ($bacthsF2S as $arr) {
            $stmt = $connection->prepare("SELECT COUNT(realizo) AS realizo, COUNT(verifico) AS verifico, batch, modulo FROM batch_firmas2seccion WHERE batch = :batch GROUP BY modulo");
            $stmt->execute(['batch' => $arr['bacth']]);
            $firmas_proceso = $stmt->fetchAll($connection::FETCH_ASSOC);


            foreach ($firmas_proceso as $value) {
                $cantidad = 0;

                if ($value['modulo'] != 4 && $value['modulo'] != 8)
                    $cantidad = $value['realizo'] + $value['verifico'];
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

    public function findAnalisisMicrobiologicoByDate($fecha_hoy, $firmas)
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
                $indice = array_key_exists($modulo, $firmas);

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

            // Validar firmas gestionadas
            $this->validarFirmasGestionadas($arr['batch'], $firmas);

            // Validar firmas totales
            $this->controlFirmasMulti($arr['batch']);
        }
    }

    public function validarFirmasGestionadas($batch, $firmas)
    {
        $connection = Connection::getInstance()->getConnection();

        foreach ($firmas as $key => $value) {

            $stmt = $connection->prepare("SELECT * FROM batch_control_firmas WHERE modulo= :modulo AND batch = :batch");
            $stmt->execute(['batch' => $batch, 'modulo' => $key]);
            $controlFirmas = $stmt->fetch($connection::FETCH_ASSOC);

            if ($controlFirmas['cantidad_firmas'] != $controlFirmas['total_firmas']) {
                $stmt = $connection->prepare("UPDATE batch_control_firmas SET cantidad_firmas = :firmas WHERE modulo = :modulo and batch = :batch");
                $stmt->execute(['batch' => $batch, 'modulo' => $key, 'firmas' => $value]);
            }
        }
    }
}
