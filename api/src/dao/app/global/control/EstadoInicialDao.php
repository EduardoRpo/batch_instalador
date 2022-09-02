<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class EstadoInicialDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function estadoInicial($referencia, $fechaprogramacion)
    {
        $connection = Connection::getInstance()->getConnection();

        /* validar que exista la formula*/

        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM formula WHERE id_producto = :referencia");
        $stmt->execute(['referencia' => $referencia]);
        $resultFormula = $stmt->rowCount();

        /* validar que exista el instructivo */

        $stmt = $connection->prepare("SELECT * FROM instructivo_preparacion WHERE id_producto = :referencia");
        $stmt->execute(['referencia' => $referencia]);
        $resultPreparacionInstructivos = $stmt->rowCount();


        /* si el instructivo no existe valida que exista el instructivo en Bases*/
       /*  if ($resultPreparacionInstructivos == 0) {
            $stmt = $connection->prepare("SELECT instructivo FROM producto WHERE referencia = :referencia");
            $stmt->execute(['referencia' => $referencia]);
            $resultPreparacionInstructivos = $stmt->rowCount();
        } */

        /* consolida resultados */
        $result = $resultFormula * $resultPreparacionInstructivos;

        /* Asigna el estado de acuerdo con el resultado */
        if ($result === 0) {
            $estado = '1';  //Sin formula
            $fechaprogramacion = null;
        }

        if ($result > 0 && $fechaprogramacion == '')
            $estado = '2'; // Inactivo  


        if ($result > 0 && $fechaprogramacion != '')
            $estado = '3';  //Pesaje


        return array($estado, $fechaprogramacion);
    }
}
