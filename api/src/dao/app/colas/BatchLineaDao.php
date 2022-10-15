<?php


namespace BatchRecord\Dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * Class BatchLineaDao
 * @package BatchRecord\Dao
 * @author Teenus <Teenus-SAS>
 */

class BatchLineaDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findBatchPesajes()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, batch.numero_lote, batch.estado, bcf.cantidad_firmas, bcf.modulo, bcf.total_firmas 
                                  FROM batch INNER JOIN batch_control_firmas bcf ON bcf.batch = batch.id_batch 
                                  WHERE batch.fecha_programacion BETWEEN '2020-01-01' AND CURDATE() + INTERVAL 1 DAY 
                                  AND (batch.estado > 2) AND bcf.cantidad_firmas in (0,1,2,3) AND bcf.modulo = 2 
                                  ORDER BY `batch`.`id_batch` DESC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $pesajes = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Pesajes Obtenidos", array('pesajes' => $pesajes));

    return $pesajes;
  }

  public function findBatchPrepacion()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, batch.numero_lote, batch.estado, bcf.cantidad_firmas, bcf.modulo, bcf.total_firmas 
                                    FROM batch 
                                    INNER JOIN batch_control_firmas bcf ON bcf.batch = batch.id_batch 
                                    WHERE (batch.estado > 3) AND bcf.cantidad_firmas in (0,1,2,3) AND bcf.modulo = 3
                                    ORDER BY batch.id_batch DESC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $preparacion = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Preparacion Obtenidos", array('preparacion' => $preparacion));
    return $preparacion;
  }

  public function findBatchAprobacion()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote, batch.estado, bcf.cantidad_firmas, bcf.modulo, bcf.total_firmas   
                                  FROM batch INNER JOIN producto p ON p.referencia = batch.id_producto
                                  INNER JOIN batch_control_firmas bcf ON bcf.batch = batch.id_batch  
                                  WHERE (batch.estado >= 3.5) AND bcf.cantidad_firmas in (0, 1) AND bcf.modulo = 4
                                  ORDER BY batch.id_batch DESC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $aprobacion = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Aprobacion Obtenidos", array('aprobacion' => $aprobacion));
    return $aprobacion;
  }

  public function findBatchEnvasado()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, date_add(batch.fecha_programacion, interval 3 day) AS fecha_programacion, batch.numero_orden, batch.numero_orden, p.referencia, p.nombre_referencia, batch.numero_lote, batch.estado, batch.multi, bcf.cantidad_firmas, bcf.total_firmas, batch.programacion_envasado 
                                  FROM batch 
                                    INNER JOIN producto p ON p.referencia = batch.id_producto 
                                    INNER JOIN batch_control_firmas bcf ON batch.id_batch = bcf.batch 
                                  WHERE batch.estado > 5 AND batch.id_batch AND bcf.modulo = 5 
                                    AND batch.id_batch NOT IN(SELECT batch FROM `batch_control_firmas` WHERE modulo = 5 AND cantidad_firmas = total_firmas) 
                                    AND batch.programacion_envasado < DATE_ADD(NOW(), INTERVAL 1 DAY) ORDER BY `batch`.`fecha_programacion` DESC;");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $envasado = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Envasado Obtenidos", array('envasado' => $envasado));
    return $envasado;
  }

  public function findBatchProgramacionEnvasado()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT DISTINCT batch.id_batch, date_add(batch.fecha_programacion, interval 3 day) AS fecha_programacion, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, 
                                      batch.numero_lote, batch.unidad_lote, batch.tamano_lote, batch.estado, batch.multi, bcf.cantidad_firmas, bcf.total_firmas, batch.programacion_envasado, 
                                      (SELECT COUNT(*) FROM observaciones WHERE id_batch = batch.id_batch) AS cant_observations, bcf.modulo
                                  FROM batch
                                  INNER JOIN producto p ON p.referencia = batch.id_producto
                                  INNER JOIN batch_control_firmas bcf ON batch.id_batch = bcf.batch
                                  LEFT JOIN observaciones o ON o.id_batch = batch.id_batch 
                                  WHERE batch.estado > 5.5 AND batch.estado < 7 AND batch.id_batch AND bcf.modulo = 5 
                                  AND batch.id_batch NOT IN(SELECT batch FROM `batch_control_firmas` WHERE modulo = 5 AND cantidad_firmas = total_firmas) 
                                  ORDER BY id_batch DESC;");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $envasado = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Envasado Obtenidos", array('envasado' => $envasado));
    return $envasado;
  }

  public function findBatchAcondicionamiento()
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT batch.id_batch, batch.programacion_envasado, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, producto.nombre_referencia, batch.numero_lote, batch.estado, batch.multi, bcf.cantidad_firmas, bcf.total_firmas 
                                  FROM batch 
                                  INNER JOIN producto ON producto.referencia = batch.id_producto 
                                  INNER JOIN batch_control_firmas bcf ON batch.id_batch = bcf.batch 
                                  WHERE bcf.modulo = 6 AND batch.id_batch NOT IN(SELECT batch FROM `batch_control_firmas` WHERE modulo = 6 AND cantidad_firmas = total_firmas) 
                                  AND batch.estado > 5.5 AND batch.estado < 7 AND batch.id_batch AND batch.programacion_envasado < DATE_ADD(NOW(), INTERVAL 1 DAY) 
                                  ORDER BY `batch`.`fecha_programacion` DESC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $acondicionamiento = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Acondicionamiento Obtenidos", array('acondicionamiento' => $acondicionamiento));
    return $acondicionamiento;
  }

  public function findBatchDespachos()
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT batch.id_batch, date_add(batch.fecha_programacion, interval 3 day) AS fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote, batch.multi, bcf.cantidad_firmas, bcf.total_firmas 
                                  FROM batch 
                                  INNER JOIN producto p ON batch.id_producto = p.referencia 
                                  INNER JOIN batch_control_firmas bcf ON batch.id_batch = bcf.batch WHERE batch.estado > 6 AND bcf.modulo = 7 
                                  AND batch.id_batch NOT IN (SELECT batch FROM `batch_control_firmas` 
                                  WHERE modulo = 7 AND cantidad_firmas = total_firmas) ORDER BY `batch`.`id_batch` ASC;");

    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $despachos = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Despachos Obtenidos", array('despachos' => $despachos));
    return $despachos;
  }

  public function findBatchMicrobiologia()
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT batch.id_batch, date_add(batch.fecha_programacion, interval 3 day) AS fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote, bcf.cantidad_firmas, bcf.total_firmas 
                                  FROM batch 
                                  INNER JOIN producto p ON batch.id_producto = p.referencia 
                                  INNER JOIN batch_control_firmas bcf ON batch.id_batch = bcf.batch
                                  WHERE batch.estado >= 6.5 AND bcf.modulo = 8 AND batch.id_batch 
                                  NOT IN (SELECT batch FROM `batch_analisis_microbiologico` WHERE modulo = 8 AND verifico > 0) 
                                  ORDER BY `batch`.`id_batch` ASC;");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $microbiologia = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Microbiologia Obtenida", array('microbiologia' => $microbiologia));
    return $microbiologia;
  }

  public function findBatchFisicoquimica()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, date_add(batch.fecha_programacion, interval 3 day) AS fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote, bcf.cantidad_firmas, bcf.total_firmas  
                                  FROM batch 
                                  INNER JOIN producto p ON batch.id_producto = p.referencia 
                                  INNER JOIN batch_control_firmas bcf ON batch.id_batch = bcf.batch
                                  WHERE batch.estado >= 6.5 AND bcf.modulo = 9 AND batch.id_batch 
                                  NOT IN (SELECT batch FROM `batch_firmas2seccion` WHERE modulo = 9 AND verifico > 0) 
                                  ORDER BY `batch`.`id_batch` ASC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $fisicoquimica = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Despachos Obtenidos", array('fisicoquimica' => $fisicoquimica));
    return $fisicoquimica;
  }

  public function findBatchLiberacionlote()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, date_add(batch.fecha_programacion, interval 3 day) AS fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote, bcf.cantidad_firmas, bcf.total_firmas    
                                  FROM batch 
                                  INNER JOIN producto p ON p.referencia = batch.id_producto 
                                  INNER JOIN batch_control_firmas bcf ON batch.id_batch = bcf.batch
                                  WHERE batch.estado >= 10 AND bcf.modulo = 10
                                  AND batch.id_batch NOT IN (SELECT batch FROM `batch_liberacion` WHERE dir_produccion > 0 AND dir_calidad > 0 and dir_tecnica > 0) 
                                  ORDER BY `batch`.`id_batch` DESC");

    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $liberacionlote = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Liberacion_lote Obtenidos", array('liberacionlote' => $liberacionlote));
    return $liberacionlote;
  }
}
