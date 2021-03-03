<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO;

class ControlProcesoDao
{


  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAll()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM batch_control_especificaciones");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $especificacionesProducto = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Equipos Obtenidos", array('especificaciones' => $especificacionesProducto));
    return $especificacionesProducto;
  }

  public function findByModuleBatch($batch, $modulo)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("
      SELECT * FROM batch_control_especificaciones WHERE batch = :batch AND modulo = :modulo");
    $stmt->bindValue(':batch', $batch, PDO::PARAM_INT);
    $stmt->bindValue(':modulo', $modulo, PDO::PARAM_INT);
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $especificacionesProducto = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Equipos Obtenidas", array('especificaciones' => $especificacionesProducto));
    return $especificacionesProducto;
  }

  public function findByBatch($batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("
      SELECT * FROM batch_control_especificaciones WHERE batch = :batch");
    $stmt->bindValue(':batch', $batch, PDO::PARAM_INT);
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $especificacionesProducto = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Especificaciones Obtenidas", array('especificaciones' => $especificacionesProducto));
    return $especificacionesProducto;
  }

}
