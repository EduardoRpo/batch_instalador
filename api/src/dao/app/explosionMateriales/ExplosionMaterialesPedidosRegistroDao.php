<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ExplosionMaterialesPedidosRegistroDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function updateEMPedidosRegistro()
    {
        $connection = Connection::getInstance()->getConnection();
        $dataPedidos = $_SESSION['dataPedidos'];

        foreach ($dataPedidos as $dataPedido) {
            $stmt = $connection->prepare("UPDATE explosion_materiales_pedidos_registro 
                                          SET cantidad_acumulada = cantidad_acumulada + :cantidad_acumulada, fecha_insumo = :fecha_insumo, estado = 1 
                                          WHERE pedido = :pedido AND id_producto = :referencia");
            $stmt->execute([
                'pedido' => $dataPedido['numPedido'],
                'referencia' => $dataPedido['referencia'],
                'cantidad_acumulada' => $dataPedido['cantidad_acumulada'],
                'fecha_insumo' => $dataPedido['fecha_insumo']
            ]);
        }

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateEstado($dataPedido)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE explosion_materiales_pedidos_registro 
                                      SET estado = 2
                                      WHERE pedido = :pedido AND id_producto = :referencia");
        $stmt->execute([
            'pedido' => $dataPedido['pedido'],
            'referencia' => $dataPedido['referencia']
        ]);

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
