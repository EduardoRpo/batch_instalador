<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class PositionDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllPosition()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM cargos");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $Position = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("tanques Obtenidos", array('tanques' => $Position));
        return $Position;
    }

    public function savePosition($dataPosition)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO cargos (cargo) VALUES(:cargo)");
        $stmt->execute(['cargo' => $dataPosition['cargo']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updatePosition($dataPosition)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE cargos SET cargo = :cargo WHERE id = :id");
        $stmt->execute(['cargo' => $dataPosition['cargo'], 'id' => $dataPosition['id']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deletePosition($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM cargos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}