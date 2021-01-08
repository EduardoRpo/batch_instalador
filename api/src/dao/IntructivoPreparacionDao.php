<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO;

class IntructivoPreparacionDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findByProduct($idProduct)
  {
    $connection = Connection::getInstance()->getConnection();

    $sql = "SELECT * FROM producto WHERE referencia =:referencia";
    $query = $connection->prepare($sql);
    $query->execute([
      'referencia' => $idProduct,
    ]);

    $data = $query->fetch(PDO::FETCH_ASSOC);
    $tabla = $data["base_instructivo"];
    $producto = $data["id_nombre_producto"];

    if ($tabla == 0){
      $stmt = $connection->prepare("SELECT * FROM instructivo_preparacion WHERE id_producto = :referencia");
      $stmt->bindValue(':referencia', $idProduct, PDO::PARAM_INT);
    }
    else{
      $stmt = $connection->prepare("SELECT id, pasos, tiempo FROM instructivos_base WHERE producto = :producto");
      $stmt->bindValue(':producto', $producto, PDO::PARAM_INT);
    }

    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $pesajes = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("instructivo Obtenidas", array('materias Primas' => $pesajes));
    return $pesajes;
  }
}
