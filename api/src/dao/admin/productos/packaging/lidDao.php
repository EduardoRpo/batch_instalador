<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class lidDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllLid()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM tapa");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $lid = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("tapas Obtenidos", array('tapa' => $lid));
        return $lid;
    }

    public function findLidByRef($ref)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM tapa WHERE id = :ref");
        $stmt->execute(['ref' => $ref]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $lid = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("tapa Obtenida", array('tapa' => $lid));
        return $lid;
    }

    public function saveLid($datalid)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO tapa (id, nombre) VALUES(:ref, :nombre)");
        $stmt->execute(['ref' => $datalid['ref'], 'nombre' => $datalid['nombre']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateLid($datalid)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE tapa SET nombre = :nombre WHERE id = :ref");
        $stmt->execute(['ref' => $datalid['ref'], 'nombre' => $datalid['nombre']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteLid($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM tapa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
