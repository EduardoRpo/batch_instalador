<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class batchAprobadoDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function updateBatchAprobado($batch)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "UPDATE batch SET ok_aprobado = 1 WHERE id_batch = :batch";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['batch' => $batch]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
