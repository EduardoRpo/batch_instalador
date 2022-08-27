<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class BaseDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllProductsInstructive()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM nombre_producto");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $base = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("marcas Obtenidas", array('marcas' => $base));
        return $base;
    }

    public function nombreProductBase($referencia){
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM instructivos_base WHERE producto = :producto");
        $stmt->execute(['producto' => $referencia]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $base = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("base Obtenida", array('base' => $base));
        return $base;
    }

    public function FindBaseByreference($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("");
        $stmt->execute(['producto' => $referencia]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $base = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("base Obtenida", array('base' => $base));
        return $base;
    }
    
    public function saveBase($dataBase)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO instructivos_base (pasos, tiempo, producto) VALUES (:pasos, :tiempo, :referencia )");
        $stmt->execute(['pasos'=> $dataBase['actividad'] , 'tiempo' => $dataBase['tiempo'], 'referencia'=> $dataBase['referencia']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateBase($dataBase)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE instructivos_base SET pasos=:pasos, tiempo=:tiempo WHERE pasos = :id AND producto = :referencia");
        $stmt->execute(['pasos'=> $dataBase['actividad'] , 'tiempo' => $dataBase['tiempo'], 'referencia'=> $dataBase['referencia'],'id'=>$dataBase['id']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteBase($dataBase)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM instructivos_base WHERE pasos = :id AND producto = :referencia");
        $stmt->execute(['id' => $dataBase['id'], 'referencia' => $dataBase['referencia']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
    
}