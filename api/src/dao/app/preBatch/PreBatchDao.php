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

    public function findAllOrders()
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT CONCAT(pedido, id_producto) AS concate FROM `plan_pedidos`;";
        $query = $connection->prepare($sql);
        $query->execute();
        $preBatch = $query->fetchAll($connection::FETCH_ASSOC);
        return $preBatch;
    }

    public function findAllPreBatch()
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT DISTINCT ROW_NUMBER() OVER (ORDER BY pp.nombre) AS num, pp.nombre AS propietario, exp.pedido, exp.fecha_pedido, exp.estado, exp.cantidad_acumulada, exp.fecha_insumo, CURRENT_DATE AS fecha_actual, (SELECT referencia FROM producto 
                    WHERE multi = (SELECT multi FROM producto WHERE referencia = exp.id_producto)
                    LIMIT 1) AS granel, exp.id_producto, p.nombre_referencia, exp.cant_original, exp.cantidad, exp.valor_pedido, 
                        IFNULL(DATE_ADD(exp.fecha_insumo, INTERVAL 8 DAY),DATE_ADD(exp.fecha_pedido, INTERVAL 8 DAY)) AS fecha_pesaje, 						
                        IFNULL(DATE_ADD(exp.fecha_insumo, INTERVAL 9 DAY),DATE_ADD(exp.fecha_pedido, INTERVAL 9 DAY)) AS fecha_preparacion,
                        IFNULL(DATE_ADD(exp.fecha_insumo, INTERVAL 13 DAY),DATE_ADD(exp.fecha_pedido, INTERVAL 13 DAY)) AS envasado, 
                        IFNULL(DATE_ADD(exp.fecha_insumo, INTERVAL 15 DAY),DATE_ADD(exp.fecha_pedido, INTERVAL 15 DAY)) AS entrega , 
                        (SELECT COUNT(*) FROM observaciones_batch_inactivos WHERE pedido = exp.pedido AND referencia = exp.id_producto) AS cant_observations, (SELECT GROUP_CONCAT(sim SEPARATOR ', ') FROM `plan_preplaneados` WHERE pedido = exp.pedido AND id_producto = exp.id_producto) AS simulacion
                    FROM `plan_pedidos` exp 
                        INNER JOIN producto p ON p.referencia = exp.id_producto 
                        INNER JOIN propietario pp ON pp.id = p.id_propietario
                        LEFT JOIN observaciones_batch_inactivos obi ON obi.pedido = exp.pedido AND obi.referencia = exp.id_producto
                        WHERE flag_estado = 1
                        ORDER BY estado DESC;
        "; //WHERE exp.flag_estado = 0

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

        $sql = "SELECT * FROM plan_pedidos WHERE pedido = :pedido;";
        $query = $connection->prepare($sql);
        $query->execute(['pedido' => $order]);
        $result = $query->fetch($connection::FETCH_ASSOC);
        return $result;
    }

    public function findImportOrders()
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT IF(importado = '0000-00-00 00:00:00', null, DATE_FORMAT(importado, '%d/%m/%Y')) AS fecha_importe, 
                       IF(importado = '0000-00-00 00:00:00', null, TIME_FORMAT(importado, '%h:%i %p')) AS hora_importe
                FROM plan_pedidos ORDER BY `plan_pedidos`.`importado` DESC";
        $query = $connection->prepare($sql);
        $query->execute();
        $result = $query->fetch($connection::FETCH_ASSOC);
        return $result;
    }

    public function savePedidos($dataPedidos)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT * FROM plan_pedidos 
                WHERE pedido = :pedido AND id_producto = :id_producto";
        $query = $connection->prepare($sql);
        $query->execute([
            'pedido' => trim($dataPedidos['documento']),
            'id_producto' => trim("M-" . $dataPedidos['producto'])
        ]);
        $rows = $query->rowCount();

        if ($rows > 0) {
            $sql = "UPDATE plan_pedidos SET cantidad = :cantidad, valor_pedido = :valor_pedido 
                    WHERE pedido = :pedido AND id_producto = :id_producto";
            $query = $connection->prepare($sql);
            $query->execute([
                'cantidad' => trim($dataPedidos['cantidad']),
                'valor_pedido' => trim($dataPedidos['valor_pedido']),
                'pedido' => trim($dataPedidos['documento']),
                'id_producto' =>  trim("M-" . $dataPedidos['producto'])
            ]);
        } else {
            $date = date_create($dataPedidos['fecha_dcto']);
            date_time_set($date, 13, 24);
            $fecha_dtco = date_format($date, "Y-m-d");
            // $fecha_dtco = date_format($dataPedidos['fecha_dcto'], 'Y-m-d');

            $sql = "INSERT INTO plan_pedidos (pedido, id_producto, cant_original, cantidad, valor_pedido, fecha_pedido) 
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

    //Validar tabla pedidos y cambiar flag
    public function changeFlagEstadoByPedido($pedido, $producto)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("UPDATE plan_pedidos 
                                      SET flag_estado = 0 
                                      WHERE pedido = :pedido AND id_producto = :id_producto");
        $stmt->execute(['pedido' => $pedido, 'id_producto' => $producto]);
    }

    public function convertData($dataPedidos)
    {
        $data = array();
        $data['cliente'] = str_replace(',', '', $dataPedidos['cliente']);
        $data['documento'] = str_replace(',', '', $dataPedidos['documento']);
        $data['producto'] = str_replace(',', '', $dataPedidos['producto']);
        $data['cant_original'] = str_replace(',', '', $dataPedidos['cant_original']);
        $data['cantidad'] = str_replace(',', '', $dataPedidos['cantidad']);
        $data['valor_pedido'] = str_replace(',', '', $dataPedidos['valor_pedido']);

        return $data;
    }
}
