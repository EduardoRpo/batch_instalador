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

    public function registrarFirmas($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        /* Buscar si existen firmas registradas */
        $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch AND modulo = :modulo";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $dataBatch['idBatch'], 'modulo' => $dataBatch['modulo']]);
        $rows = $query->rowCount();

        if ($rows > 0) {
            $data = $query->fetchAll($connection::FETCH_ASSOC);

            if (sizeof($data) > 0)
                $cantidad = $data[0]['cantidad_firmas'] + 1;
            else
                $cantidad = 1;

            $sql = "UPDATE batch_control_firmas SET cantidad_firmas = :cantidad 
                WHERE batch = :batch AND modulo = :modulo";
            $query = $connection->prepare($sql);
            $query->execute(['cantidad' => $cantidad, 'batch' => $dataBatch['idBatch'], 'modulo' => $dataBatch['modulo']]);
        }
    }
}
