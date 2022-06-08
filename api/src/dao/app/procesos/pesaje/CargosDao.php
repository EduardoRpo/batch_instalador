<?php


namespace BatchRecord\Dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * Class CargosDao
 * @package BatchRecord\Dao
 * @author Teenus <Teenus-SAS>
 */

class CargosDao
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

    $stmt = $connection->prepare("SELECT * FROM cargos");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $cargos = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("cargos Obtenidos", array('cargos' => $cargos));
    return $cargos;
  }
}
