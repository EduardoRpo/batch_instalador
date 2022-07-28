<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class DensityDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllDensity()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT id, CONCAT(limite_inferior, ' - ' ,limite_superior) AS nombre FROM densidad_gravedad");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $density = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("densityes Obtenidos", array('densityes' => $density));
        return $density;
    }

    public function saveDensity($dataDensity)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO densidad_gravedad (limite_inferior, limite_superior) VALUES(:Vmin, :Vmax)");
        $stmt->execute(['Vmin' => $dataDensity['Vmin'], 'Vmax' => $dataDensity['Vmax']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateDensity($dataDensity)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE densidad_gravedad SET limite_inferior = :Vmin , limite_superior = :Vmax WHERE id = :id");
        $stmt->execute(['Vmin' => $dataDensity['Vmin'], 'Vmax' => $dataDensity['Vmax'], 'id' => $dataDensity['id']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteDensity($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM densidad_gravedad WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}