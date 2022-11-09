<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ControlFirmasDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllControlFirmasByBatch($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_control_firmas WHERE batch = :batch ORDER BY modulo");
        $stmt->execute(['batch' => $batch]);

        $firmas = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $firmas;
    }
}
