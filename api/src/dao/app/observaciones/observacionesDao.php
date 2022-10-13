<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ObservacionesDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findObservaciones($dataBatch)
    {
        $connection = Connection::getInstance()->getconnection();

        $stmt = $connection->prepare("SELECT * FROM observaciones
                                      WHERE id_batch = :batch");
        $stmt->execute([
            'batch' => $dataBatch['batch']
        ]);
        $observaciones = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $observaciones;
    }

    public function insertObservacion($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $fecha_hoy = date('Y-m-d');

        $stmt = $connection->prepare("INSERT INTO observaciones (observaciones, id_batch, id_modulo, fecha_registro)
                                      VALUES (:observacion, :batch, :modulo, :fecha_registro)");
        $stmt->execute([
            'observacion' => $dataBatch['comment'],
            'batch' => $dataBatch['batch'],
            'modulo' => $dataBatch['modulo'],
            'fecha_registro' => $fecha_hoy
        ]);
    }
}
