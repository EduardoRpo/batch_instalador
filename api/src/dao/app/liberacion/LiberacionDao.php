<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class LiberacionDao

{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findFirmasControlRealizado($batch, $modulo)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_control_firmas WHERE batch = :batch AND modulo = :modulo");

        $stmt->execute(['batch' => $batch, 'modulo' => $modulo]);
        $firmas = $stmt->fetch($connection::FETCH_ASSOC);
        return $firmas;
    }

    public function liberacionLote($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        try {
            $stmt = $connection->prepare("SELECT * FROM batch_liberacion WHERE batch = :batch");
            $stmt->execute(['batch' => $dataBatch['idBatch']]);

            $result = $stmt->rowCount();

            if ($result > 0) {
                $user = $dataBatch['info'];
                $btn = $dataBatch['id'];

                if ($btn == 'produccion_realizado')
                    $sql = "UPDATE batch_liberacion SET dir_produccion = :realizo WHERE batch = :batch";

                if ($btn == 'calidad_verificado')
                    $sql = "UPDATE batch_liberacion SET dir_calidad = :realizo WHERE batch = :batch";

                if ($btn == 'tecnica_realizado')
                    $sql = "UPDATE batch_liberacion SET dir_tecnica = :realizo WHERE batch = :batch";

                $stmt = $connection->prepare($sql);
                $stmt->execute(['batch' => $dataBatch['idBatch'], 'realizo' => $user['id']]);
            } else {
                $user = $dataBatch['info'];
                $btn = $dataBatch['id'];
                $aprobacion = $dataBatch['radio'];
                $observaciones = $dataBatch['obs'];

                if ($btn == 'produccion_realizado') {
                    $produccion = $user['id'];
                    $calidad = 0;
                    $tecnica = 0;
                }

                if ($btn == 'calidad_verificado') {
                    $produccion = 0;
                    $calidad = $user['id'];
                    $tecnica = 0;
                }

                if ($btn == 'tecnica_realizado') {
                    $produccion = 0;
                    $calidad = 0;
                    $tecnica = $user['id'];
                }

                $sql = "INSERT INTO batch_liberacion (aprobacion, observaciones, dir_produccion, dir_calidad, dir_tecnica, batch) 
                        VALUES(:aprobacion, :observaciones, :produccion, :calidad, :tecnica, :batch)";

                $stmt = $connection->prepare($sql);
                $stmt->execute([
                    'aprobacion' => $aprobacion,
                    'observaciones' => $observaciones,
                    'produccion' => $produccion,
                    'calidad' => $calidad,
                    'tecnica' => $tecnica,
                    'batch' => $dataBatch['idBatch'],
                ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
