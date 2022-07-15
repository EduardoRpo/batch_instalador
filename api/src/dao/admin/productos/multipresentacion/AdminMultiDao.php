<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class AdminMultiDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllMulti()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT referencia, nombre_referencia, multi FROM producto WHERE multi>0 ORDER BY nombre_referencia ASC");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $multi = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Equipos Obtenidos", array('multi' => $multi));
        return $multi;
    }

    public function adminFindAllProducts()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT referencia, nombre_referencia FROM producto ORDER BY multi ASC");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $produc = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Equipos Obtenidos", array('producto' => $produc));
        return $produc;
    }

    public function findMultiByReference($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT referencia, nombre_referencia FROM producto WHERE multi = (SELECT multi FROM producto WHERE referencia = :referencia )");
        $stmt->execute(['referencia' => $referencia['referencia']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $multi = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Equipos Obtenidos", array('multi' => $multi));
        return $multi;
    }

    public function saveMulti($dataMulti, $nameGranel)
    {
        foreach($dataMulti as $multi){   
            $connection = Connection::getInstance()->getConnection();
            $stmt = $connection->prepare("UPDATE producto SET multi = :multi WHERE referencia = :id_multi");
            $stmt->execute(['multi'=>$nameGranel, 'id_multi'=>$multi]);
            $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        }
    }

    public function deleteMulti($valor)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE producto SET multi = 0 WHERE referencia = :valor");
        $stmt->execute(['valor' => $valor['valor']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}