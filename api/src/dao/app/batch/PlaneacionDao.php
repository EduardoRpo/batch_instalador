<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class PlaneacionDao

{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllBatchPlaneados()
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT pre_plan.id, pp.nombre AS propietario, pre_plan.pedido, pre_plan.unidad_lote, pre_plan.valor_pedido, pre_plan.fecha_programacion, pre_plan.tamano_lote, CURRENT_DATE AS fecha_actual, 
                                                (SELECT referencia FROM producto WHERE multi = (SELECT multi FROM producto WHERE referencia = pre_plan.id_producto) LIMIT 1) AS granel, pre_plan.id_producto, pre_plan.fecha_insumo,
                                                DATE_ADD(pre_plan.fecha_insumo, INTERVAL 8 DAY) AS fecha_pesaje, DATE_ADD(pre_plan.fecha_insumo, INTERVAL 13 DAY) AS fecha_envasado, p.nombre_referencia, pre_plan.sim, 
                                                WEEK(pre_plan.fecha_programacion) AS semana, IF(pre_plan.estado = 0, 'Sin Formula y/o Instructivos', 'Inactivo') AS estado, pre_plan.planeado, l.id AS id_linea, l.ajuste
                                        FROM plan_preplaneados pre_plan 
                                            INNER JOIN producto p ON p.referencia = pre_plan.id_producto
                                            INNER JOIN linea l ON p.id_linea = l.id 
                                            INNER JOIN propietario pp ON pp.id = p.id_propietario 
                                        WHERE pre_plan.planeado = 1
                                        ORDER BY `propietario`, `semana` ASC;");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $batch = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Batch Obtenidos", array('batch' => $batch));
        return $batch;
    }

    public function setDataPedidos($dataPedidos)
    {
        // Consolidar referencias
        $dataPedidosReferencias = array();

        foreach ($dataPedidos as $t) {
            $repeat = false;
            for ($i = 0; $i < count($dataPedidosReferencias); $i++) {
                if ($dataPedidosReferencias[$i]['referencia'] == $t['referencia']) {
                    $dataPedidosReferencias[$i]['id'] = "{$dataPedidosReferencias[$i]['id']} - {$t['id']}";
                    $dataPedidosReferencias[$i]['numPedido'] = "{$dataPedidosReferencias[$i]['numPedido']} - {$t['numPedido']}";
                    $dataPedidosReferencias[$i]['tamanio_lote'] += $t['tamanio_lote'];
                    $dataPedidosReferencias[$i]['cantidad_acumulada'] += $t['cantidad_acumulada'];
                    $dataPedidosReferencias[$i]['fecha_insumo'] = "{$dataPedidosReferencias[$i]['fecha_insumo']} - {$t['fecha_insumo']}";
                    $repeat = true;
                    break;
                }
            }
            if ($repeat == false)
                $dataPedidosReferencias[] = array(
                    'id' => $t['id'],
                    'granel' => $t['granel'],
                    'numPedido' => $t['numPedido'],
                    'referencia' => $t['referencia'],
                    'producto' => $t['producto'],
                    'tamanio_lote' => $t['tamanio_lote'],
                    'fecha_planeacion' => $t['fecha_planeacion'],
                    'cantidad_acumulada' => $t['cantidad_acumulada'],
                    'fecha_insumo' => $t['fecha_insumo'],
                );
        }

        // Consolidad graneles
        $dataPedidosGranel = array();

        foreach ($dataPedidosReferencias as $t) {
            $repeat = false;
            for ($i = 0; $i < count($dataPedidosGranel); $i++) {
                if ($dataPedidosGranel[$i]['granel'] == $t['granel']) {
                    $dataPedidosGranel[$i]['cantidad_acumulada'] += $t['cantidad_acumulada'];
                    $dataPedidosGranel[$i]['tamanio_lote'] += $t['tamanio_lote'];
                    $repeat = true;
                    break;
                }
            }
            if ($repeat == false)
                $dataPedidosGranel[] = array(
                    'granel' => $t['granel'],
                    'producto' => $t['producto'],
                    'cantidad_acumulada' => $t['cantidad_acumulada'],
                    'tamanio_lote' => $t['tamanio_lote'],
                    'fecha_planeacion' => $t['fecha_planeacion']
                );
        }

        for ($i = 0; $i < sizeof($dataPedidosGranel); $i++) {
            for ($j = 0; $j < sizeof($dataPedidosReferencias); $j++)
                if ($dataPedidosGranel[$i]['granel'] == $dataPedidosReferencias[$j]['granel'])
                    //Adiciona la multipresentacion al Granel
                    $dataPedidosGranel[$i]['multi'][$j] = $dataPedidosReferencias[$j];
            // Restablecer llaves de variable $dataPedidosGranel
            $dataPedidosGranel[$i]['multi'] = array_values($dataPedidosGranel[$i]['multi']);
        }

        return $dataPedidosGranel;
    }
}
