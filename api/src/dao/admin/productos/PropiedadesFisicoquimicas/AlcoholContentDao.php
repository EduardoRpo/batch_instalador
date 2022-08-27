<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class AlcoholContentDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllAlcoholContent()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT id, CONCAT(limite_inferior, ' - ' ,limite_superior) AS nombre FROM grado_alcohol");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $alcoholContent = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("alcoholContentes Obtenidos", array('alcoholContentes' => $alcoholContent));
        return $alcoholContent;
    }

    public function savealcoholContent($dataAlcoholContent)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO grado_alcohol (limite_inferior, limite_superior) VALUES(:Vmin, :Vmax)");
        $stmt->execute(['Vmin' => $dataAlcoholContent['Vmin'], 'Vmax' => $dataAlcoholContent['Vmax']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updatealcoholContent($dataAlcoholContent)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE grado_alcohol SET limite_inferior = :Vmin , limite_superior = :Vmax WHERE id = :id");
        $stmt->execute(['Vmin' => $dataAlcoholContent['Vmin'], 'Vmax' => $dataAlcoholContent['Vmax'], 'id' => $dataAlcoholContent['id']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deletealcoholContent($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM grado_alcohol WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}