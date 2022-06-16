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
      $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20,Logger::DEBUG));
    }

    public function findAll()
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT referencia FROM producto 
                                    WHERE referencia LIKE '%Granel%' 
                                    ORDER BY SUBSTR(referencia, 1, 7), CAST(SUBSTR(referencia, 8, LENGTH(referencia)) AS UNSIGNED)");
      $stmt->execute();
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $granel = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->notice("graneles Obtenidos", array('graneles' => $granel));
      return $granel;
    }
  }