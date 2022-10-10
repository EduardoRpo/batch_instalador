<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class CapacidadEnvasadoDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findCapacidadEnvasado()
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM capacidad_envasado");
        $stmt->execute();

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $envasado = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $envasado;
    }

    public function updateCapacidadEnvasado($dataEnvasado)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("UPDATE capacidad_envasado SET turno_1 =:turno_1, turno_2 = :turno_1, turno_3 = :turno_3
                                      WHERE id_envasado = :id_envasado");
        $stmt->execute([
            'id_envasado' => $dataEnvasado['idEnvasado'],
            'turno_1' => $dataEnvasado['turno1'],
            'turno_2' => $dataEnvasado['turno2'],
            'turno_3' => $dataEnvasado['turno3']
        ]);
    }
}
