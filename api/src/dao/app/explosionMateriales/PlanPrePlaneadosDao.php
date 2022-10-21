<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class PlanPrePlaneadosDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllPrePlaneados()
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT pp.nombre AS propietario, pre_plan.pedido, pre_plan.unidad_lote, pre_plan.fecha_programacion, CURRENT_DATE AS fecha_actual, (SELECT referencia FROM producto WHERE multi = (SELECT multi FROM producto WHERE referencia = pre_plan.id_producto) LIMIT 1) AS granel,
                       pre_plan.id_producto, p.nombre_referencia, (SELECT COUNT(*) FROM observaciones_batch_inactivos WHERE pedido = pre_plan.pedido AND referencia = pre_plan.id_producto) AS cant_observations, pre_plan.sim
                FROM plan_preplaneados pre_plan 
                    INNER JOIN producto p ON p.referencia = pre_plan.id_producto 
                    INNER JOIN propietario pp ON pp.id = p.id_propietario
                    LEFT JOIN observaciones_batch_inactivos obi ON obi.pedido = pre_plan.pedido AND obi.referencia = pre_plan.id_producto";

        $query = $connection->prepare($sql);
        $query->execute();
        $prePlaneacion = $query->fetchAll($connection::FETCH_ASSOC);
        return $prePlaneacion;
    }

    public function findCountPrePlaneados()
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT COUNT(id) AS count FROM plan_preplaneados WHERE fecha_registro = CURRENT_DATE");
        $stmt->execute();
        $countPrePlaneados = $stmt->fetch($connection::FETCH_ASSOC);
        return $countPrePlaneados;
    }

    public function insertPrePlaneados($dataPedidos, $multi)
    {
        $connection = Connection::getInstance()->getConnection();

        try {

            for ($i = 0; $i < sizeof($multi); $i++) {
                $stmt = $connection->prepare("INSERT INTO plan_preplaneados (pedido, fecha_programacion, tamano_lote, unidad_lote, id_producto, sim)
                                          VALUES (:pedido, :fecha_programacion, :tamano_lote, :unidad_lote, :id_producto, :sim)");

                $stmt->execute([
                    'pedido' => $multi[$i]['numPedido'],
                    'fecha_programacion' => $dataPedidos['programacion'],
                    'tamano_lote' => $multi[$i]['tamanio_lote'],
                    'unidad_lote' => $multi[$i]['cantidad_acumulada'],
                    'id_producto' => $multi[$i]['referencia'],
                    'sim' => $dataPedidos['simulacion']
                ]);
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('info' => true, 'mesage' => $message);
            return $error;
        }
    }
}
