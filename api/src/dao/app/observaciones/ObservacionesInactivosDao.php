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

    public function findAllObservaciones()
    {
        $connection = Connection::getInstance()->getconnection();

        $stmt = $connection->prepare("SELECT exp.pedido, b.id_batch, p.referencia, p.nombre_referencia, obi.observacion, obi.fecha_registro 
                                      FROM batch b 
                                      INNER JOIN observaciones_batch_inactivos obi ON obi.batch = b.id_batch 
                                      INNER JOIN producto p ON p.referencia = obi.referencia
                                      INNER JOIN explosion_materiales_pedidos_registro exp ON exp.id_producto = p.referencia");
        $stmt->execute();
        $observaciones = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $observaciones;
    }

    public function insertObservacion($id_batch)
    {
        $connection = Connection::getInstance()->getConnection();
        $dataPedidos = $_SESSION['dataPedidos'];

        foreach ($dataPedidos as $dataPedido) {
            $stmt = $connection->prepare("INSERT INTO observaciones_batch_inactivos (pedido, batch, referencia)
                                      VALUES (:pedido, :batch, :referencia)");
            $stmt->execute([
                'pedido' => $dataPedido['numPedido'],
                'batch' => $id_batch,
                'referencia' => $dataPedido['referencia']
            ]);
        }
    }

    public function updateObservacion($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $fechahoy = date("Y-m-d");

        $stmt = $connection->prepare("UPDATE observaciones_batch_inactivos SET observacion = :observacion, fecha_registro = :fecha_registro
                                      WHERE batch = :batch");
        $stmt->execute([
            'batch' => $dataBatch['batch'],
            'observacion' => $dataBatch['comment'],
            'fecha_registro' => $fechahoy
        ]);
    }
}
