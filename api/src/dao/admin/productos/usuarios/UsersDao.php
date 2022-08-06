<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class UsersDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllUsers()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT u.id, u.nombre, u.apellido, u.email, c.cargo, m.modulo, u.user, u.rol, u.estado 
        FROM usuario u INNER JOIN cargos c INNER JOIN modulo m ON u.id_cargo = c.id AND u.id_modulo = m.id 
        ORDER BY id ASC");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $users = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("users Obtenidos", array('users' => $users));
        return $users;
    }
/*
    public function findUser($dataUser)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM usuario WHERE user= :usuario");
        $stmt->execute(['usuario' => $dataUser['usuario']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $usuario = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("usuario Obtenidos", array('usuario' => $usuario));
        return $usuario;
    }
*/
    public function saveUsers($datausers)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO usuario (nombre, apellido, email, user, clave, urlfirma, rol, id_modulo, id_cargo, estado)");
        $stmt->execute([ 				
        'nombre' => $datausers['nombres'],
        'apellido' => $datausers['apellidos'],
        'email' => $datausers['email'],
        'user' => $datausers['usuario'],
        'clave' => md5($datausers['clave']),
        'urlfirma' => $datausers['destino'],
        'rol' => $datausers['rol'],
        'id_modulo' => $datausers['modulo'],
        'id_cargo' => $datausers['cargo'],
        'estado' => '1']);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateUser($datausers)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE modulo SET modulo = :module WHERE id = :id_module");
        $stmt->execute([ 
		'nombre' => $datausers['nombres'],
        'apellido' => $datausers['apellidos'],
        'email' => $datausers['email'],
        'user' => $datausers['usuario'],
        'rol' => $datausers['rol'],
        'modulo' => $datausers['modulo'],
        'cargo' => $datausers['cargo'],
        'id' => $datausers['id']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteUsers($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM usuario WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function UpLoadSing($dataUser)
    {
        $nombre_temp = $_FILES['firma']['tmp_name'];
        $nombre = $_FILES['firma']['name'];
        $destino = '../../../admin/assets/img/firmas/' . $nombre;
        move_uploaded_file($nombre_temp, $destino);
    }
}
