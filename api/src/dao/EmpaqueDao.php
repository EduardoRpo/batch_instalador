<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO;

class EmpaqueDao
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
    $stmt = $connection->prepare("SELECT * 
                                  FROM /* batch_ */equipos beq 
                                  /* INNER JOIN equipos ON equipos.id = beq.equipo */");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $equipos = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Equipos Obtenidos", array('equipos' => $equipos));
    return $equipos;
  }

  public function findByModule($module)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT beq.id, equipos.tipo, equipos.descripcion 
                                  FROM batch_equipos beq 
                                  INNER JOIN equipos ON equipos.id = beq.equipo
                                  WHERE modulo = :modulo");
    $stmt->bindValue(':modulo', $module, PDO::PARAM_INT);
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $equipos = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Equipos Obtenidos", array('equipos' => $equipos));
    return $equipos;
  }

  public function findByBatch($batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT *
                                  FROM batch_equipos beq 
                                  INNER JOIN equipos ON equipos.id = beq.equipo
                                  WHERE batch = :batch");
    $stmt->bindValue(':batch', $batch, PDO::PARAM_INT);
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $equipos = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Equipos Obtenidos", array('equipos' => $equipos));
    return $equipos;
  }

}
