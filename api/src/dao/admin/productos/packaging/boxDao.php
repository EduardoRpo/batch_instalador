<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class boxDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllBox()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM empaque");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $box = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("empaques Obtenidos", array('empaque' => $box));
        return $box;
    }

    public function findBoxByRef($dataBox)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM empaque WHERE id = :ref");
        $stmt->execute(['ref' => $dataBox['ref']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $box = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("empaque Obtenido", array('empaque' => $box));
        return $box;
    }

    public function saveBox($dataBox)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO empaque (id,nombre) VALUES(:ref, :nombre)");
        $stmt->execute(['ref' => $dataBox['ref'], 'nombre' => $dataBox['nombre']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateBox($dataBox)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE empaque SET nombre = :nombre WHERE id = :ref");
        $stmt->execute(['ref' => $dataBox['ref'], 'nombre' => $dataBox['nombre']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteBox($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM empaque WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
