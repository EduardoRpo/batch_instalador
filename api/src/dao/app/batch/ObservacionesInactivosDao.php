<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ObservacionesInactivosDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findObservacionByBacth($dataBatch)
    {
        $connection = Connection::getInstance()->getconnection();

        $stmt = $connection->prepare("SELECT exp.pedido, b.id_batch, p.referencia, p.nombre_referencia, obi.observacion, obi.fecha_registro 
                                      FROM batch b 
                                      INNER JOIN observaciones_batch_inactivos obi ON obi.batch = b.id_batch 
                                      INNER JOIN producto p ON b.id_producto = p.referencia 
                                      INNER JOIN explosion_materiales_pedidos_registro exp ON exp.id_producto = p.referencia 
                                    WHERE b.id_batch = :id_batch AND exp.pedido = :pedido;");
        $stmt->execute([
            'id_batch' => $dataBatch['batch'],
            'pedido' => $dataBatch['numPedido']
        ]);
        $observaciones = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $observaciones;
    }
}
