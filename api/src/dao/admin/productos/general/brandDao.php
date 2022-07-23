<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class brandDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllBrand()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM marca");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $brand = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("marcas Obtenidas", array('marcas' => $brand));
        return $brand;
    }

    public function saveBrand($databrand)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO marca (nombre) VALUES(:nombre)");
        $stmt->execute(['nombre' => strtoupper($databrand['nombre'])]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateBrand($databrand)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE marca SET nombre = :nombre WHERE id = :id");
        $stmt->execute(['nombre' => strtoupper($databrand['nombre']), 'id' => $databrand['id']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteBrand($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM marca WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}