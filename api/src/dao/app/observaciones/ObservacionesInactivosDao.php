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

    public function findObservaciones($dataBatch)
    {
        $connection = Connection::getInstance()->getconnection();

        if ($dataBatch['pedido']) {
            $condition = "WHERE pedido = :pedido AND referencia = :referencia";
            $execute = [
                'pedido' => $dataBatch['pedido'],
                'referencia' => $dataBatch['ref']
            ];
        }
        if ($dataBatch['batch']) {
            $condition = "WHERE batch = :batch";
            $execute = [
                'batch' => $dataBatch['batch']
            ];
        }

        $stmt = $connection->prepare("SELECT * FROM observaciones_batch_inactivos
                                      {$condition}");
        $stmt->execute($execute);
        $observaciones = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $observaciones;
    }

    public function insertObservacion($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $fecha_hoy = date('Y-m-d');

        if ($dataBatch['pedido']) {
            $sql = "INSERT INTO observaciones_batch_inactivos (observacion, pedido, referencia, fecha_registro)
            VALUES (:observacion, :pedido, :referencia, :fecha_registro)";
            $execute = [
                'observacion' => $dataBatch['comment'],
                'pedido' => $dataBatch['pedido'],
                'referencia' => $dataBatch['ref'],
                'fecha_registro' => $fecha_hoy
            ];
        } else {
            $sql = "INSERT INTO observaciones_batch_inactivos (observacion, batch, fecha_registro)
            VALUES (:observacion, :batch, :fecha_registro)";
            $execute = [
                'observacion' => $dataBatch['comment'],
                'batch' => $dataBatch['batch'],
                'fecha_registro' => $fecha_hoy
            ];
        }

        $stmt = $connection->prepare($sql);
        $stmt->execute($execute);
    }

    public function updateObservacion($id_batch, $dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("UPDATE observaciones_batch_inactivos SET batch = :batch
                                      WHERE pedido = :pedido AND referencia = :referencia");
        $stmt->execute([
            'batch' => $id_batch,
            'pedido' => $dataBatch['numPedido'],
            'referencia' => $dataBatch['referencia']
        ]);
    }
}
