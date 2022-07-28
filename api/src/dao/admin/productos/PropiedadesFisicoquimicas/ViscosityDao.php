<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ViscosityDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllViscosity()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT id, CONCAT(limite_inferior, ' - ' ,limite_superior) AS nombre FROM viscosidad");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $viscosity = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("viscosityes Obtenidos", array('viscosityes' => $viscosity));
        return $viscosity;
    }

    public function saveViscosity($dataViscosity)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO viscosidad (limite_inferior, limite_superior) VALUES(:Vmin, :Vmax)");
        $stmt->execute(['Vmin' => $dataViscosity['Vmin'], 'Vmax' => $dataViscosity['Vmax']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateViscosity($dataViscosity)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE viscosidad SET limite_inferior = :Vmin , limite_superior = :Vmax WHERE id = :id");
        $stmt->execute(['Vmin' => $dataViscosity['Vmin'], 'Vmax' => $dataViscosity['Vmax'], 'id' => $dataViscosity['id']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteViscosity($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM viscosidad WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}