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

    // Insertar flag_start pesaje
    public function insertFlagStart($dataBatchFlag)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("INSERT INTO batch_flag_start (referencia, modulo, batch) 
                                      VALUES (:referencia, :modulo, :batch)");
        $stmt->execute([
            'referencia' => $dataBatchFlag['referencia'],
            'modulo' => $dataBatchFlag['modulo'],
            'batch' => $dataBatchFlag['idBatch']
        ]);
    }

    // Guardar Flag_start
    public function saveFlagStart($dataBatchFlag)
    {
        $connection = Connection::getInstance()->getConnection();

        //Buscar batch en base de datos
        $rows = $this->findFlagStart($dataBatchFlag);
        $modulo = $dataBatchFlag['modulo'];

        if ($modulo == 3) $flag = 'flag_start_preparacion';
        if ($modulo == 5) $flag = 'flag_start_envasado';
        if ($modulo == 6) $flag = 'flag_start_acondicionamiento';

        if ($rows > 0) {
            $stmt = $connection->prepare("UPDATE batch_flag_start SET {$flag} = :flag
            WHERE batch = :batch");
            $stmt->execute([
                'flag' => $dataBatchFlag['tanques'],
                'batch' => $dataBatchFlag['idBatch']
            ]);
        } else {
            $stmt = $connection->prepare("INSERT INTO batch_flag_start ({$flag}, referencia, modulo, batch) 
                                      VALUES (:flag, :referencia, :modulo, :batch)");
            $stmt->execute([
                'flag' => $dataBatchFlag['tanques'],
                'referencia' => $dataBatchFlag['referencia'],
                'modulo' => $modulo,
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
