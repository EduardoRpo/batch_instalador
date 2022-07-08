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

    public function saveEquipments($dataMulti)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO equipos (descripcion, tipo) VALUES (:equipo, :tipo)");
        $stmt->execute(['equipo' => strtolower($dataMulti['equipo']), 'tipo' => strtolower($dataMulti['tipo'])]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    // public function updateEquipments($dataMulti)
    // {
    //     $connection = Connection::getInstance()->getConnection();
    //     $stmt = $connection->prepare("UPDATE equipos SET descripcion = :equipo, tipo = :tipo WHERE id = :id");
    //     $stmt->execute(['id' => $dataMulti['id'], 'equipo' => ($dataMulti['equipo']), 'tipo' => strtolower($dataMulti['tipo'])]);
    //     $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    // }

    public function deleteMulti($multi)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE producto SET multi = $row[0] WHERE referencia = :valor");
        $stmt->execute(['valor' => $multi]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}