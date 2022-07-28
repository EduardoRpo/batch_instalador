<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class PhDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllPh()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT id, CONCAT(limite_inferior, ' - ' ,limite_superior) AS nombre FROM ph");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $ph = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("ph Obtenidos", array('ph' => $ph));
        return $ph;
    }

    public function savePh($dataPh)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO ph (limite_inferior, limite_superior) VALUES(:Vmin, :Vmax)");
        $stmt->execute(['Vmin' => $dataPh['Vmin'], 'Vmax' => $dataPh['Vmax']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updatePh($dataPh)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE ph SET limite_inferior = :Vmin , limite_superior = :Vmax WHERE id = :id");
        $stmt->execute(['Vmin' => $dataPh['Vmin'], 'Vmax' => $dataPh['Vmax'], 'id' => $dataPh['id']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deletePh($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM ph WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}