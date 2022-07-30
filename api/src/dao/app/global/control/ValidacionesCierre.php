<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ValidacionesCierreDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findControlFirmas($batch, $modulo)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $batch]);
        $data = $query->fetchAll($connection::FETCH_ASSOC);

        if ($modulo == 4) {
            $modulo1 = 2;
            $modulo2 = 3;
        }

        for ($i = 0; $i < sizeof($data); $i++) {
            if ($data[$i]['modulo'] == $modulo1 && $data[$i]['cantidad_firmas'] == $data[$i]['total_firmas']) {
                if ($data[$i + 1]['modulo'] == $modulo2 && $data[$i + 1]['cantidad_firmas'] == $data[$i + 1]['total_firmas']) {
                    /* actualizar estado si todos las firmas esten completas */
                    return true;
                } else
                    return false;
            } else
                return true;
        }
    }
}
