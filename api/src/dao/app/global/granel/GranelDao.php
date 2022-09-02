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
class GranelDao
{
  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAll()
  {
    session_start();
    $rol = $_SESSION['rol'];

    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT referencia, nombre_referencia
                                    FROM producto 
                                    WHERE referencia LIKE '%Granel%' 
                                    ORDER BY SUBSTR(referencia, 1, 7), CAST(SUBSTR(referencia, 8, LENGTH(referencia)) AS UNSIGNED)");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $granel = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("graneles Obtenidos", array('graneles' => $granel));
    $granel[0]['superUsuario'] = $rol;
    return $granel;
  }

  public function findGranelesNoFormula()
  {
    $connection = Connection::getInstance()->getConnection();

    /* Graneles */
    $stmt = $connection->prepare("SELECT referencia, nombre_referencia, 0 as superUsuario
                                    FROM producto 
                                    WHERE referencia LIKE '%Granel%' 
                                    ORDER BY SUBSTR(referencia, 1, 7), CAST(SUBSTR(referencia, 8, LENGTH(referencia)) AS UNSIGNED)");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $granel = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("graneles Obtenidos", array('graneles' => $granel));

    /* Graneles con formula */

    $stmt = $connection->prepare("SELECT DISTINCT f.id_producto, p.nombre_referencia FROM formula f
                                  INNER JOIN producto p ON p.referencia = f.id_producto 
                                  WHERE id_producto LIKE '%Granel%' 
                                  ORDER BY SUBSTR(id_producto, 1, 7), CAST(SUBSTR(id_producto, 8, LENGTH(id_producto)) AS UNSIGNED)");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $granelFormula = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("graneles Obtenidos", array('graneles' => $granelFormula));

    $granelNoFormula = array_diff_assoc($granel, $granelFormula);
    $granelNoFormula = array_values($granelNoFormula);
    $granelNoFormula[0]['superUsuario'] = 0;

    return $granelNoFormula;
  }
}
