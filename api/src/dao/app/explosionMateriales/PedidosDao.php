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
