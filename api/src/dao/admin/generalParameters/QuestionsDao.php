<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class QuestionsDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllQuestions()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM preguntas");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $Questions = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Preguntas Obtenidos", array('Preguntas' => $Questions));
        return $Questions;
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
        $stmt->execute(['modulo' => strtoupper($dataModules['module'])]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateModules($dataModules)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE modulo SET modulo = :module WHERE id = :id_module");
        $stmt->execute(['id_module' => $dataModules['id'], 'module' => strtoupper($dataModules['module'])]);
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
