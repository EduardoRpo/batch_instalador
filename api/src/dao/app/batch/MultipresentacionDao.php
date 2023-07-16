<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MultipresentacionDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findMulti($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT COUNT(id_batch) AS multi 
                FROM `multipresentacion` 
                WHERE id_batch = :batch ";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $batch]);
        $numberBatch = $query->fetch($connection::FETCH_ASSOC);
        return $numberBatch;
    }
}
