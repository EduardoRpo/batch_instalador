<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ProgramacionEnvasadoDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findSumCapacidadEnvasado()
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM capacidad_envasado_sum");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

        $envasado = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $envasado;
    }

    public function updateCapacidadEnvasado($dataEnvasado)
    {
        $connection = Connection::getInstance()->getConnection();

        if (str_contains($dataEnvasado['no_lote'], 'LQ'))
            $col = 'total_liquido';
        else if (str_contains($dataEnvasado['no_lote'], 'SM'))
            $col = 'total_semi_solido';
        else if (str_contains($dataEnvasado['no_lote'], 'SL'))
            $col = 'total_solido';

        $tamanoLote = str_replace('.', '', $dataEnvasado['tamano_lote']);

        $stmt = $connection->prepare("UPDATE capacidad_envasado_sum SET {$col} = ${col}+ :col
                                      WHERE semana = :semana");
        $stmt->execute([
            'col' => $tamanoLote,
            'semana' => $dataEnvasado['semana']
        ]);
    }

    /* Programacion envasado */
    public function updateFechaEnvasado($dataEnvasado)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("UPDATE batch SET programacion_envasado = :programacion_envasado WHERE id_batch = :id_batch");
        $stmt->execute([
            'id_batch' => $dataEnvasado['idBatch'],
            'programacion_envasado' => $dataEnvasado['fechaEnvasado']
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function findAverageCapacidadEnvasado()
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT se.semana, (SELECT IF(se.total_liquido > turno_1, 100, CAST((se.total_liquido / turno_1)*100 AS DECIMAL(4,2))) FROM capacidad_envasado WHERE id_linea = 1 AND semana = se.semana) AS plan_liquido_1, 
                                                (SELECT IF(IF(se.total_liquido - turno_1 < 0, 0, se.total_liquido - turno_1) > turno_2, 100, CAST((IF(se.total_liquido - turno_1 < 0, 0, se.total_liquido - turno_1)) / turno_2 * 100 AS DECIMAL(4,2))) FROM capacidad_envasado WHERE id_linea = 1 AND semana = se.semana) AS plan_liquido_2, 
                                                (SELECT CAST(IF(se.total_liquido - turno_1 - turno_2 < 0, 0, se.total_liquido - turno_1 - turno_2) / turno_3 * 100 AS  DECIMAL(4,2)) FROM capacidad_envasado WHERE id_linea = 1 AND semana = se.semana) AS plan_liquido_3, se.total_liquido,
                                                (SELECT IF(se.total_semi_solido > turno_1, 100, CAST((se.total_semi_solido / turno_1)*100 AS  DECIMAL(4,2))) FROM capacidad_envasado WHERE id_linea = 2 AND semana = se.semana) AS plan_semi_solido_1, 
                                                (SELECT IF(IF(se.total_semi_solido - turno_1 < 0, 0, se.total_semi_solido - turno_1) > turno_2, 100, CAST((IF(se.total_semi_solido - turno_1 < 0, 0, se.total_semi_solido - turno_1)) / turno_2 * 100 AS  DECIMAL(4,2))) FROM capacidad_envasado WHERE id_linea = 2 AND semana = se.semana) AS plan_semi_solido_2, 
                                                (SELECT CAST(IF(se.total_semi_solido - turno_1 - turno_2 < 0, 0, se.total_semi_solido - turno_1 - turno_2) / turno_3 * 100 AS  DECIMAL(4,2)) FROM capacidad_envasado WHERE id_linea = 2 AND semana = se.semana) AS plan_semi_solido_3, se.total_semi_solido,
                                                (SELECT IF(se.total_solido > turno_1, 100, CAST((se.total_solido / turno_1)*100 AS  DECIMAL(4,2))) FROM capacidad_envasado WHERE id_linea = 3 AND semana = se.semana) AS plan_solido_1, 
                                                (SELECT IF(IF(se.total_solido - turno_1 < 0, 0, se.total_solido - turno_1) > turno_2, 100, CAST((IF(se.total_solido - turno_1 < 0 , 0, se.total_solido - turno_1)) / turno_2 * 100 AS  DECIMAL(4,2))) FROM capacidad_envasado WHERE id_linea = 3 AND semana = se.semana) AS plan_solido_2, 
                                                (SELECT CAST(IF(se.total_solido - turno_1 - turno_2 < 0, 0, se.total_solido - turno_1 - turno_2) / turno_3 * 100 AS  DECIMAL(4,2)) FROM capacidad_envasado WHERE id_linea = 3 AND semana = se.semana) AS plan_solido_3, se.total_solido
                                      FROM capacidad_envasado_sum se
                                      WHERE se.semana >= WEEKOFYEAR(NOW())");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

        $envasado = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $envasado;
    }
}
