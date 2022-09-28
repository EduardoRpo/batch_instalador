<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class MuestrasDespachosDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findMuestrasDespachos($ref)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT p.id_propietario, pp.nombre, pp.facturar 
                FROM producto p INNER JOIN propietario pp ON pp.id = p.id_propietario 
                WHERE referencia = :referencia";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['referencia' => $ref]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $muestrasDespachos = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("muestras Despachos Obtenidos", array('muestras Despachos' => $muestrasDespachos));
        return $muestrasDespachos;
    }
}
