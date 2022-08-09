<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ActualizarBatchDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

function ActualizarBatch($databatch)
{
    $connection = Connection::getInstance()->getConection();
    $stmt = $connection->prepare("UPDATE batch SET estado = :estado WHERE id_producto = :referencia");
    $result = $stmt->execute(['estado' => $databatch["estado"], 'referencia' => $databatch['ref_producto']]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    return $result;
}
}