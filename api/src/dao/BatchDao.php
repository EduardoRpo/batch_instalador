<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 *
 * Class BatchDao
 * @package BatchRecord\dao
 * @author Teenus <Teenus-SAS>
 */
class BatchDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  /**
   * @return array
   */
  public function findAll()
  {
    $connection = Connection::getInstance()->getConnection();
    //$stmt = $connection->prepare("SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia INNER JOIN linea ON producto.id_linea = linea.id INNER JOIN propietario ON producto.id_propietario = propietario.id WHERE batch.estado = 1 OR batch.estado = 2 AND batch.fecha_programacion = CURRENT_DATE()");
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.numero_orden, producto.referencia, producto.nombre_referencia, pc.nombre  as presentacion_comercial, batch.numero_lote, batch.tamano_lote, propietario.nombre,batch.fecha_creacion, batch.fecha_programacion, batch.estado, batch.multi
                                  FROM batch INNER JOIN producto INNER JOIN propietario INNER JOIN presentacion_comercial pc
                                  ON batch.id_producto = producto.referencia AND producto.id_propietario = propietario.id AND producto.presentacion_comercial = pc.id
                                  WHERE batch.id_batch NOT IN (SELECT batch FROM `batch_liberacion` WHERE dir_produccion > 0 AND dir_calidad > 0 and dir_tecnica > 0) ORDER BY `batch`.`id_batch` ASC");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $batch = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Batch Obtenidos", array('batch' => $batch));
    return $batch;
  }

  /**
   * @return array
   */

  public function findAllClosed()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT batch.id_batch, batch.numero_orden, producto.referencia, producto.nombre_referencia, pc.nombre as presentacion_comercial, batch.numero_lote, batch.tamano_lote, propietario.nombre,batch.fecha_creacion, batch.fecha_programacion, batch.estado, batch.multi 
                                  FROM batch INNER JOIN producto INNER JOIN propietario INNER JOIN presentacion_comercial pc 
                                  ON batch.id_producto = producto.referencia AND producto.id_propietario = propietario.id AND producto.presentacion_comercial = pc.id 
                                  WHERE batch.estado = 10");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $batch = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Batch Obtenidos", array('batch' => $batch));
    return $batch;
  }

  /**
   * Encuentra un batch por id
   * @param $id integer id a buscar
   * @return mixed
   */

  public function findById($id)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT p.referencia, p.nombre_referencia, pc.nombre as presentacion, p.unidad_empaque, pp.nombre as propietario, batch.numero_orden, batch.tamano_lote, batch.numero_lote, batch.unidad_lote, linea.nombre as linea, linea.densidad, batch.fecha_programacion, p.img 
                                  FROM producto p 
                                  INNER JOIN batch ON batch.id_producto = p.referencia 
                                  INNER JOIN presentacion_comercial pc ON pc.id = p.presentacion_comercial 
                                  INNER JOIN linea ON linea.id = p.id_linea 
                                  INNER JOIN propietario pp ON pp.id = p.id_propietario WHERE id_batch = :idBatch");

    $stmt->execute(array('idBatch' => $id));
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $batch = $stmt->fetch($connection::FETCH_ASSOC);
    $this->logger->notice("batch consultado", array('batch' => $batch));

    return $batch;
  }

  public function saveBatch($batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "INSERT INTO batch (fecha_creacion, fecha_programacion, fecha_actual, numero_orden, numero_lote, 
                            tamano_lote, lote_presentacion, unidad_lote, estado, id_producto ) 
              VALUES(:fecha_creacion, :fecha_programacion, :fecha_actual,:numero_orden,:numero_lote,:tamano_lote,
                    :lote_presentacion,:unidad_lote,:estado,:id_producto)";
    $stmt = $connection->prepare($query);
    $rows = $stmt->execute(
      array(
        'fecha_creacion' => date('Y-m-d'),
        'fecha_programacion' => $batch["fecha_programacion"],
        'fecha_actual' => date('Y-m-d'),
        'numero_orden' => $batch["numero_orden"],
        'numero_lote' => $batch["numero_lote"],
        'tamano_lote' => $batch["tamano_lote"],
        'lote_presentacion' => $batch["lote_presentacion"],
        'unidad_lote' => $batch["unidad_lote"],
        'estado' => $batch["estado"],
        'id_producto' => $batch["id_producto"]
      )
    );
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    return $rows;
  }

  public function updateBatch($batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "INSERT INTO batch (fecha_creacion, fecha_programacion, fecha_actual, numero_orden, numero_lote, 
                            tamano_lote, lote_presentacion, unidad_lote, estado, id_producto ) VALUES(
                            :fecha_creacion, :fecha_programacion, :fecha_actual,:numero_orden,:numero_lote,:tamano_lote,
                            :lote_presentacion,:unidad_lote,:estado,:id_producto)";
    $stmt = $connection->prepare($query);
    $rows = $stmt->execute(
      array(
        'fecha_creacion' => date('Y-m-d'),
        'fecha_programacion' => $batch["fecha_programacion"],
        'fecha_actual' => date('Y-m-d'),
        'numero_orden' => $batch["numero_orden"],
        'numero_lote' => $batch["numero_lote"],
        'tamano_lote' => $batch["tamano_lote"],
        'lote_presentacion' => $batch["lote_presentacion"],
        'unidad_lote' => $batch["unidad_lote"],
        'estado' => $batch["estado"],
        'id_producto' => $batch["id_producto"]
      )
    );
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    return $rows;
  }

  public function delteBatch($batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "INSERT INTO batch (fecha_creacion, fecha_programacion, fecha_actual, numero_orden, numero_lote, 
                            tamano_lote, lote_presentacion, unidad_lote, estado, id_producto ) VALUES(
                            :fecha_creacion, :fecha_programacion, :fecha_actual,:numero_orden,:numero_lote,:tamano_lote,
                            :lote_presentacion,:unidad_lote,:estado,:id_producto)";
    $stmt = $connection->prepare($query);
    $rows = $stmt->execute(
      array(
        'fecha_creacion' => date('Y-m-d'),
        'fecha_programacion' => $batch["fecha_programacion"],
        'fecha_actual' => date('Y-m-d'),
        'numero_orden' => $batch["numero_orden"],
        'numero_lote' => $batch["numero_lote"],
        'tamano_lote' => $batch["tamano_lote"],
        'lote_presentacion' => $batch["lote_presentacion"],
        'unidad_lote' => $batch["unidad_lote"],
        'estado' => $batch["estado"],
        'id_producto' => $batch["id_producto"]
      )
    );
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    return $rows;
  }
}
