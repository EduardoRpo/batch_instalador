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
      $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20,Logger::DEBUG));
    }

    public function findAll()
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT e.id_materiaprima, m.nombre, SUM(e.cantidad) AS cantidad, SUM(e.uso) AS uso 
                                    FROM batch_explosion_materiales e 
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
      $stmt = $connection->prepare("SELECT e.id_materiaprima, m.nombre, COALESCE(SUM(e.cantidad),0) AS cantidad_batch, COALESCE(SUM(ep.cantidad),0) AS cantidad_pedidos, 
                                    COALESCE(SUM(ep.uso),0) AS cantidad_batch_uso, COALESCE(SUM(e.cantidad),0) + COALESCE(SUM(ep.cantidad),0) - COALESCE(SUM(ep.uso),0) AS gap 
                                    FROM batch_explosion_materiales_pedidos e 
                                    INNER JOIN materia_prima m ON e.id_materiaprima = m.referencia
                                    LEFT JOIN batch_explosion_materiales ep ON ep.id_materiaprima = m.referencia
                                    GROUP BY id_materiaprima  
                                    ORDER BY `GAP`  DESC;");
      $stmt->execute();
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $batchExplosionMateriales = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->notice("batch_explosion_materiales Obtenidos", array('batch_explosion_materiales' => $batchExplosionMateriales));
      return $batchExplosionMateriales;

    }
  }