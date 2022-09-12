<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class containersDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findContainersByRef($ref)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM envase WHERE id = :ref");
        $stmt->execute(['ref' => $ref]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $containers = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("envases Obtenidos", array('envases' => $containers));
        return $containers;
    }
    public function findAllContainers()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM envase");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $containers = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("envases Obtenidos", array('envases' => $containers));
        return $containers;
    }

    public function saveContainers($dataContainer)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO envase (id, nombre) VALUES(:ref, :nombre)");
        $stmt->execute(['ref' => $dataContainer['ref'], 'nombre' => $dataContainer['nombre']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateContainers($dataContainer)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE envase SET nombre = :nombre WHERE id = :id");
        $stmt->execute(['nombre' => $dataContainer['nombre'], 'id' => $dataContainer['id']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteContainers($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM envase WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
