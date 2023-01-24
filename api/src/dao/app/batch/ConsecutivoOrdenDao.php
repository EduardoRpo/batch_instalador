<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ConsecutivoOrdenDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findLastOrder()
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT numero_orden FROM `batch` 
                WHERE id_batch = (SELECT MAX(id_batch) FROM `batch`);";
        $query = $connection->prepare($sql);
        $query->execute();
        $number = $query->fetch($connection::FETCH_ASSOC);
        $number  = substr($number['numero_orden'], 2, -3) + 1;

        if (strlen($number) == 1)
            $number = '00' .  $number;
        else if (strlen($number) == 2)
            $number = '0' .  $number;

        $number = 'OP' . $number . '/' . date("y");
        return $number;
    }
}
