<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class EquipmentsAppDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findEquipmentsByBatchandModule($batch, $module)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT equipos.id, equipos.descripcion 
                                      FROM equipos 
                                      INNER JOIN batch_equipos ON batch_equipos.equipo = equipos.id
                                      WHERE batch_equipos.batch = :batch AND modulo = :modulo");
        $stmt->execute(['batch' => $batch, 'modulo' => $module]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $equipments = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Equipos Obtenidos", array('equipos' => $equipments));
        return $equipments;
    }
}
