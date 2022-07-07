<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class EquipmentsDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllEquipments()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM equipos");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $equipments = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Equipos Obtenidos", array('equipos' => $equipments));
        return $equipments;
    }

    public function findEquipmentsByType()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT DISTINCT tipo FROM equipos");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $equipments = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Tipos Obtenidos", array('tipo' => $equipments));
        return $equipments;
    }

    public function saveEquipments($dataEquipments)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO equipos (descripcion, tipo) VALUES (:equipo, :tipo)");
        $stmt->execute(['equipo' => strtolower($dataEquipments['equipo']), 'tipo' => strtolower($dataEquipments['tipo'])]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateEquipments($dataEquipments)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE equipos SET descripcion = :equipo, tipo = :tipo WHERE id = :id");
        $stmt->execute(['id' => $dataEquipments['id'], 'equipo' => ($dataEquipments['equipo']), 'tipo' => strtolower($dataEquipments['tipo'])]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteEquipments($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM equipos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}