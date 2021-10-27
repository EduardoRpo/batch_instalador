<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ExplosionMaterialesDao
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
    $stmt = $connection->prepare("SELECT e.id_materiaprima, m.nombre, SUM(e.cantidad) AS cantidad, SUM(e.uso) AS uso 
                                    FROM explosion_materiales_batch e 
                                    INNER JOIN materia_prima m ON e.id_materiaprima = m.referencia 
                                    GROUP BY id_materiaprima;");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $batchExplosionMateriales = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("batch_explosion_materiales Obtenidos", array('batch_explosion_materiales' => $batchExplosionMateriales));
    return $batchExplosionMateriales;
  }

  public function findAllPedidos()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT ep.id_materiaprima, m.nombre, COALESCE(SUM(eb.cantidad),0) AS cantidad_batch, COALESCE(SUM(ep.cantidad),0) AS cantidad_pedidos, COALESCE(SUM(eb.uso),0) AS cantidad_batch_uso, 
                                  COALESCE(SUM(eb.uso),0) - COALESCE(SUM(eb.cantidad),0) AS gap_batch, 
                                  COALESCE(SUM(eb.uso),0) - COALESCE(SUM(ep.cantidad),0) AS gap_pedidos 
                                  FROM explosion_materiales_pedidos ep 
                                  INNER JOIN materia_prima m ON ep.id_materiaprima = m.referencia 
                                  LEFT JOIN explosion_materiales_batch eb ON eb.id_materiaprima = m.referencia 
                                  GROUP BY id_materiaprima  
                                  ORDER BY `ep`.`id_materiaprima`  ASC;");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $batchExplosionMateriales = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("batch_explosion_materiales Obtenidos", array('batch_explosion_materiales' => $batchExplosionMateriales));
    return $batchExplosionMateriales;
  }

  public function findReferenciasSinFormula()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM explosion_materiales_referencias");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $referencias = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("referencias Obtenidos", array('referecnias' => $referencias));
    return $referencias;
  }
}
