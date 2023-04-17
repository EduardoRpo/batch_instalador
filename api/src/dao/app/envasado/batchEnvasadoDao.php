<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class batchEnvasadoDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }


    public function findBatchEnvasadoxDate($date1, $date2)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "SELECT DISTINCT batch.programacion_envasado, batch.id_batch, multi.referencia as referencia_comercial, multi.cantidad, batch.ok_aprobado
                FROM batch
                INNER JOIN producto p ON p.referencia = batch.id_producto
                INNER JOIN multipresentacion multi ON multi.id_batch = batch.id_batch
                INNER JOIN batch_control_firmas bcf ON batch.id_batch = bcf.batch
                WHERE batch.estado > 2 AND batch.estado < 8 AND bcf.modulo = 5 AND batch.id_batch NOT IN(SELECT batch FROM `batch_control_firmas` WHERE modulo = 5 AND cantidad_firmas = total_firmas) 
                AND programacion_envasado BETWEEN :startDate AND :endDate
                ORDER BY `batch`.`programacion_envasado` ASC;";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'startDate' => $date1,
            'endDate' => $date2
        ]);

        $envasado = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $envasado;
    }
}
