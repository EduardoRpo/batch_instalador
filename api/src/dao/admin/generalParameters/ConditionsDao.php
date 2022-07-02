<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ConditionsDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllConditions()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT cm.id, m.modulo, cm.t_min, cm.t_max 
                                      FROM condicionesmedio_tiempo cm 
                                      INNER JOIN modulo m ON cm.id_modulo = m.id");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $conditions = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("get conditions", array('conditions' => $conditions));
        return $conditions;
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

    public function saveConditions($dataConditions)
    {
        $connection = Connection::getInstance()->getConnection();
        try {
            $stmt = $connection->prepare("INSERT INTO condicionesmedio_tiempo (id_modulo, t_min, t_max) VALUES(:id_modulo, :t_min, :t_max)");
            $stmt->execute(['id_modulo' => $dataConditions['modulo'], 't_min' => $dataConditions['t_min'], 't_max' => $dataConditions['t_max']]);
            $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        } catch (\Exception $e) {

            if ($e->getCode() == 23000)
                $message = 'Módulo duplicado. Ingrese una nueva módulo';

            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }

    public function updateConditions($dataConditions)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE condicionesmedio_tiempo SET t_min =:t_min, t_max=:t_max WHERE id_modulo = :id");
        $stmt->execute(['id_modulo' => $dataConditions['id'], 't_min' => $dataConditions['t_min'], 't_max' => $dataConditions['t_max']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteConditions($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM condicionesmedio_tiempo WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
