<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class PreBatchDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllPreBatch()
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT pp.nombre AS propietario, exp.pedido, exp.fecha_pedido, exp.id_producto, p.nombre_referencia, exp.unidades, 
                       DATE_ADD(exp.fecha_pedido, INTERVAL 10 DAY) AS fecha_pesaje, DATE_ADD(exp.fecha_pedido, INTERVAL 11 DAY) AS fecha_preparacion, 
                       DATE_ADD(exp.fecha_pedido, INTERVAL 7 DAY) AS recepcion_insumos, DATE_ADD(exp.fecha_pedido, INTERVAL 14 DAY) AS envasado, 
                       DATE_ADD(exp.fecha_pedido, INTERVAL 15 DAY) AS entrega 
                       FROM `explosion_materiales_pedidos_registro` exp 
                       INNER JOIN producto p ON p.referencia = exp.id_producto 
                       INNER JOIN propietario pp ON pp.id = p.id_propietario;";
        $query = $connection->prepare($sql);
        $query->execute();
        $preBatch = $query->fetchAll($connection::FETCH_ASSOC);
        return $preBatch;
    }
    
    public function findGranelByReference($reference)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT referencia 
                FROM producto 
                WHERE multi = (SELECT multi FROM producto WHERE referencia = :referencia) 
                AND presentacion_comercial = 1;";
        $query = $connection->prepare($sql);
        $query->execute(['referencia'=>$reference]);
        $granel = $query->fetchAll($connection::FETCH_ASSOC);
        return $granel;
    }
}
