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
        $result = 'false';
        $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $batch]);
        $data = $query->fetchAll($connection::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($data); $i++) {
            if ($data[$i]['modulo'] == 2 && $data[$i]['cantidad_firmas'] == $data[$i]['total_firmas']) {
                if ($data[$i + 1]['modulo'] == 3 && $data[$i + 1]['cantidad_firmas'] == $data[$i + 1]['total_firmas']) {
                    /* actualizar estado si todos las firmas esten completas */
                    return 'true';
                } else
                    return 'false';
            }
        }
        return $result;
    }

    public function findControlFirmasByModule($batch, $module)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT IF(cantidad_firmas=total_firmas, 'Yes', 'No') AS result 
                FROM batch_control_firmas 
                WHERE batch = :batch AND modulo = :modulo;";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['batch' => $batch, 'modulo' => $module]);
        $this->logger->info(__FUNCTION__, array('stmt' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $resp = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("Respuesta Obtenida", array('Respuesta' => $resp));
        return $resp;
    }
}
