<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class PlanPrePlaneadosDao extends estadoInicialDao
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

        $sql = "SELECT pre_plan.id, pp.nombre AS propietario, pre_plan.pedido, pre_plan.unidad_lote, pre_plan.valor_pedido, pre_plan.fecha_programacion, pre_plan.tamano_lote, l.id AS id_linea, l.densidad, l.ajuste, pc.nombre as presentacion, CURRENT_DATE AS fecha_actual, (SELECT referencia FROM producto WHERE multi = (SELECT multi FROM producto WHERE referencia = pre_plan.id_producto) LIMIT 1) AS granel,
                        pre_plan.id_producto, p.nombre_referencia, pre_plan.sim, WEEK(pre_plan.fecha_programacion) AS semana, IF(pre_plan.estado = 0, 'Sin Formula y/o Instructivos', 'Inactivo') AS estado, pre_plan.planeado
                FROM plan_preplaneados pre_plan 
                    INNER JOIN producto p ON p.referencia = pre_plan.id_producto 
                    INNER JOIN propietario pp ON pp.id = p.id_propietario
                    INNER JOIN linea l ON p.id_linea = l.id 
                    INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id 
                    WHERE pre_plan.planeado = 0 AND WEEK(pre_plan.fecha_programacion) >= WEEK(NOW())
                   -- ORDER BY `propietario`, `semana` ASC
                    ";

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

    /* Validar cantidad de formulas y instructivos */
    public function checkFormulasAndInstructivos($granel)
    {
        $formulas = $this->findCountFormula($granel);
        $instructivos = $this->findCountInstructivo($granel);
        $result = $formulas * $instructivos;
        $result == 0 ? $estado = 0 : $estado = 1;
        return $estado;
    }

    public function insertPrePlaneados($dataPedidos)
    {
        $connection = Connection::getInstance()->getConnection();

        try {

            $estado = $this->checkFormulasAndInstructivos($dataPedidos['granel']);

            $stmt = $connection->prepare("INSERT INTO plan_preplaneados (pedido, fecha_programacion, tamano_lote, unidad_lote, valor_pedido, id_producto, estado, fecha_insumo, sim)
                                          VALUES (:pedido, :fecha_programacion, :tamano_lote, :unidad_lote, :valor_pedido, :id_producto, :estado, :fecha_insumo, :sim)");


            $stmt->execute([
                'pedido' => $dataPedidos['numPedido'],
                'fecha_programacion' => $dataPedidos['programacion'],
                'tamano_lote' => $dataPedidos['tamanio_lote'],
                'unidad_lote' => $dataPedidos['cantidad_acumulada'],
                'valor_pedido' => $dataPedidos['valor_pedido'],
                'id_producto' => $dataPedidos['referencia'],
                'fecha_insumo' => $dataPedidos['fecha_insumo'],
                'estado' => $estado,
                'sim' => $dataPedidos['simulacion']
            ]);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('info' => true, 'mesage' => $message);
            return $error;
        }
    }

    public function updateEstadoPreplaneado($id_producto, $estado)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("UPDATE plan_preplaneados SET estado = :estado WHERE id_producto = :id_producto");
        $stmt->execute([
            'id_producto' => $id_producto,
            'estado' => $estado
        ]);
    }

    public function updatePlaneado($dataPedidos)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("UPDATE plan_preplaneados SET planeado = :planeado WHERE id = :id");
        $stmt->execute([
            'id' => $dataPedidos['id'],
            'planeado' => 1
        ]);
    }

    public function updateUnidadLote($dataPedidos, $tamano_lote)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("UPDATE plan_preplaneados SET unidad_lote = :unidad_lote, tamano_lote = :tamano_lote
                                      WHERE id = :id");
        $stmt->execute([
            'id' => $dataPedidos['id'],
            'tamano_lote' => $tamano_lote,
            'unidad_lote' => $dataPedidos['unidad']
        ]);
    }

    public function clearPlanPrePlaneados($simulacion)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("DELETE FROM plan_preplaneados WHERE sim = :simulacion AND planeado = 0");
        $stmt->execute(['simulacion' => $simulacion]);
    }

    public function deletePlaneado($id)
    {
        $connection = Connection::getInstance()->getConnection();

        if (str_contains($id, '-')) {
            $id = explode(" - ", $id);
            foreach ($id as $p) {
                $stmt = $connection->prepare("DELETE FROM plan_preplaneados WHERE id = :id");
                $stmt->execute(['id' => $p]);
            }
        } else {
            $stmt = $connection->prepare("DELETE FROM plan_preplaneados WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }
    }
}
