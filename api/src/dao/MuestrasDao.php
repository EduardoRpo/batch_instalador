<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use DateTime;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO;

class PedidosDao
{

  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAll()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM batch_muestras");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $muestras = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Muestras Obtenidos", array('muestras' => $muestras));
    return $muestras;
  }

  public function findByIdBatch($batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM batch_muestras WHERE id = :pedido");
    $stmt->bindValue(':pedido', $batch, PDO::PARAM_INT);
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $pedido = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Pedido Obtenido", array('especificaciones' => $pedido));
    return $pedido;
  }

  public function findFormula($ref)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "SELECT COUNT(*) FROM formula WHERE id_producto = :referencia";
    $stmt = $connection->prepare($query);
    $stmt->execute(array('referencia' => $ref));
    $rows = $stmt->fetchColumn();
    return $rows;
  }

  public function countPedidos($pedido)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "SELECT COUNT(*) FROM pedidos WHERE pedido = :pedido";
    $stmt = $connection->prepare($query);
    $stmt->execute(array('pedido' => $pedido));
    $rows = $stmt->fetchColumn();
    return $rows;
  }

  public function countProductos($ref)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "SELECT COUNT(*) FROM producto WHERE referencia = :referencia";
    $stmt = $connection->prepare($query);
    $stmt->execute(array('referencia' => $ref));
    $rows = $stmt->fetchColumn();
    return $rows;
  }

  public function findBatch($pedido, $ref)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "SELECT fecha_programacion, unidad_lote, pedido FROM batch WHERE pedido = :pedido AND id_producto = :referencia";
    $stmt = $connection->prepare($query);
    $stmt->execute(array('pedido' => $pedido, 'referencia' => $ref));
    $batch = $stmt->fetchAll($connection::FETCH_ASSOC);
    return $batch;
  }

  public function updateBatch($pedido, $ref, $cantidad)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "UPDATE batch SET unidad_lote = :unidad_lote WHERE pedido = :pedido AND id_producto = :referencia";
    $stmt = $connection->prepare($query);
    $stmt->execute(array('unidad_lote' => $cantidad, 'pedido' => $pedido, 'referencia' => $ref));
  }

  public function findProducto($ref)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "SELECT p.presentacion_comercial as presentacion, linea.densidad FROM producto p INNER JOIN linea ON p.id_linea = linea.id WHERE referencia = :referencia";
    $stmt = $connection->prepare($query);
    $stmt->execute(array('referencia' => $ref));
    $producto = $stmt->fetchAll($connection::FETCH_ASSOC);
    return $producto;
  }


  public function savePedido($pedido, $referencia, $fechaDoc, $fechaVencimiento)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "INSERT INTO pedidos SET pedido = :pedido, fecha_pedido = :fecha_pedido, fecha_entrega = :fecha_entrega";
    $stmt = $connection->prepare($query);
    $stmt->execute(
      array(
        'pedido' => $pedido,
        'fecha_pedido' => $fechaDoc,
        'fecha_entrega' => $fechaVencimiento
      )
    );
  }

  public function saveBatch($fechahoy, $tamanolote, $presentacion, $cantidad, $ref, $pedido, $estado)
  {
    $connection = Connection::getInstance()->getConnection();
    $query = "INSERT INTO batch SET pedido = :pedido, fecha_creacion = :fecha_creacion, numero_orden = 'OP012020', 
                          numero_lote = 'X0010320', tamano_lote = :tamano_lote, lote_presentacion = :lote_presentacion, 
                          unidad_lote = :unidad_lote, estado = :estado, id_producto = :referencia";
    $stmt = $connection->prepare($query);
    $stmt->execute(
      array(
        'fecha_creacion' => $fechahoy,
        'tamano_lote' => $tamanolote,
        'lote_presentacion' => $presentacion,
        'unidad_lote' => $cantidad,
        'referencia' => $ref,
        'pedido' => $pedido,
        'estado' => $estado
      )
    );

    //Envia email
  }

  public function save($data)
  {
    //$connection = Connection::getInstance()->getConnection();
    $pedidos = json_decode($data, true);

    foreach ($pedidos as $pedido) {
      // valida si el pedido si existe 
      $rows_productos = $this->countProductos($pedido['producto']);

      if ($rows_productos > 0) {

        $rows_pedidos = $this->countPedidos($pedido['Nro_Pedido']);
        $batch = $this->findBatch($pedido['Nro_Pedido'], $pedido['producto']);

        if ($rows_pedidos > 0 && !empty($batch[0])) {
          if ($batch[0]["unidad_lote"] != $pedido['cantidad']) {
            if (empty($batch[0]["fecha_programacion"])) {
              $this->updateBatch($pedido['Nro_Pedido'], $pedido['producto'], $pedido['cantidad']);
            } else {
              $file = "../html/pedidos/logs/log_pedidos.txt";
              $notificacion = date("d-m-Y") . " " . date("H:i:s") . " El pedido: " . $pedido['Nro_Pedido'] . " con referencia: " . $pedido['producto'] . " No se actualizó ya que se encuentra programado\n";
              file_put_contents($file, $notificacion, FILE_APPEND | LOCK_EX);
            }
          }
        } else {

          // Si el pedido no existe ingresa el pedido
          if ($rows_pedidos == 0)
            $this->savePedido($pedido['Nro_Pedido'], $pedido['producto'], $pedido['Fecha_Dcto'], $pedido['F_vencim']);

          // Busca el producto 
          $producto = $this->findProducto($pedido['producto']);

          // calcula informacion para la creacion del batch 
          $densidad = $producto[0]["densidad"];
          $presentacion = $producto[0]["presentacion"];
          $fechahoy = date('Y-m-d');
          $tamanolote = round((($pedido['cantidad'] * $densidad * $presentacion) / 1000) * (1 + 0.005));

          // Busca si existe formula 
          $formula = $this->findFormula($pedido['producto']);

          // determina el estado de creacion del batch 
          $formula > 0 ? $estado = '2' : $estado = '1';

          // Crea el batch record
          $this->saveBatch($fechahoy, $tamanolote, $presentacion, $pedido['cantidad'], $pedido['producto'], $pedido['Nro_Pedido'], $estado);
        }
      } else {
        $file = "../html/pedidos/logs/log_pedidos.txt";
        $notificacion = date("d-m-Y") . " " . date("H:i:s") . " El pedido: " . $pedido['Nro_Pedido'] . " con referencia: " . $pedido['producto'] . " No se creó porque no existe referencia\n";
        file_put_contents($file, $notificacion, FILE_APPEND | LOCK_EX);
      }
    }
    //$this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    //return $rows;
  }
}
