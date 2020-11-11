<?php


  namespace BatchRecord\Dao;


  use BatchRecord\Constants\Constants;
  use Monolog\Handler\RotatingFileHandler;
  use Monolog\Logger;

  /**
   * Class PesajeDao
   * @package BatchRecord\Dao
   * @author Teenus <Teenus-SAS>
   */
  
  class PesajeDao
  {
    private $logger;

    public function __construct()
    {
      $this->logger = new Logger(self::class);
      $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20,Logger::DEBUG));
    }

    public function findAll()
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia INNER JOIN linea ON producto.id_linea = linea.id INNER JOIN propietario ON producto.id_propietario = propietario.id INNER JOIN presentacion_comercial ON producto.id_presentacion_comercial = presentacion_comercial.id WHERE (batch.estado = 1 OR batch.estado = 2) AND  batch.fecha_programacion  BETWEEN CURRENT_DATE() AND CURDATE() + INTERVAL 1 DAY OR batch.fecha_programacion <= CURRENT_DATE() ORDER BY batch.id_batch ASC");
      $stmt->execute();
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $pesajes = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->notice("Pesajes Obtenidos", array('pesajes' => $pesajes));
      return $pesajes;

    }
  }