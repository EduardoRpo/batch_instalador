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
    /* Encuentra id Usuario que firma en primera seccion */

    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT realizo FROM `batch_desinfectante_seleccionado` WHERE modulo = :modulo AND batch = :batch");
    $stmt->execute(array('modulo' => $modulo, 'batch' => $batch));
    $idUsuario = $stmt->fetchAll($connection::FETCH_ASSOC);

    /* Si no existe usuario en batch desinfectante */

    if (empty($idUsuario)) {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT CONCAT(nombre, ' ',apellido) AS nombres FROM `usuario` WHERE id_cargo = :id_cargo");
      $stmt->execute(['id_cargo' => 12]);
      $user = $stmt->fetch($connection::FETCH_ASSOC);
    } else {
      /* Encuentra Usuario */

      $stmt = $connection->prepare("SELECT CONCAT(nombre, ' ',apellido) AS nombres FROM `usuario` WHERE id = :idUser");
      $stmt->execute(array('idUser' => $idUsuario[0]['realizo']));
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $user = $stmt->fetch($connection::FETCH_ASSOC);
    }
    
    $this->logger->notice("usuarios Obtenidos", array('usuarios' => $user));
    return $user;
  }

  public function inactive($idUser)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT estado FROM usuario WHERE id = :user");
    $stmt->execute(array('user' => $idUser));
    $stdUser = $stmt->fetch($connection::FETCH_ASSOC);

    $stdUser['estado'] == 1 ? $estado = 0 : $estado = 1;
    $stmt = $connection->prepare("UPDATE usuario SET estado = :estado WHERE id = :user");
    $stmt->execute(array('user' => $idUser, 'estado' => $estado));
    return $estado;
  }
}
