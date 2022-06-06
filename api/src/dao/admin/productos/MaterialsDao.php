<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MaterialsDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllMaterials($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $materials = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("materials Obtenidos", array('materials' => $materials));
        return $materials;
    }
    
    public function saveMaterials($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $materials = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("materials Obtenidos", array('materials' => $materials));
        return $materials;
    }
    
    public function updateMaterials($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $materials = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("materials Obtenidos", array('materials' => $materials));
        return $materials;
    }
    
    public function deleteMaterials($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $materials = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("materials Obtenidos", array('materials' => $materials));
        return $materials;
    }
}
