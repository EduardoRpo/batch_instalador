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

    public function calcTotalCapacidades()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE sum_capacidad_envasado SET total_liquidos = (plan_liquido_1 + plan_liquido_2 + plan_liquido_3), total_semi_solidos = (plan_semi_solido_1 + plan_semi_solido_2 + plan_semi_solido_3),
                                                total_solido = (plan_solido_1 + plan_solido_2 + plan_solido_3)");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function calcSumCapacidadesEnvasado($dataEnvasado)
    {
        $connection = Connection::getInstance()->getConnection();



        $stmt = $connection->prepare("SELECT se.semana, IF(se.plan_liquido_1 <= ce.turno_1, se.plan_liquido_1, ce.turno_1) AS turno_1, IF((se.plan_liquido_1 - ce.turno_1) < 0, 0, se.plan_liquido_1 - ce.turno_1) AS turno_2
                                      FROM sum_capacidad_envasado se
                                       INNER JOIN capacidad_envasado ce
                                      WHERE ce.id_envasado = :id_envasado AND se.semana = :semana");
        $stmt->execute([
            'id_envasado' => $dataEnvasado['idEnvasado'],
            'semana' => $dataEnvasado['semana']
        ]);
        $envasado = $stmt->fetch($connection::FETCH_ASSOC);


        // Actualizar
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
}
