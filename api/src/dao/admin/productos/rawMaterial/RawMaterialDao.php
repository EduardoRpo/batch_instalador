<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class RawMaterialDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllRawMaterial()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM materia_prima");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $rawMaterial = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Materia Prima Obtenidas", array('Materia Prima' => $rawMaterial));
        return $rawMaterial;
    }

    public function findRawMaterial($dataSearchRaw)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM materia_prima WHERE referencia = :referencia");
        $stmt->execute(['referencia' => $dataSearchRaw['referencia']]);
        $this->logger->info(__FUNCTION__, array('query'=> $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $rawMaterialSearch = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("Materia prima obtenida", array('Materia prima' => $rawMaterialSearch));
        return $rawMaterialSearch;
    }

    public function saveRawMaterial($datarawMaterial)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO materia_prima (referencia, nombre, alias) VALUES(:referencia, :materiaprima, :alias)");
        $stmt->execute(['referencia' => $datarawMaterial['referencia'],'materiaprima' => $datarawMaterial['materiaprima'], 'alias' =>$datarawMaterial['alias']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateRawMaterial($datarawMaterial)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE materia_prima SET nombre = :materiaprima , alias = :alias WHERE referencia = :id");
        $stmt->execute(['materiaprima' => $datarawMaterial['materiaprima'], 'id' => $datarawMaterial['referencia'], 'alias' => $datarawMaterial['alias']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteRawMaterial($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM materia_prima WHERE referencia = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}