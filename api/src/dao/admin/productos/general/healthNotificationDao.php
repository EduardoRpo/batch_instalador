<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class HealthNotificationDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllHealthNotifications()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM notificacion_sanitaria");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $healthNotifi = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Notificaciones Obtenidos", array('Notificaciones' => $healthNotifi));
        return $healthNotifi;
    }

    public function saveHealthNotifications($dataNotifi)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO notificacion_sanitaria (nombre , vencimiento) VALUES(:Nombre , :vencimiento)");
        $stmt->execute(['Nombre' => $dataNotifi['nombre'], 'vencimiento' => $dataNotifi['vencimiento']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateHealthNotifications($dataNotifi)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE notificacion_sanitaria SET nombre = :Nombre, vencimiento = :vencimiento WHERE id = :id");
        $stmt->execute(['id' => $dataNotifi['id'], 'nombre' => strtoupper($dataNotifi['Nombre']), 'vencimiento' => $dataNotifi['vencimiento']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteHealthNotifications($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM notificacion_sanitaria WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
