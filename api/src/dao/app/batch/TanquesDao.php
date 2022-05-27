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

    public function findTanquesById($id_batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT tanque, cantidad FROM batch_tanques WHERE id_batch = :id_batch";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);
        $tanques = $query->fetch($connection::FETCH_ASSOC);
        return $tanques;
    }

    public function saveTanques($id_batch, $dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "INSERT INTO batch_tanques (tanque, cantidad, id_batch) 
                VALUES(:tanque, :cantidades, :id)";
        $query_multi = $connection->prepare($sql);
        $query_multi->execute([
            'tanque' => $dataBatch['tanque'],
            'cantidades' => $dataBatch['cantidades'],
            'id' => $id_batch
        ]);
    }
}
