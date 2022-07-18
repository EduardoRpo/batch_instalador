<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class DesinfectanteDao
 * @package BatchRecord\dao
 * @author Teenus <Teenus-SAS>
 */
class DesinfectanteDao
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
    $stmt = $connection->prepare("SELECT * FROM desinfectante");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $pesajes = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("Desinfectantes Obtenidos", array('desinfectantes' => $pesajes));
    return $pesajes;
  }

  public function desinfectanteRealizo($dataBatch)
  {
    $connection = Connection::getInstance()->getConnection();

    //$batch = $_POST['idBatch'];
    $modulo = $dataBatch['modulo'];

    $sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE modulo = :modulo AND batch = :batch";
    $query = $connection->prepare($sql);
    $query->execute(['modulo' => $modulo, 'batch' => $dataBatch['idBatch']]);
    $rows = $query->rowCount();

    if ($rows == 0) {

      if ($modulo == 8)
        $dataMicrobiologia = json_decode($dataBatch['dataMicro'], true);

      $modulo == 8 ? $desinfectante = $dataMicrobiologia[0]["desinfectante"] : $desinfectante = $dataBatch['desinfectante'];
      $modulo == 8 ? $obs_desinfectante = $dataMicrobiologia[0]["observaciones"] : $obs_desinfectante = $dataBatch['obs_desinfectante'];
      // $realizo = $dataBatch['realizo'];
      $verifico = '0';

      $sql = "INSERT INTO batch_desinfectante_seleccionado (desinfectante, observaciones, modulo, batch, realizo, verifico) 
                VALUES(:desinfectante, :observaciones, :modulo, :batch, :realizo, :verifico)";
      $query = $connection->prepare($sql);
      $query->execute([
        'desinfectante' => $desinfectante,
        'observaciones' => $obs_desinfectante,
        'modulo' => $modulo,
        'batch' => $dataBatch['idBatch'],
        'realizo' => $dataBatch['realizo'],
        'verifico' => $verifico
      ]);

      //if ($modulo != 4 && $modulo != 8 && $modulo != 9)
      //registrarFirmas($conn, $batch, $modulo);
    }
  }

  public function desinfectanteVerifico($dataBatch)
  {
    $connection = Connection::getInstance()->getConnection();

    $sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE modulo = :modulo AND batch = :batch";
    $query = $connection->prepare($sql);
    $query->execute(['modulo' => $dataBatch['modulo'], 'batch' => $dataBatch['idBatch']]);
    $rows = $query->rowCount();

    if ($rows > 0) {
      $sql = "UPDATE batch_desinfectante_seleccionado SET verifico = :verifico WHERE batch = :batch AND modulo = :modulo";
      $query = $connection->prepare($sql);
      $query->execute([
        'modulo' => $dataBatch['modulo'],
        'batch' => $dataBatch['idBatch'],
        'verifico' => $dataBatch['verifico']
      ]);
      // if ($modulo != 4 && $modulo != 8 && $modulo != 9)
      //     registrarFirmas($conn, $batch, $modulo);
    }
  }


  public function findDisinfectantByBatchandModule($batch, $module)
  {
    $conn = Connection::getInstance()->getConnection();
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM `batch_desinfectante_seleccionado` 
                                  WHERE batch = :batch AND modulo = :modulo");
    $stmt->execute(['batch' => $batch, 'modulo' => $module]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $disinfectant = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("disinfectant got", array('disinfectant' => $disinfectant));
    return $disinfectant;
  }
}
