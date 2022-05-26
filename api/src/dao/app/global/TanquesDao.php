<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class TanquesDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function saveTanques($tanque, $cantidades, $lastIdInsert)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "INSERT INTO batch_tanques (tanque, cantidad, id_batch) 
                VALUES(:tanque, :cantidades, :id)";
        $query_multi = $connection->prepare($sql);
        $query_multi->execute([
            'tanque' => $tanque,
            'cantidades' => $cantidades,
            'id' => $lastIdInsert
        ]);
    }
}
