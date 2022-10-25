<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class PlanPedidosDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function checkTamanioLote($dataPedidos)
    {
        // Eliminar granel donde tamanio_lote sea mayor a 2500
        for ($i = 0; $i < sizeof($dataPedidos); $i++) {
            if ($dataPedidos[$i]['tamanio_lote'] > 2500) {
                $this->checkPedidos($dataPedidos[$i]); // Cambiar estado a 2
                // Capturar data de lotes programados, para mostrar en la ventana de calculo
                $dataPedidosLotes[$i] = $dataPedidos[$i];
                unset($dataPedidos[$i]);
            }
        }

        if (!isset($dataPedidosLotes))
            $dataPedidosLotes = $dataPedidos;

        return $dataPedidosLotes;
    }

    public function resetEstadoColorProgramacion()
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("UPDATE plan_pedidos SET estado = 0
                                      WHERE estado >= 1 AND fecha_actual < CURRENT_DATE()");
        $stmt->execute();
    }

    public function updateEMPedidosRegistro()
    {
        $connection = Connection::getInstance()->getConnection();
        $dataPedidos = $_SESSION['dataPedidos'];
        $fecha_actual = date("Y-m-d");

        foreach ($dataPedidos as $dataPedido) {
            $stmt = $connection->prepare("UPDATE plan_pedidos 
                                          SET cantidad_acumulada = cantidad_acumulada + :cantidad_acumulada, fecha_insumo = :fecha_insumo, fecha_actual = :fecha_actual, estado = 1 
                                          WHERE pedido = :pedido AND id_producto = :referencia");
            $stmt->execute([
                'pedido' => $dataPedido['numPedido'],
                'referencia' => $dataPedido['referencia'],
                'cantidad_acumulada' => $dataPedido['cantidad_acumulada'],
                'fecha_insumo' => $dataPedido['fecha_insumo'],
                'fecha_actual' => $fecha_actual
            ]);
        }

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function checkPedidos($dataPedido)
    {
        $pedido = $dataPedido['numPedido'];
        //Condicional si tiene mas de un pedido
        if (strpos($pedido, '-')) {
            $pedido = explode(" - ", $pedido);
            foreach ($pedido as $p) {
                $this->updateEstado($dataPedido, $p);
            }
        } else {
            $this->updateEstado($dataPedido, $pedido);
        }
    }

    public function updateEstado($dataPedido, $pedido)
    {
        $connection = Connection::getInstance()->getConnection();

        $fecha_actual = date("Y-m-d");

        $stmt = $connection->prepare("UPDATE plan_pedidos 
                                      SET estado = 2, fecha_actual = :fecha_actual
                                      WHERE pedido = :pedido AND id_producto = :referencia");
        $stmt->execute([
            'fecha_actual' => $fecha_actual,
            'pedido' => $pedido,
            'referencia' => $dataPedido['referencia']
        ]);

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
