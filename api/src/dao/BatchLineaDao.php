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
    /* $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, batch.numero_lote, batch.estado 
                                  FROM batch WHERE batch.fecha_programacion 
                                  BETWEEN '2020-01-01' AND CURDATE() + INTERVAL 1 DAY 
                                  AND (batch.estado > 2 AND batch.estado < 4)
                                  AND ((SELECT cantidad_firmas FROM `batch_control_firmas` WHERE batch = batch.id_batch AND modulo = 2) < 4) 
                                  ORDER BY `batch`.`id_batch` ASC"); */

    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, batch.numero_lote, batch.estado, bcf.cantidad_firmas, bcf.modulo 
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
    /* $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, batch.numero_lote 
                                    FROM batch 
                                    WHERE (batch.estado > 3  AND batch.estado < 5)
                                    AND ((SELECT cantidad_firmas FROM `batch_control_firmas` WHERE batch = batch.id_batch AND modulo = 3) < 4)
                                    ORDER BY batch.id_batch DESC"); */
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, batch.numero_lote, batch.estado, bcf.cantidad_firmas, bcf.modulo 
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
    /* $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote  
                                  FROM batch INNER JOIN producto p ON p.referencia = batch.id_producto 
                                  WHERE (batch.estado > 4  AND batch.estado < 6) 
                                  AND ((SELECT cantidad_firmas FROM `batch_control_firmas` WHERE batch = batch.id_batch AND modulo = 4) < 2)
                                  ORDER BY batch.id_batch DESC"); */
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote, batch.estado, bcf.cantidad_firmas, bcf.modulo   
                                  FROM batch INNER JOIN producto p ON p.referencia = batch.id_producto
                                  INNER JOIN batch_control_firmas bcf ON bcf.batch = batch.id_batch  
                                  WHERE (batch.estado > 4) AND bcf.cantidad_firmas in (0, 1) AND bcf.modulo = 4
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
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, batch.numero_lote, batch.estado, batch.multi 
                                  FROM batch WHERE batch.estado >= 5.5 AND batch.id_batch 
                                  NOT IN (SELECT DISTINCT batch FROM `batch_desinfectante_seleccionado` bds 
                                  INNER JOIN batch_material_sobrante bms USING (batch) 
                                  WHERE bds.verifico > 0 AND bms.verifico > 0 AND bds.modulo = 5 AND bms.modulo = 5) 
                                  ORDER BY batch.id_batch DESC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $envasado = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Envasado Obtenidos", array('envasado' => $envasado));
    return $envasado;
  }

  public function findBatchAcondicionamiento()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote, batch.estado, batch.multi 
                                  FROM batch INNER JOIN producto p ON batch.id_producto = p.referencia 
                                  WHERE batch.estado >= 5.5 AND batch.id_batch 
                                  NOT IN (SELECT DISTINCT batch FROM `batch_desinfectante_seleccionado` bds INNER JOIN batch_material_sobrante bms USING (batch) 
                                  WHERE bds.verifico > 0 AND bms.verifico > 0 AND bds.modulo = 6 AND bms.modulo = 6) 
                                  ORDER BY batch.id_batch DESC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $acondicionamiento = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Acondicionamiento Obtenidos", array('acondicionamiento' => $acondicionamiento));
    return $acondicionamiento;
  }

  public function findBatchDespachos()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote, batch.multi 
                                  FROM batch INNER JOIN producto p ON batch.id_producto = p.referencia 
                                  WHERE batch.estado >= 5.5 AND batch.id_batch 
                                  NOT IN (SELECT batch FROM `batch_conciliacion_rendimiento` WHERE modulo = 7) 
                                  ORDER BY `batch`.`id_batch` ASC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $despachos = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Despachos Obtenidos", array('despachos' => $despachos));
    return $despachos;
  }

  public function findBatchMicrobiologia()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote 
                                  FROM batch INNER JOIN producto p ON batch.id_producto = p.referencia 
                                  WHERE batch.estado >= 5.5 AND batch.id_batch 
                                  NOT IN (SELECT batch FROM `batch_analisis_microbiologico` WHERE modulo = 8 AND verifico > 0) 
                                  ORDER BY `batch`.`id_batch` ASC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $microbiologia = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Microbiologia Obtenida", array('microbiologia' => $microbiologia));
    return $microbiologia;
  }

  public function findBatchFisicoquimica()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote 
                                  FROM batch INNER JOIN producto p ON batch.id_producto = p.referencia 
                                  WHERE batch.estado >= 5.5 AND batch.id_batch 
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
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.numero_orden, batch.id_producto as referencia, p.nombre_referencia, batch.numero_lote  
                                  FROM batch INNER JOIN producto p ON p.referencia = batch.id_producto 
                                  WHERE batch.estado >= 10 AND batch.id_batch NOT IN (SELECT batch FROM `batch_liberacion` WHERE dir_produccion > 0 AND dir_calidad > 0 and dir_tecnica > 0) ORDER BY `batch`.`id_batch` DESC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $liberacionlote = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Liberacion_lote Obtenidos", array('liberacionlote' => $liberacionlote));
    return $liberacionlote;
  }
}
