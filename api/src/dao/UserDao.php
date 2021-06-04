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
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
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

  public function findByBatch($modulo, $batch)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT realizo FROM `batch_desinfectante_seleccionado` WHERE modulo = :modulo AND batch = :batch");
    $stmt->execute(array('modulo' => $modulo, 'batch' => $batch));
    $idUsuario = $stmt->fetchAll($connection::FETCH_ASSOC);

    $stmt = $connection->prepare("SELECT CONCAT(nombre, ' ',apellido) AS nombres FROM `usuario` WHERE id = :idUser");
    $stmt->execute(array('idUser' => $idUsuario[0]['realizo']));
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $user = $stmt->fetch($connection::FETCH_ASSOC);
    $this->logger->notice("usuarios Obtenidos", array('usuarios' => $user));
    return $user;
  }
}
