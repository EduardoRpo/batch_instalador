<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class FlagStartDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }


    // Insertar Flag_start pesaje
    public function insertFlagStartPesaje($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("INSERT INTO batch_flag_start (referencia, modulo, batch) 
                                      VALUES (:referencia, :modulo, :batch)");
        $stmt->execute([
            'referencia' => $dataBatch['referencia'],
            'modulo' => 2,
            'batch' => $dataBatch['idBatch']
        ]);
    }

    // Actualizar Flag_start pesaje
    public function updateFlagStartPreparacion($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("UPDATE batch_flag_start SET flag_start_preparacion = :flag_start_preparacion
                                      WHERE batch = :batch");
        $stmt->execute([
            'flag_start_preparacion' => 1,
            'batch' => $dataBatch['idBatch']
        ]);
    }
}
