<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ModulesDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllModules()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM modulo");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $modules = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("modules Obtenidos", array('modules' => $modules));
        return $modules;
    }

    public function findModule($dataModule)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT id FROM modulo WHERE modulo = :module");
        $stmt->execute(['module' => $dataModule['module']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $module = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("module Obtenidos", array('module' => $module));
        return $module;
    }

    public function saveModules($dataModules)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO modulo (modulo) VALUES(:modulo)");
        $stmt->execute(['modulo' => $dataModules['module']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateModules($id_module, $dataModules)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE modulo SET modulo = :module WHERE id = :id_module");
        $stmt->execute(['id_module' => $id_module, 'module' => $dataModules['module']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteModules($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM modulo WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
