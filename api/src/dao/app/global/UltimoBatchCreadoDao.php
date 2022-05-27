<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class UltimoBatchCreadoDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function ultimoBatchCreado()
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT MAX(id_batch) AS id FROM batch";
        $query = $connection->prepare($sql);
        $query->execute();
        $id_batch = $query->fetch($connection::FETCH_ASSOC);
        return $id_batch;
    }
}
