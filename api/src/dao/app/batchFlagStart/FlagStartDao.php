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

    public function findFlagStart($dataBatchFlag)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_flag_start WHERE batch = :batch");
        $stmt->execute(['batch' => $dataBatchFlag['idBatch']]);
        //$flagStart = $stmt->fetch($connection::FETCH_ASSOC);
        $rows = $stmt->rowCount();
        return $rows;
    }

    // Guardar Flag_start pesaje
    public function saveFlagStartPesaje($dataBatchFlag)
    {
        $connection = Connection::getInstance()->getConnection();

        //Buscar batch en base de datos
        $rows = $this->findFlagStart($dataBatchFlag);

        if ($rows > 0) {
            $stmt = $connection->prepare("UPDATE batch_flag_start SET flag_start_preparacion = :flag_start_preparacion
            WHERE batch = :batch");
            $stmt->execute([
                'flag_start_preparacion' => 1,
                'batch' => $dataBatchFlag['idBatch']
            ]);
        } else {
            //Seleccionar referencia del batch
            $stmt = $connection->prepare("SELECT * FROM batch WHERE id_batch = :id_batch");
            $stmt->execute(['id_batch' => $dataBatchFlag['idBatch']]);
            $dataBatch = $stmt->fetch($connection::FETCH_ASSOC);


            $stmt = $connection->prepare("INSERT INTO batch_flag_start (referencia, modulo, batch) 
                                      VALUES (:referencia, :modulo, :batch)");
            $stmt->execute([
                'referencia' => $dataBatch['id_producto'],
                'modulo' => $dataBatchFlag['modulo'],
                'batch' => $dataBatchFlag['idBatch']
            ]);
        }
    }

    /* Actualizar Flag_start pesaje
    public function updateFlagStartPreparacion($dataBatchFlag)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("UPDATE batch_flag_start SET flag_start_preparacion = :flag_start_preparacion
                                      WHERE batch = :batch");
        $stmt->execute([
            'flag_start_preparacion' => 1,
            'batch' => $dataBatchFlag['idBatch']
        ]);
    } */
}
