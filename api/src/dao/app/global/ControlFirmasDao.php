<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ControlFirmasMultiDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function saveControlFirmas($lastIdInsert)
    {
        $connection = Connection::getInstance()->getConnection();

        $query_id = "SELECT MAX(id_batch) AS id FROM batch";
        $query_id = mysqli_query($connection, "SELECT MAX(id_batch) AS id FROM batch");
        $result = mysqli_num_rows($query_id);

        if ($result > 0)
            $data = mysqli_fetch_assoc($query_id);
        $id = trim($data['id']);

        $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('2' , '$id', '0', '4')";
        $result = mysqli_query($connection, $query_firmas);

        $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('3' , '$id', '0', '4')";
        $result = mysqli_query($connection, $query_firmas);

        $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('4' , '$id', '0', '2')";
        $result = mysqli_query($connection, $query_firmas);

        $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('5' , '$id', '0', '6')";
        $result = mysqli_query($connection, $query_firmas);

        $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('6' , '$id', '0', '7')";
        $result = mysqli_query($connection, $query_firmas);

        $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('7' , '$id', '0', '1')";
        $result = mysqli_query($connection, $query_firmas);

        $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('8' , '$id', '0', '2')";
        $result = mysqli_query($connection, $query_firmas);

        $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('9' , '$id', '0', '2')";
        $result = mysqli_query($connection, $query_firmas);

        $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('10' , '$id', '0', '3')";
        $result = mysqli_query($connection, $query_firmas);
    }
}
