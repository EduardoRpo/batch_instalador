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
        // Consolidar por referencia Y granel (mantener separados productos con referencias diferentes)
        $dataPedidosGranel = array();

        foreach ($dataPedidos as $t) {
            $repeat = false;
            for ($i = 0; $i < count($dataPedidosGranel); $i++) {
                // Solo unificar si tienen la MISMA referencia Y el MISMO granel
                if (($dataPedidosGranel[$i]['referencia'] ?? null) == ($t['referencia'] ?? null) && 
                    ($dataPedidosGranel[$i]['granel'] ?? null) == ($t['granel'] ?? null)) {
                    $dataPedidosGranel[$i]['id'] = "{$dataPedidosGranel[$i]['id']} - {$t['id']}";
                    $dataPedidosGranel[$i]['numPedido'] = "{$dataPedidosGranel[$i]['numPedido']} - {$t['numPedido']}";
                    $dataPedidosGranel[$i]['tamanio_lote'] += ($t['tamanio_lote'] ?? 0);
                    $dataPedidosGranel[$i]['cantidad_acumulada'] += ($t['cantidad_acumulada'] ?? 0);
                    $dataPedidosGranel[$i]['fecha_insumo'] = "{$dataPedidosGranel[$i]['fecha_insumo']} - {$t['fecha_insumo']}";
                    $repeat = true;
                    break;
                }
            }
            if ($repeat == false)
                $dataPedidosGranel[] = array(
                    'id' => $t['id'] ?? null,
                    'granel' => $t['granel'] ?? null,
                    'numPedido' => $t['numPedido'] ?? null,
                    'referencia' => $t['referencia'] ?? null,
                    'producto' => $t['producto'] ?? null,
                    'tamanio_lote' => $t['tamanio_lote'] ?? 0,
                    'ajuste' => $t['ajuste'] ?? null,
                    'fecha_planeacion' => $t['fecha_planeacion'] ?? null,
                    'cantidad_acumulada' => $t['cantidad_acumulada'] ?? 0,
                    'fecha_insumo' => $t['fecha_insumo'] ?? null,
                );
        }

        for ($i = 0; $i < sizeof($dataPedidosGranel); $i++) {
            // Buscar la multipresentación para este granel y referencia específica
            $connection = Connection::getInstance()->getConnection();
            $stmt = $connection->prepare("SELECT mul.referencia, mul.cantidad, mul.total, p.nombre_referencia 
                                        FROM multipresentacion mul 
                                        INNER JOIN producto p ON mul.referencia = p.referencia 
                                        WHERE mul.id_batch = :id_batch AND mul.referencia = :referencia");
            $stmt->execute([
                'id_batch' => $dataPedidosGranel[$i]['id'],
                'referencia' => $dataPedidosGranel[$i]['referencia']
            ]);
            $multipresentacion = $stmt->fetchAll($connection::FETCH_ASSOC);
            
            if (!empty($multipresentacion)) {
                $dataPedidosGranel[$i]['multipresentacion'] = $multipresentacion;
            }
        }

        return $dataPedidosGranel;
    }
}
