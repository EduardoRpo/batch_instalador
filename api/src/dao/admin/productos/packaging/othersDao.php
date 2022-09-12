<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class othersDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllOthers()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM otros");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $others = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("otros Obtenidos", array('otros' => $others));
        return $others;
    }

    public function findOthersByRef($dataOthers)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM otros WHERE id = :ref");
        $stmt->execute(['ref' => $dataOthers['ref']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $others = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("otro Obtenido", array('otros' => $others));
        return $others;
    }

    public function saveOthers($dataOthers)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO otros (nombre , id) VALUES(:ref, :nombre)");
        $stmt->execute(['ref' => $dataOthers['ref'], 'nombre' => $dataOthers['nombre']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateOthers($dataOthers)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE otros SET nombre = :nombre WHERE id = :ref");
        $stmt->execute(['ref' => $dataOthers['ref'], 'nombre' => $dataOthers['nombre']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteOthers($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM otros WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
