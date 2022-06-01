<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ControlFirmasDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function saveControlFirmas($id_batch)
    {
        $connection = Connection::getInstance()->getConnection();
        
        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('2' , :id_batch, '0', '4')";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('3' , :id_batch, '0', '4')";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('4' , :id_batch, '0', '2')";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('5' , :id_batch, '0', '6')";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('6' , :id_batch, '0', '7')";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('7' , :id_batch, '0', '1')";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('8' , :id_batch, '0', '2')";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('9' , :id_batch, '0', '2')";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('10' , :id_batch, '0', '3')";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);
    }
}
