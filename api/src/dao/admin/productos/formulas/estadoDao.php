<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use mysqli;

class estadoDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function buscarFormula($data)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM formula WHERE id_producto = :referencia");
        $buscarFormula = $stmt->execute(['referencia' => $data['referencia']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $resultFormula = mysqli_num_rows($buscarFormula);
        return $resultFormula;
    }

    public function BuscarInstructivo($data)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM instructivo_preparacion WHERE id_producto = :referencia");
        $BuscarInstructivo= $stmt->execute(['referencia' => $data['referencia']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $resultPreparacionInstructivos = mysqli_num_rows($BuscarInstructivo);
        return $resultPreparacionInstructivos;
    }

    public function AsignarEstado($formula,$instructivo, $fechaProgramacion)
    {
        $result = $formula * $instructivo;
        if($result === 0 )
        {
            $estado = '1'; //sin formula
            $fechaProgramacion = '';
        }
        if($result > 0 && $fechaProgramacion == '')
        {
            $estado = '2'; // inactivo
        }
        if($result > 0 && $fechaProgramacion =! '')
        {
            $estado = '3'; //pesaje
        }
        return array($estado, $fechaProgramacion);
    }

    public function estadoInicial($referencia, $fechaProgramacion)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM formula WHERE id_producto = : referencia");
        $Formula = $stmt->execute(['referencia' => $referencia]);
        $resultFormula = $Formula->rowCount();
    }

    
}