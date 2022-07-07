<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class disinfectantDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllDisinfectant()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM desinfectante");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $disinfectans = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("desinfectantes Obtenidos", array('desinfectante' => $disinfectans));
        return $disinfectans;
    }

    public function fineDisinfectant($dataDisinfect)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT id FROM desinfectante WHERE id = :id");
        $stmt->execute(['id' => $dataDisinfect['id']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $disinfectans = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("desinfectante Obtenidos", array('id' => $disinfectans));
        return $disinfectans;
    }

    public function saveDisinfectant($dataDisinfect)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO desinfectante (nombre, concentracion) VALUES(:desinfectante, :concentracion)");
        $stmt->execute(['desinfectante' => strtoupper($dataDisinfect['desinfectante']), 'concentracion' => $dataDisinfect['concentracion']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateDisinfect($dataDisinfect)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE desinfectante SET concentracion=:concentracion WHERE id = :id");
        $stmt->execute(['id' => $dataDisinfect['id'], 'concentracion' => $dataDisinfect['concentracion'], 'concentracion' => $dataDisinfect['concentracion'] ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteDisinfectant($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM desinfectante WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}