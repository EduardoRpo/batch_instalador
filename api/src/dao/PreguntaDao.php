<?php


  namespace BatchRecord\dao;


  use BatchRecord\Constants\Constants;
  use Monolog\Handler\RotatingFileHandler;
  use Monolog\Handler\StreamHandler;
  use Monolog\Logger;

  /**
   * Class PreguntaDao
   * @package BatchRecord\dao
   * @author Teenus <Teenus-SAS>
   */
  class PreguntaDao
  {
    private $logger;

    public function __construct()
    {
      $this->logger = new Logger(self::class);
      $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20,Logger::DEBUG));
    }

    public function findEmpaque():array
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT * FROM preguntas");
      $stmt->execute();
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $pesajes = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->notice("preguntas Obtenidos", array('preguntas' => $pesajes));
      return $pesajes;
    }

    public function findByModule($idModule): array
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT * FROM preguntas AS p INNER JOIN modulo_pregunta AS mp ON mp.id_pregunta = p.id WHERE mp.id_modulo = :idModule");
      $stmt->execute(array('idModule' => $idModule));
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $pesajes = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->notice("preguntas Obtenidos", array('preguntas' => $pesajes));
      return $pesajes;
    }
  }