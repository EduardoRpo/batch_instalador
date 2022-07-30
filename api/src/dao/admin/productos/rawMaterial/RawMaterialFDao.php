<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class RawMaterialFDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllRawMaterialF()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM materia_prima_f");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $rawMaterialF = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Materia Prima Obtenidas", array('Materia Prima' => $rawMaterialF));
        return $rawMaterialF;
    }

    public function saveRawMaterialF($datarawMaterialF)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO materia_prima_f (referencia, nombre, alias) VALUES(:referencia, :materiaprima, :alias)");
        $stmt->execute(['referencia' => $datarawMaterialF['referencia'],'materiaprima' => $datarawMaterialF['materiaprima'], 'alias' =>$datarawMaterialF['alias']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateRawMaterialF($datarawMaterialF)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE materia_prima_f SET nombre = :materiaprima , alias = :alias WHERE referencia = :id");
        $stmt->execute(['materiaprima' => $datarawMaterialF['materiaprima'], 'id' => $datarawMaterialF['referencia'], 'alias' => $datarawMaterialF['alias']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteRawMaterialF($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM materia_prima_f WHERE referencia = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}