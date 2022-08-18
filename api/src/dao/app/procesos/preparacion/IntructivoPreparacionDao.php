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
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findinstructiveByProduct($idProduct)
  {
    $connection = Connection::getInstance()->getConnection();

    // $sql = "SELECT * FROM producto WHERE referencia =:referencia";
    // $query = $connection->prepare($sql);
    // $query->execute(['referencia' => $idProduct]);

    // $data = $query->fetch(PDO::FETCH_ASSOC);
    // $tabla = $data["base_instructivo"];
    // $producto = $data["instructivo"];

    //if ($tabla == 1) {
      $stmt = $connection->prepare("SELECT * FROM instructivo_preparacion WHERE id_producto = :referencia");
      $stmt->execute(['referencia' => $idProduct]);
    // } else {
    //   $stmt = $connection->prepare("SELECT id, pasos, tiempo FROM instructivos_base WHERE producto = :producto");
    //   $stmt->execute(['producto' => $producto]);
    // }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $instructivo = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("instructivo Obtenidas", array('instructivos' => $instructivo));
    return $instructivo;
  }

  public function updateInstructive($dataInstrictive)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("UPDATE instructivo_preparacion SET pasos = :instruccion, tiempo = :tiempo WHERE id = :id AND id_producto = CAST(:referencia AS INT)");
    $stmt->execute(['instruccion'=>$dataInstrictive['actividad'], 'tiempo' => $dataInstrictive['tiempo'], 'id'=>$dataInstrictive['id'],'referencia'=> intval($dataInstrictive['referencia'])]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
  }

  public function saveInstructive($dataInstrictive)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("INSERT INTO instructivo_preparacion (pasos, tiempo, id_producto) VALUES (:proceso, :tiempo, :referencia )");
    $stmt->execute(['proceso'=>$dataInstrictive['actividad'], 'tiempo' => $dataInstrictive['tiempo'],'referencia'=> $dataInstrictive['referencia']]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
  }

  public function deleteInstructive($dataInstructive)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("DELETE FROM instructivo_preparacion WHERE pasos = :id AND id_producto = CAST(:referencia AS INT)");
    $stmt->execute(['id'=>$dataInstructive['id'], 'referencia' => $dataInstructive['referenfia']]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'error' => $stmt->errorInfo()));
  }
}
