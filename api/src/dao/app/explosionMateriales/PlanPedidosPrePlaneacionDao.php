<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class PlanPedidosPrePlaneacionDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findPrePlaneacion()
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT pp.nombre AS propietario, preplan.pedido, preplan.estado, CURRENT_DATE AS fecha_actual, (SELECT referencia FROM producto 
                WHERE multi = (SELECT multi FROM producto WHERE referencia = preplan.id_producto) LIMIT 1) AS granel, preplan.id_producto, p.nombre_referencia, (SELECT COUNT(*) FROM observaciones_batch_inactivos WHERE pedido = exp.pedido AND referencia = exp.id_producto) AS cant_observations
                FROM plan_pedidos_pre_planeacion preplan 
                    INNER JOIN producto p ON p.referencia = preplan.id_producto 
                    INNER JOIN propietario pp ON pp.id = p.id_propietario
                    LEFT JOIN observaciones_batch_inactivos obi ON obi.pedido = preplan.pedido AND obi.referencia = preplan.id_producto
                    WHERE flag_estado = 1
                    ORDER BY estado DESC;";

        $query = $connection->prepare($sql);
        $query->execute();
        $prePlaneacion = $query->fetchAll($connection::FETCH_ASSOC);
        return $prePlaneacion;
    }
}
