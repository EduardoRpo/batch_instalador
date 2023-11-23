<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use DateTime;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO;

class MuestrasDao
{

  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAllByIdBatch($id_batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM batch_muestras WHERE batch = :batch AND modulo = 5 ORDER BY `batch_muestras`.`referencia` DESC");
    $stmt->execute(['batch' => $id_batch]);

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $muestras = $stmt->fetchAll($connection::FETCH_ASSOC);
    return $muestras;
  }

  public function findByIdBatchAndModulo($dataBatch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM batch_muestras WHERE referencia = :referencia AND batch = :batch AND modulo = :modulo");
    $stmt->execute([
      'referencia' => $dataBatch['ref_multi'],
      'batch' => $dataBatch['idBatch'],
      'modulo' => $dataBatch['modulo']
    ]);

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $muestras = $stmt->fetchAll($connection::FETCH_ASSOC);
    return $muestras;
  }

  public function findAllAcondicionamientoByBatch($id_batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM batch_muestras_acondicionamiento WHERE batch = :batch ORDER BY `batch_muestras_acondicionamiento`.`referencia` DESC");
    $stmt->execute(['batch' => $id_batch]);

    $acondicionamiento = $stmt->fetchAll($connection::FETCH_ASSOC);
    return $acondicionamiento;
  }

  public function findAllAcondicionamientoByBatchAndModulo($dataBatch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM batch_muestras_acondicionamiento WHERE modulo = :modulo AND batch = :batch AND referencia = :ref_multi");
    $stmt->execute([
      'modulo' => $dataBatch['modulo'],
      'batch' => $dataBatch['idBatch'],
      'ref_multi' => $dataBatch['ref_multi']
    ]);

    $acondicionamiento = $stmt->fetchAll($connection::FETCH_ASSOC);
    return $acondicionamiento;
  }

  public function findPromedioByBatch($dataBatch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT AVG(muestra) as promedio FROM batch_muestras WHERE modulo = :modulo AND batch = :batch");
    $stmt->execute([
      'modulo' => $dataBatch['modulo'],
      'batch' => $dataBatch['idBatch']
    ]);

    $muestra = $stmt->fetch($connection::FETCH_ASSOC);
    return $muestra;
  }

  public function insertMuestrasByBatch($dataBatch, $muestras)
  {
    try {
      $connection = Connection::getInstance()->getConnection();

      $stmt = $connection->prepare("INSERT INTO batch_muestras (muestra, modulo, batch, referencia) VALUES (:muestras, :modulo, :batch, :referencia)");
      $stmt->execute([
        'muestras' => $muestras,
        'modulo' => $dataBatch['modulo'],
        'batch' => $dataBatch['idBatch'],
        'referencia' => $dataBatch['ref_multi']
      ]);
    } catch (\Exception $e) {
      $message = $e->getMessage();
      $error = array('info' => true, 'message' => $message);
      return $error;
    }
  }
}
