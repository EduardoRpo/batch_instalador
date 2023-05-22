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


    public function findDesinfectanteByDate($batch, $firmas)
    {
        try {
            $connection = Connection::getInstance()->getConnection();
            $sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE batch = :batch";
            $stmt = $connection->prepare($sql);
            $stmt->execute(['batch' => $batch]);
            $batchsDS = $stmt->fetchAll($connection::FETCH_ASSOC);


            for ($i = 0; $i < sizeof($batchsDS); $i++) {
                $cantidad = 0;

                $fmodulo = $batchsDS[$i]['modulo'];

                if ($fmodulo != 9 && $fmodulo != 8) {
                    if ($batchsDS[$i]['realizo'] > 0)
                        $cantidad = $cantidad + 1;
                    if ($batchsDS[$i]['verifico'] > 0)
                        $cantidad = $cantidad + 1;
                }

                $firmas[$batchsDS[$i]['modulo']] =  $cantidad;
            }

            return $firmas;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('error' => true, 'message' => $message);
            return $error;
        }
    }

    public function findFirmas2SeccionByDate($batch, $firmas)
    {
        try {
            $connection = Connection::getInstance()->getConnection();
            //$sql = "SELECT COUNT(realizo) AS realizo, COUNT(verifico) AS verifico, batch, modulo FROM batch_firmas2seccion WHERE batch = :batch GROUP BY modulo";
            $sql = "SELECT realizo, verifico, batch, modulo FROM batch_firmas2seccion WHERE batch = :batch GROUP BY modulo";
            $stmt = $connection->prepare($sql);
            $stmt->execute(['batch' => $batch]);
            $batchsF2S = $stmt->fetchAll($connection::FETCH_ASSOC);


            for ($i = 0; $i < sizeof($batchsF2S); $i++) {
                $cantidad = 0;

                if ($batchsF2S[$i]['modulo'] != 4 && $batchsF2S[$i]['modulo'] != 8) {
                    ($batchsF2S[$i]['realizo'] > 0) ? $countR = 1 : $countR = 0;
                    ($batchsF2S[$i]['verifico'] > 0) ? $countV = 1 : $countV = 0;

                    //$cantidad = $batchsF2S[$i]['realizo'] + $batchsF2S[$i]['verifico'];
                    $cantidad = $countV + $countR;
                }

                $modulo = $batchsF2S[$i]['modulo'];
                $firmas[$batchsF2S[$i]['modulo']] = $firmas[$modulo] + $cantidad;
            }

            return $firmas;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('error' => true, 'message' => $message);
            return $error;
        }
    }

    public function findConciliacionRendimientoByDate($batch, $firmas)
    {
        try {
            $connection = Connection::getInstance()->getConnection();
            $sql = "SELECT * FROM batch_conciliacion_rendimiento WHERE batch = :batch";
            $stmt = $connection->prepare($sql);
            $stmt->execute(['batch' => $batch]);
            $batchsCR = $stmt->fetchAll($connection::FETCH_ASSOC);


            for ($i = 0; $i < sizeof($batchsCR); $i++) {
                $cantidad = 0;

                if ($batchsCR[$i]['entrego'] > 0)
                    $cantidad += 1;

                $modulo = $batchsCR[$i]['modulo'];
                $firmas[$batchsCR[$i]['modulo']] = $firmas[$modulo] + $cantidad;
            }

            return $firmas;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('error' => true, 'message' => $message);
            return $error;
        }
    }

    public function findMaterialSobranteByDate($batch, $firmas)
    {
        try {
            $connection = Connection::getInstance()->getConnection();
            $sql = "SELECT * FROM batch_material_sobrante WHERE batch = :batch GROUP by ref_producto, modulo";
            $stmt = $connection->prepare($sql);
            $stmt->execute(['batch' => $batch]);
            $batchMS = $stmt->fetchAll($connection::FETCH_ASSOC);

            if (sizeof($batchMS) > 0) {

                $cantidad = 0;
                for ($i = 0; $i < sizeof($batchMS); $i++) {

                    if ($batchMS[$i]['modulo'] == 5) {
                        if ($batchMS[$i]['realizo'] > 0)
                            $cantidad = $cantidad + 1;
                        if ($batchMS[$i]['verifico'] > 0)
                            $cantidad = $cantidad + 1;
                    }
                }
                $modulo = 5;
                $firmas[$modulo] = $firmas[$modulo] + $cantidad;
                $cantidad = 0;


                for ($i = 0; $i < sizeof($batchMS); $i++) {
                    if ($batchMS[$i]['modulo'] == 6) {
                        if ($batchMS[$i]['realizo'] > 0)
                            $cantidad = $cantidad + 1;
                        if ($batchMS[$i]['verifico'] > 0)
                            $cantidad = $cantidad + 1;
                    }
                }
                $modulo = 6;
                $firmas[$modulo] = $firmas[$modulo] + $cantidad;
            }

            return $firmas;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('error' => true, 'message' => $message);
            return $error;
        }
    }

    public function findAnalisisMicrobiologicoByDate($batch, $firmas)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("SELECT * FROM batch_analisis_microbiologico WHERE batch = :batch");
            $stmt->execute(['batch' => $batch]);
            $batchsAM = $stmt->fetchAll($connection::FETCH_ASSOC);


            for ($i = 0; $i < sizeof($batchsAM); $i++) {
                $cantidad = 0;

                if ($batchsAM[$i]['realizo'] > 0 || $batchsAM[$i]['verifico'] > 0) {
                    $batchsAM[$i]['realizo'] > 0 ? $cantidad = 1 : $cantidad;
                    $batchsAM[$i]['verifico'] > 0 ? $cantidad  += 1 : $cantidad;
                }

                $modulo = $batchsAM[$i]['modulo'];
                $firmas[$batchsAM[$i]['modulo']] = $firmas[$modulo] + $cantidad;
            }

            return $firmas;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('error' => true, 'message' => $message);
            return $error;
        }
    }

    public function findLiberacionByDate($batch, $firmas)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            $stmt = $connection->prepare("SELECT * FROM batch_liberacion WHERE batch = :batch");
            $stmt->execute(['batch' => $batch]);
            $batchL = $stmt->fetchAll($connection::FETCH_ASSOC);


            for ($i = 0; $i < sizeof($batchL); $i++) {
                $cantidad = 0;

                if ($batchL[$i]['dir_produccion'] > 0 || $batchL[$i]['dir_calidad'] > 0 || $batchL[$i]['dir_tecnica'] > 0) {
                    $batchL[$i]['dir_produccion'] > 0 ? $cantidad = 1 : $cantidad;
                    $batchL[$i]['dir_calidad'] > 0 ? $cantidad  += 1 : $cantidad;
                    $batchL[$i]['dir_tecnica'] > 0 ? $cantidad += 1 : $cantidad;
                }


                $modulo = 10;
                $firmas[$modulo] = $firmas[$modulo] + $cantidad;
            }

            return $firmas;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('error' => true, 'message' => $message);
            return $error;
        }
    }

    public function validarFirmasGestionadas($batch, $firmas)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            foreach ($firmas as $key => $value) {
                $sql = "SELECT * FROM batch_control_firmas WHERE modulo= :modulo AND batch = :batch";
                $query = $connection->prepare($sql);
                $query->execute(['batch' => $batch, 'modulo' => $key]);
                $data = $query->fetchAll($connection::FETCH_ASSOC);

                if (sizeof($data) == 0) {
                    $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas) VALUES(:modulo, :batch, :firmas)";
                    $query = $connection->prepare($sql);
                    $query->execute(['batch' => $batch, 'modulo' => $key, 'firmas' => $value]);
                } else {
                    $sql = "UPDATE batch_control_firmas SET cantidad_firmas = :firmas WHERE modulo = :modulo AND batch = :batch";
                    $query = $connection->prepare($sql);
                    $query->execute(['batch' => $batch, 'modulo' => $key, 'firmas' => $value]);
                }
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('error' => true, 'message' => $message);
            return $error;
        }
    }
}
