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
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAllBatch()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT e.id_materiaprima, m.nombre, SUM(e.cantidad) AS cantidad, SUM(e.uso) AS uso 
                                  FROM explosion_materiales_batch e 
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
    $stmt = $connection->prepare("SELECT emb.id_materiaprima, mp.nombre, SUM(emb.cantidad) AS cantidad_batch, SUM(emb.uso) AS uso_batch, SUM(emb.uso) - SUM(emb.cantidad) AS gap_batch
                                  FROM explosion_materiales_batch emb
                                  INNER JOIN materia_prima mp ON mp.referencia = emb.id_materiaprima
                                  GROUP BY emb.id_materiaprima
                                  ORDER BY emb.id_materiaprima;");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $explosionMaterialesBatch = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("batch_explosion_materiales Obtenidos", array('batch_explosion_materiales' => $explosionMaterialesBatch));

    $stmt = $connection->prepare("SELECT emp.id_materiaprima, mp.nombre, SUM(emp.cantidad) AS cantidad_pedidos 
                                  FROM explosion_materiales_pedidos emp 
                                  INNER JOIN materia_prima mp ON mp.referencia = emp.id_materiaprima 
                                  GROUP BY emp.id_materiaprima ORDER BY `emp`.`id_materiaprima` ASC;");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $explosionMaterialesPedidos = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("batch_explosion_materiales Obtenidos", array('batch_explosion_materiales' => $explosionMaterialesPedidos));

    for ($i = 0; $i < sizeof($explosionMaterialesPedidos); $i++) {
      $refPedidos =  $explosionMaterialesPedidos[$i]['id_materiaprima'];
      for ($j = 0; $j < sizeof($explosionMaterialesBatch); $j++) {
        $refBatch =  $explosionMaterialesBatch[$j]['id_materiaprima'];
        if ($refPedidos == $refBatch) {
          $explosionMaterialesBatch[$j]['cantidad_pedidos'] = $explosionMaterialesPedidos[$i]['cantidad_pedidos'];
          $explosionMaterialesBatch[$j]['gap_pedidos'] = $explosionMaterialesBatch[$j]['uso_batch'] - $explosionMaterialesBatch[$j]['cantidad_pedidos'];
        } else {
          $exist = array_key_exists('cantidad_pedidos', $explosionMaterialesBatch[$j]);
          if ($exist) {
            $cantidad_pedidos = $explosionMaterialesBatch[$j]['cantidad_pedidos'];
            if ($cantidad_pedidos == 0) {
              $explosionMaterialesBatch[$j]['cantidad_pedidos'] = 0;
              $explosionMaterialesBatch[$j]['gap_pedidos'] = 0;
            }
          } else {
            $explosionMaterialesBatch[$j]['cantidad_pedidos'] = 0;
            $explosionMaterialesBatch[$j]['gap_pedidos'] = 0;
          }
        }
      }
    }

    return $explosionMaterialesBatch;
  }

  public function findRefExplosionMateriales()
  {
    /* Validar la fecha y si no es exacta eliminar los batch en explosion de materiales con estado 4 */
    /*  $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
    $fecha_entrada = strtotime("d-m-Y 21:00:00");

    if ($fecha_actual < $fecha_entrada) {
      
      echo "La fecha comparada es igual o menor";
    }
 */

    /* Consultar datos procesados */
    $explosionMateriales = [];
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT COUNT(DISTINCT batch) AS total_batch FROM `explosion_materiales_batch`");
    $stmt->execute();
    $total_batch = $stmt->fetchAll($connection::FETCH_ASSOC);

    $stmt = $connection->prepare("SELECT COUNT(DISTINCT id_producto) AS total_referencias_batch FROM `explosion_materiales_batch`");
    $stmt->execute();
    $total_ref_batch = $stmt->fetchAll($connection::FETCH_ASSOC);

    $stmt = $connection->prepare("SELECT COUNT(DISTINCT id_materiaprima) AS total_id_materiaprima FROM `explosion_materiales_batch`;");
    $stmt->execute();
    $total_MP_batch = $stmt->fetchAll($connection::FETCH_ASSOC);

    $stmt = $connection->prepare("SELECT COUNT(DISTINCT id_pedido) AS total_pedidos FROM `explosion_materiales_pedidos`;");
    $stmt->execute();
    $total_pedidos = $stmt->fetchAll($connection::FETCH_ASSOC);

    $stmt = $connection->prepare("SELECT COUNT(DISTINCT id_producto) AS total_referencias_pedidos FROM `explosion_materiales_pedidos`;");
    $stmt->execute();
    $total_ref_pedidos = $stmt->fetchAll($connection::FETCH_ASSOC);

    $stmt = $connection->prepare("SELECT COUNT(DISTINCT id_materiaprima) AS total_MP_pedidos FROM `explosion_materiales_pedidos`;");
    $stmt->execute();
    $total_MP_pedidos = $stmt->fetchAll($connection::FETCH_ASSOC);

    array_push($explosionMateriales, $total_batch[0]);
    array_push($explosionMateriales, $total_ref_batch[0]);
    array_push($explosionMateriales, $total_MP_batch[0]);
    array_push($explosionMateriales, $total_pedidos[0]);
    array_push($explosionMateriales, $total_ref_pedidos[0]);
    array_push($explosionMateriales, $total_MP_pedidos[0]);


    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $this->logger->notice("cantidad_explosion", array('cantidad_explosion' => $explosionMateriales));
    return $explosionMateriales;
  }

  public function findReferenciasSinFormula()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM explosion_materiales_referencias");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $referencias = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("referencias Obtenidos", array('referencias' => $referencias));
    return $referencias;
  }
}
