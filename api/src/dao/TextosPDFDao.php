<?php


  namespace BatchRecord\dao;


  use BatchRecord\Constants\Constants;
  use Monolog\Handler\RotatingFileHandler;
  use Monolog\Handler\StreamHandler;
  use Monolog\Logger;

  /**
   * Class TextosPDF
   * @package BatchRecord\dao
   * @author Teenus <Teenus-SAS>
   */
  class TextosPDFDao
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
      $stmt = $connection->prepare("SELECT * FROM pdf_textos");
      $stmt->execute();
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $textospdf = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->notice("TextosPDF Obtenidos", array('TextosPDF' => $textospdf));
      return $textospdf;
    }
  }