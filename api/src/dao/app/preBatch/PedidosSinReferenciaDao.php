<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class PedidosSinReferenciaDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllPedidoSinReferencia()
    {
        $connection = Connection::getInstance()->getConnection();

        $query = $connection->prepare("SELECT pedido AS documento, id_producto AS producto FROM plan_pedidos_sin_referencia");
        $query->execute();

        $pedidosSinReferencia = $query->fetchAll($connection::FETCH_ASSOC);
        return $pedidosSinReferencia;
    }

    public function findPedidoSinReferencia($dataPedidos)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT * FROM plan_pedidos_sin_referencia 
                WHERE pedido = :pedido AND id_producto = :id_producto";
        $query = $connection->prepare($sql);
        $query->execute([
            'pedido' => trim($dataPedidos['documento']),
            'id_producto' => trim("M-" . $dataPedidos['producto'])
        ]);

        $pedidoSinReferencia = $query->fetch($connection::FETCH_ASSOC);
        return $pedidoSinReferencia;
    }

    public function savePedidosSinReferencia($dataPedidos)
    {
        $connection = Connection::getInstance()->getConnection();

        $pedidosSinReferencia = $this->findPedidoSinReferencia($dataPedidos);

        if ($pedidosSinReferencia) {
            $fecha_actual = date('Y-m-d');

            $sql = "UPDATE plan_pedidos_sin_referencia SET cantidad = :cantidad, valor_pedido = :valor_pedido, fecha_actual = :fecha_actual
                    WHERE pedido = :pedido AND id_producto = :id_producto";
            $query = $connection->prepare($sql);
            $query->execute([
                'cantidad' => trim($dataPedidos['cantidad']),
                'valor_pedido' => trim($dataPedidos['valor_pedido']),
                'fecha_actual' => $fecha_actual,
                'pedido' => trim($dataPedidos['documento']),
                'id_producto' =>  trim("M-" . $dataPedidos['producto'])
            ]);
        } else {
            $date = date_create($dataPedidos['fecha_dcto']);
            if ($date) {
                date_time_set($date, 13, 24);
                $fecha_dtco = date_format($date, "Y-m-d");
            } else
                $fecha_dtco = '';



            $sql = "INSERT INTO plan_pedidos_sin_referencia (pedido, id_producto, cant_original, cantidad, valor_pedido, fecha_pedido) 
                    VALUES(:pedido, :id_producto, :cant_original, :cantidad, :valor_pedido, :fecha_pedido)";
            $query = $connection->prepare($sql);
            $query->execute([
                'pedido' => trim($dataPedidos['documento']),
                'id_producto' =>  trim("M-" . $dataPedidos['producto']),
                'cant_original' => trim($dataPedidos['cant_original']),
                'cantidad' => trim($dataPedidos['cantidad']),
                'valor_pedido' => trim($dataPedidos['valor_pedido']),
                'fecha_pedido' => $fecha_dtco
            ]);
        }
    }



    public function deletePedidosSinReferencia($dataPedidos)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("DELETE FROM plan_pedidos_sin_referencia WHERE pedido = :pedido AND id_producto = :id_producto");
        $stmt->execute([
            'pedido' => trim($dataPedidos['documento']),
            'id_producto' => trim("M-" . $dataPedidos['producto'])
        ]);
    }
}
