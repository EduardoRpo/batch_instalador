<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * Class MateriaPrimaDao
 * @package BatchRecord\dao
 * @author Teenus <Teenus-SAS>
 */

class MateriaPrimaDao
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
    //$stmt = $connection->prepare("SELECT * FROM formula INNER JOIN materia_prima ON formula.id_materiaprima = materia_prima.referencia WHERE formula.id_producto = :referencia");
    $stmt = $connection->prepare("SELECT f.id, mp.referencia, mp.alias, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
                                  FROM formula f INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
                                  WHERE f.id_producto = :referencia");
    $stmt->execute(array('referencia' => $idProduct));
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $materials = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("materia Primas Obtenidas", array('materias Primas' => $materials));
    return $materials;
  }

  public function findByProductInv($idProduct)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT id_notificacion_sanitaria FROM producto WHERE referencia = :referencia");
    $stmt->execute(array('referencia' => $idProduct));
    $notif_sanitaria = $stmt->fetch($connection::FETCH_ASSOC);

    $stmt = $connection->prepare("SELECT f.id, mp.referencia, mp.alias, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
                                  FROM formula_f f INNER JOIN materia_prima_f mp ON f.id_materiaprima = mp.referencia 
                                  WHERE f.notif_sanitaria = :notif_sanitaria");
    $stmt->execute(array('notif_sanitaria' => $notif_sanitaria['id_notificacion_sanitaria']));
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $pesajes = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("materia Primas Obtenidas", array('materias Primas' => $pesajes));
    return $pesajes;
  }

  public function findVirtualByBatch($batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT CONCAT(us.nombre, ' ',us.apellido) as verifico, us.urlfirma, bf2.fecha_registro 
                                  FROM batch_firmas2seccion bf2 
                                  INNER JOIN usuario u ON bf2.realizo = u.id 
                                  INNER JOIN usuario us ON bf2.verifico = us.id 
                                  WHERE batch = :batch AND modulo = :modulo");
    $stmt->execute(array('batch' => $batch, 'modulo' => 2));
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $etiquetasverifico = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("materia Primas Obtenidas", array('materias Primas' => $etiquetasverifico));
    return $etiquetasverifico;
  }

  public function findTanksByBatch($batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT cantidad FROM `batch_tanques` WHERE id_batch = :batch");
    $stmt->execute(array('batch' => $batch));
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $cantidadTanques = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("materia Primas Obtenidas", array('materias Primas' => $cantidadTanques));
    return $cantidadTanques;
  }
}
