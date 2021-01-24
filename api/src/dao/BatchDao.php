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
      $stmt = $connection->prepare("SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.id_producto as referencia, batch.numero_lote, producto.nombre_referencia FROM batch INNER JOIN producto ON producto.referencia = batch.id_producto WHERE batch.estado = 1 OR batch.estado = 2 AND batch.fecha_programacion = CURRENT_DATE() ORDER BY batch.id_batch DESC");
      $stmt->execute();
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $pesajes = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->notice("Batch Obtenidos", array('batch' => $pesajes));
      return $pesajes;

    }

    /**
     * Encuentra un batch por id
     * @param $id integer id a buscar
     * @return mixed
     */
    public function findById($id)
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT p.referencia, p.nombre_referencia,  p.presentacion_comercial as presentacion, batch.numero_orden, batch.tamano_lote, batch.numero_lote, batch.unidad_lote, linea.nombre as linea, linea.densidad, batch.fecha_programacion FROM producto p
                                    INNER JOIN batch ON batch.id_producto = p.referencia INNER JOIN linea ON linea.id = p.id_linea
                                    WHERE id_batch =:idBatch");
      
      $stmt->execute(array('idBatch' => $id));
      
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $batch = $stmt->fetch($connection::FETCH_ASSOC);
      $this->logger->notice("batch consultado", array('batch' => $batch));

      return $batch;

    }

    public function save($batch)
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