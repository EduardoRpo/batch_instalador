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

        $sql = "SELECT pp.nombre AS propietario, exp.pedido, exp.fecha_pedido, exp.estado, exp.cantidad_acumulada, exp.fecha_insumo, (SELECT referencia FROM producto 
                WHERE multi = (SELECT multi FROM producto WHERE referencia = exp.id_producto) 
                AND presentacion_comercial = 1) AS granel, exp.id_producto, p.nombre_referencia, exp.cant_original, exp.cantidad, 
                    DATE_ADD(exp.fecha_pedido, INTERVAL 8 DAY) AS fecha_pesaje, DATE_ADD(exp.fecha_pedido, INTERVAL 9 DAY) AS fecha_preparacion, 
                    DATE_ADD(exp.fecha_pedido, INTERVAL 6 DAY) AS recepcion_insumos, DATE_ADD(exp.fecha_pedido, INTERVAL 13 DAY) AS envasado, 
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

        $sql = "SELECT referencia FROM producto 
                WHERE multi = (SELECT multi FROM producto WHERE referencia = :referencia) 
                AND presentacion_comercial = 1;";
        $query = $connection->prepare($sql);
        $query->execute(['referencia' => $reference]);
        $granel = $query->fetchAll($connection::FETCH_ASSOC);
        return $granel;
    }

    public function findOrders($order)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT * FROM explosion_materiales_pedidos_registro WHERE pedido = :pedido;";
        $query = $connection->prepare($sql);
        $query->execute(['pedido' => $order]);
        $result = $query->fetch($connection::FETCH_ASSOC);
        return $result;
    }

    public function savePedidos($dataPedidos)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT * FROM explosion_materiales_pedidos_registro 
                WHERE pedido = :pedido AND id_producto = :id_producto";
        $query = $connection->prepare($sql);
        $query->execute([
            'pedido' => trim($dataPedidos['documento']),
            'id_producto' => trim($dataPedidos['referencia'])
        ]);
        $rows = $query->rowCount();

        if ($rows > 0) {
            $sql = "UPDATE explosion_materiales_pedidos_registro SET cantidad = :cantidad 
                    WHERE pedido = :pedido AND id_producto = :id_producto";
            $query = $connection->prepare($sql);
            $query->execute([
                'cantidad' => trim($dataPedidos['cantidad']),
                'pedido' => trim($dataPedidos['documento']),
                'id_producto' => trim($dataPedidos['referencia'])
            ]);
        } else {

            $date = date_create($dataPedidos['fecha_dcto']);
            date_time_set($date, 13, 24);
            $fecha_dtco = date_format($date, "Y-m-d");

            $sql = "INSERT INTO explosion_materiales_pedidos_registro (pedido, id_producto, cant_original, cantidad, fecha_pedido) 
                    VALUES(:pedido, :id_producto, :cant_original, :cantidad, :fecha_pedido)";
            $query = $connection->prepare($sql);
            $query->execute([
                'pedido' => trim($dataPedidos['documento']),
                'id_producto' => trim("M-" . $dataPedidos['producto']),
                'cant_original' => trim($dataPedidos['cant_original']),
                'cantidad' => trim($dataPedidos['cantidad']),
                'fecha_pedido' => $fecha_dtco,
            ]);
        }
    }
}
