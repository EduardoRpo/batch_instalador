<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class InstructivosDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findInstructivosByReference($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT p.referencia, p.nombre_referencia, p.base_instructivo 
                                      FROM producto p 
                                      WHERE p.referencia = :referencia");
        $stmt->execute(['referencia' => $referencia]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $granel = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("granel Obtenidos", array('granel' => $granel));
        return $granel;
    }
}
