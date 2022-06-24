<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class AutenticacionDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findUser($dataUser)
    {
        $connection = Connection::getInstance()->getConnection();
        $clave = md5($dataUser['password']);
        
        $sql = "SELECT id, CONCAT(nombre, ' ', apellido) as usuario, rol, urlfirma, estado FROM usuario WHERE user = :user AND clave = :clave";
        $query = $connection->prepare($sql);
        $query->execute([
            'clave' => $clave,
            'user' => $dataUser['user']
        ]);

        $data = $query->fetch($connection::FETCH_ASSOC);
        return $data;
    }
}
