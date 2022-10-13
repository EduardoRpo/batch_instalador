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

        $stmt = $connection->prepare("SELECT * FROM sum_capacidad_envasado");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

        $envasado = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $envasado;
    }

    public function calcSumCapacidadesEnvasado($dataEnvasado)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT DISTINCT se.semana, (SELECT IF(se.plan_liquido_1 <= turno_1, se.plan_liquido_1, turno_1) FROM capacidad_envasado WHERE id_capacidad_envasado = 1) AS plan_liquido_1, 
                                            (SELECT IF(IF(se.plan_liquido_1 <= turno_1, 0, se.plan_liquido_1 - turno_1) + IF(se.plan_liquido_2 <= turno_2, se.plan_liquido_2, turno_2) > turno_2, turno_2, IF(se.plan_liquido_1 <= turno_1, 0, se.plan_liquido_1 - turno_1) + IF(se.plan_liquido_2 <= turno_2, se.plan_liquido_2, turno_2)) FROM capacidad_envasado WHERE id_capacidad_envasado = 1) AS plan_liquido_2,
                                            (SELECT IF(se.plan_liquido_1 <= turno_1, 0, se.plan_liquido_1 - turno_1) + IF(se.plan_liquido_2 <= turno_2, 0, se.plan_liquido_2 - turno_2) + se.plan_liquido_3 FROM capacidad_envasado WHERE id_capacidad_envasado = 1) AS plan_liquido_3,
                                            (SELECT IF(se.plan_semi_solido_1 <= turno_1, se.plan_semi_solido_1, turno_1) FROM capacidad_envasado WHERE id_capacidad_envasado = 2) AS plan_semi_solido_1, 
                                            (SELECT IF(IF(se.plan_semi_solido_1 <= turno_1, 0, se.plan_semi_solido_1 - turno_1) + IF(se.plan_semi_solido_2 <= turno_2, se.plan_semi_solido_2, turno_2) > turno_2, turno_2, IF(se.plan_semi_solido_1 <= turno_1, 0, se.plan_semi_solido_1 - turno_1) + IF(se.plan_semi_solido_2 <= turno_2, se.plan_semi_solido_2, turno_2)) FROM capacidad_envasado WHERE id_capacidad_envasado = 2) AS plan_semi_solido_2,
                                            (SELECT IF(se.plan_semi_solido_1 <= turno_1, 0, se.plan_semi_solido_1 - turno_1) + IF(se.plan_semi_solido_2 <= turno_2, 0, se.plan_semi_solido_2 - turno_2) + se.plan_semi_solido_3 FROM capacidad_envasado WHERE id_capacidad_envasado = 2) AS plan_semi_solido_3,
                                            (SELECT IF(se.plan_solido_1 <= turno_1, se.plan_solido_1, turno_1) FROM capacidad_envasado WHERE id_capacidad_envasado = 3) AS plan_solido_1, 
                                            (SELECT IF(IF(se.plan_solido_1 <= turno_1, 0, se.plan_solido_1 - turno_1) + IF(se.plan_solido_2 <= turno_2, se.plan_solido_2, turno_2) > turno_2, turno_2, IF(se.plan_solido_1 <= turno_1, 0, se.plan_solido_1 - turno_1) + IF(se.plan_solido_2 <= turno_2, se.plan_solido_2, turno_2)) FROM capacidad_envasado WHERE id_capacidad_envasado = 3) AS plan_solido_2,
                                            (SELECT IF(se.plan_solido_1 <= turno_1, 0, se.plan_solido_1 - turno_1) + IF(se.plan_solido_2 <= turno_2, 0, se.plan_solido_2 - turno_2) + se.plan_solido_3 FROM capacidad_envasado WHERE id_capacidad_envasado = 3) AS plan_solido_3 
                                      FROM sum_capacidad_envasado se
                                        INNER JOIN capacidad_envasado ce
                                        INNER JOIN linea l ON l.id = ce.id_linea
                                      WHERE se.semana = :semana;");
        $stmt->execute(['semana' => $dataEnvasado['semana']]);
        $envasado = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

        // Actualizar
        $stmt = $connection->prepare("UPDATE sum_capacidad_envasado SET plan_liquido_1 = :plan_liquido_1, plan_liquido_2 = :plan_liquido_2, plan_liquido_3 = :plan_liquido_3, plan_semi_solido_1 = :plan_semi_solido_1,
                                                        plan_semi_solido_2 = :plan_semi_solido_2, plan_semi_solido_3 = :plan_semi_solido_3, plan_solido_1 = :plan_solido_1, plan_solido_2 = :plan_solido_2, plan_solido_3 = :plan_solido_3
                                      WHERE semana = :semana");
        $stmt->execute([
            'semana' => $dataEnvasado['semana'],
            'plan_liquido_1' => $envasado['plan_liquido_1'],
            'plan_liquido_2' => $envasado['plan_liquido_2'],
            'plan_liquido_3' => $envasado['plan_liquido_3'],
            'plan_semi_solido_1' => $envasado['plan_semi_solido_1'],
            'plan_semi_solido_2' => $envasado['plan_semi_solido_2'],
            'plan_semi_solido_3' => $envasado['plan_semi_solido_3'],
            'plan_solido_1' => $envasado['plan_solido_1'],
            'plan_solido_2' => $envasado['plan_solido_2'],
            'plan_solido_3' => $envasado['plan_solido_3']
        ]);
    }

    public function updateCapacidadEnvasado($dataEnvasado)
    {
        $connection = Connection::getInstance()->getConnection();

        if (str_contains($dataEnvasado['no_lote'], 'LQ'))
            $col = 'plan_liquido_1';
        else if (str_contains($dataEnvasado['no_lote'], 'SM'))
            $col = 'plan_semi_solido_1';
        else if (str_contains($dataEnvasado['no_lote'], 'SL'))
            $col = 'plan_solido_1';

        $tamanoLote = str_replace('.', '', $dataEnvasado['tamano_lote']);

        $stmt = $connection->prepare("UPDATE sum_capacidad_envasado SET {$col} = ${col}+ :col
                                      WHERE semana = :semana");
        $stmt->execute([
            'col' => $tamanoLote,
            'semana' => $dataEnvasado['semana']
        ]);
    }

    public function calcTotalCapacidades()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE sum_capacidad_envasado SET total_liquido = (plan_liquido_1 + plan_liquido_2 + plan_liquido_3), total_semi_solido = (plan_semi_solido_1 + plan_semi_solido_2 + plan_semi_solido_3),
                                                                     total_solido = (plan_solido_1 + plan_solido_2 + plan_solido_3);");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
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

        $stmt = $connection->prepare("SELECT DISTINCT se.semana, (SELECT CAST((se.plan_liquido_1 / turno_1)*100 AS UNSIGNED) FROM capacidad_envasado WHERE id_capacidad_envasado = 1) AS plan_liquido_1,
                                            (SELECT CAST((se.plan_liquido_2 / turno_2)*100 AS UNSIGNED) FROM capacidad_envasado WHERE id_capacidad_envasado = 1) AS plan_liquido_2,
                                            (SELECT CAST((se.plan_liquido_3 / turno_3)*100 AS UNSIGNED) FROM capacidad_envasado WHERE id_capacidad_envasado = 1) AS plan_liquido_3, se.total_liquido,
                                            (SELECT CAST((se.plan_semi_solido_1 / turno_1)*100 AS UNSIGNED) FROM capacidad_envasado WHERE id_capacidad_envasado = 2) AS plan_semi_solido_1,
                                            (SELECT CAST((se.plan_semi_solido_2 / turno_2)*100 AS UNSIGNED) FROM capacidad_envasado WHERE id_capacidad_envasado = 2) AS plan_semi_solido_2,
                                            (SELECT CAST((se.plan_semi_solido_3 / turno_3)*100 AS UNSIGNED) FROM capacidad_envasado WHERE id_capacidad_envasado = 2) AS plan_semi_solido_3, se.total_semi_solido,
                                            (SELECT CAST((se.plan_solido_1 / turno_1)*100 AS UNSIGNED) FROM capacidad_envasado WHERE id_capacidad_envasado = 3) AS plan_solido_1,
                                            (SELECT CAST((se.plan_solido_2 / turno_2)*100 AS UNSIGNED) FROM capacidad_envasado WHERE id_capacidad_envasado = 3) AS plan_solido_2,
                                            (SELECT CAST((se.plan_solido_3 / turno_3)*100 AS UNSIGNED) FROM capacidad_envasado WHERE id_capacidad_envasado = 3) AS plan_solido_3, se.total_solido
                                      FROM sum_capacidad_envasado se
                                        INNER JOIN capacidad_envasado ce
                                        INNER JOIN linea l ON l.id = ce.id_linea
                                      WHERE se.semana >= WEEKOFYEAR(NOW()) LIMIT 9;");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

        $envasado = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $envasado;
    }
}
