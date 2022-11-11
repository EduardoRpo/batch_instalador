<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ValidacionFirmasDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findDesinfectanteByBatch($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT realizo, verifico, batch, modulo FROM batch_desinfectante_seleccionado WHERE batch = :batch");
        $stmt->execute(['batch' => $batch]);
        $firmas_despeje = $stmt->fetchAll($connection::FETCH_ASSOC);

        return $firmas_despeje;
    }

    public function findFirmas2SeccionByBatch($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT COUNT(realizo) AS realizo, COUNT(verifico) AS verifico, batch, modulo FROM batch_firmas2seccion WHERE batch = :batch GROUP BY modulo");
        $stmt->execute(['batch' => $batch]);
        $firmas_proceso = $stmt->fetchAll($connection::FETCH_ASSOC);

        return $firmas_proceso;
    }

    public function findAnalisisMicrobiologicoByBatch($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT realizo, verifico, batch, modulo FROM batch_analisis_microbiologico WHERE batch = :batch");
        $stmt->execute(['batch' => $batch]);
        $firmas_microbiologico = $stmt->fetchAll($connection::FETCH_ASSOC);

        return $firmas_microbiologico;
    }

    public function findConciliacionRendimientoByBatch($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT entrego, batch, modulo FROM batch_conciliacion_rendimiento WHERE batch = :batch");
        $stmt->execute(['batch' => $batch]);
        $firmas_conciliacion = $stmt->fetchAll($connection::FETCH_ASSOC);

        return $firmas_conciliacion;
    }

    public function findMaterialSobranteByBatch($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT realizo, verifico, batch, modulo FROM batch_material_sobrante WHERE batch = :batch GROUP by ref_producto, modulo");
        $stmt->execute(['batch' => $batch]);
        $firmas_material = $stmt->fetchAll($connection::FETCH_ASSOC);

        return $firmas_material;
    }

    public function findLiberacionByBatch($batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_liberacion WHERE batch = :batch");
        $stmt->execute(['batch' => $batch]);
        $firmas_liberacion = $stmt->fetch($connection::FETCH_ASSOC);

        return $firmas_liberacion;
    }

    public function findAllBatchByDate()
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch WHERE fecha_actual = CURRENT_DATE
                                      ORDER BY `batch`.`id_batch` DESC");
        $stmt->execute();

        $batchs = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $batchs;
    }

    public function validarFirmasGestionadas($batch, $firmas)
    {
        $connection = Connection::getInstance()->getConnection();

        foreach ($firmas as $key => $value) {

            $stmt = $connection->prepare("SELECT * FROM batch_control_firmas WHERE modulo= :modulo AND batch = :batch");
            $stmt->execute(['batch' => $batch, 'modulo' => $key]);
            $controlFirmas = $stmt->fetch($connection::FETCH_ASSOC);

            if ($controlFirmas['cantidad_firmas'] != $controlFirmas['total_firmas']) {
                $stmt = $connection->prepare("UPDATE batch_control_firmas SET cantidad_firmas = :firmas WHERE modulo = :modulo and batch = :batch");
                $stmt->execute(['batch' => $batch, 'modulo' => $key, 'firmas' => $value]);
            }
        }
    }
}
