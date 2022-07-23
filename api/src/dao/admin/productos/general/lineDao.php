<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class lineDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAlllines()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM linea");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $line = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("lineas Obtenidas", array('lineas' => $line));
        return $line;
    }

    public function savelines($datalines)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO linea (nombre , densidad, ajuste) VALUES(:Nombre , :densidad , :ajuste)");
        $stmt->execute(['Nombre' => strtoupper($datalines['nombre']), 'densidad' => $datalines['densidad'], 'ajuste' => $datalines['ajuste']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updatelines($datalines)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE linea SET nombre = :nombre, densidad = :densidad, ajuste = :ajuste WHERE id = :id");
        $stmt->execute(['id' => $datalines['id'], 'nombre' => strtoupper($datalines['nombre']), 'densidad' => $datalines['densidad'] , 'ajuste' => $datalines['ajuste'] ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteLines($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM linea WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}