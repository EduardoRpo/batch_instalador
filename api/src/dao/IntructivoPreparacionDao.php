<?php


  namespace BatchRecord\dao;


  use BatchRecord\Constants\Constants;
  use Monolog\Handler\RotatingFileHandler;
  use Monolog\Handler\StreamHandler;
  use Monolog\Logger;

  class IntructivoPreparacionDao
  {
    private $logger;

    public function __construct()
    {
      $this->logger = new Logger(self::class);
      $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20,Logger::DEBUG));
    }

    public function findByProduct($idProduct)
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT * FROM instructivo_preparacion WHERE id_producto = :referencia");
      $stmt->execute(array('referencia' => $idProduct));
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $pesajes = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->notice("instructivo Obtenidas", array('materias Primas' => $pesajes));
      return $pesajes;
    }
  }