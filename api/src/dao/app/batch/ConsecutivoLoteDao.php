<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ConsecutivoLoteDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findLastSequent($linea)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT MAX(id_batch), numero_lote FROM `batch` WHERE numero_lote LIKE :linea 
                ORDER BY `batch`.`id_batch` DESC";
        $query = $connection->prepare($sql);
        $query->execute(['linea' => $linea]);
        $number = $query->fetch($connection::FETCH_ASSOC);
        return $number;
    }
}
