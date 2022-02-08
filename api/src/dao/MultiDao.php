<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class MultiDao
 * @package BatchRecord\dao
 * @author Teenus <Teenus-SAS>
 */
class MultiDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findMultiByBatch($batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT m.id_batch, pc.nombre as presentacion_comercial, m.referencia 
                                  FROM multipresentacion m INNER JOIN producto p ON p.referencia = m.referencia 
                                  INNER JOIN presentacion_comercial pc ON pc.id = p.presentacion_comercial 
                                  WHERE m.id_batch = :batch");
    $stmt->execute(['batch' => $batch]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $rows = $stmt->rowCount();

    if ($rows == 0) {
      $stmt = $connection->prepare("SELECT b.id_batch, p.referencia, pc.nombre as presentacion_comercial
                                    FROM producto p
                                    INNER JOIN presentacion_comercial pc ON pc.id = p.presentacion_comercial 
                                    INNER JOIN batch b ON b.id_producto = p.referencia 
                                    WHERE b.id_batch = :batch");
      $stmt->execute(['batch' => $batch]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
    $this->logger->notice("filas Obtenidas", array('filas' => $rows));
    $multi = $stmt->fetchAll($connection::FETCH_ASSOC);
    return $multi;
  }
}
