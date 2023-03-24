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

    public function controlCantidadFirmas($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        for ($i = 2; $i < 11; $i++) {
            if ($i == 2 || $i == 3) $total_firmas = 4;
            if ($i == 4 || $i == 9) $total_firmas = 2;
            if ($i == 10) $total_firmas = 3;

            // if ($i > 4 && $i < 9) {
            $sql = "UPDATE batch_control_firmas SET total_firmas = :total_firmas 
                        WHERE batch = :batch AND modulo = :modulo";
            $query = $connection->prepare($sql);
            $query->execute([
                'total_firmas' => $total_firmas,
                'batch' => $batch,
                'modulo' => $i
            ]);
            // }
        }
    }

    public function controlFirmasMulti($batch)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT * FROM multipresentacion WHERE id_batch = :batch";
        $query_multi = $connection->prepare($sql);
        $query_multi->execute(['batch' => $batch]);
        $rows_multi = $query_multi->rowCount();

        for ($i = 5; $i < 9; $i++) {
            if ($i == 5) $rows_multi == 0 ? $total_firmas = 6 : $total_firmas = ($rows_multi * 4) + 2;
            if ($i == 6) $rows_multi == 0 ? $total_firmas = 7 : $total_firmas = ($rows_multi * 5) + 2;
            if ($i == 7) $rows_multi == 0 ? $total_firmas = 1 : $total_firmas = $rows_multi;
            if ($i == 8) $rows_multi == 0 ? $total_firmas = 2 : $total_firmas = 2;

            $sql = "UPDATE batch_control_firmas SET total_firmas = :total_firmas WHERE batch = :batch AND modulo = :modulo";
            $query = $connection->prepare($sql);
            $query->execute(['total_firmas' => $total_firmas, 'batch' => $batch, 'modulo' => $i]);
        }
    }
}
