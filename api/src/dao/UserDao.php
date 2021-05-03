<?php


  namespace BatchRecord\dao;


  use BatchRecord\Constants\Constants;
  use Monolog\Handler\RotatingFileHandler;
  use Monolog\Logger;

  class UserDao
  {
    private $logger;

    public function __construct()
    {
      $this->logger = new Logger(self::class);
      $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20,Logger::DEBUG));
    }

    public function findByEmail($email)
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT * FROM `usuario` WHERE email = :email");
      $stmt->execute(array('email' => $email));
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $user = $stmt->fetch($connection::FETCH_ASSOC);
      $this->logger->notice("usuarios Obtenidos", array('usuarios' => $user));
      return $user;
    }

    /* public function findByEmail($email)
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT * FROM `usuario` WHERE email = :email");
      $stmt->execute(array('email' => $email));
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $user = $stmt->fetch($connection::FETCH_ASSOC);
      $this->logger->notice("usuarios Obtenidos", array('usuarios' => $user));
      return $user;
    } */
  }