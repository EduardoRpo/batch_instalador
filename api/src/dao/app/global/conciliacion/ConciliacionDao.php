<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ConciliacionDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllConciliacion($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT * FROM batch_conciliacion_parciales WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
        $query = $connection->prepare($sql);
        $query->execute([
            'modulo' => $dataBatch['modulo'],
            'batch' => $dataBatch['idBatch'],
            'ref_multi' => $dataBatch['ref_multi']
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $query->queryString, 'errors' => $query->errorInfo()));
        $data = $query->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Firmas obtenidas", array('firmas' => $data));
        return $data;
    }

    public function findAllConciliacionByBatchAndRef($ref_multi, $id_batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT * FROM batch_conciliacion_parciales WHERE batch = :batch AND ref_multi = :ref_multi";
        $query = $connection->prepare($sql);
        $query->execute([
            'ref_multi' => $ref_multi,
            'batch' => $id_batch
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $query->queryString, 'errors' => $query->errorInfo()));
        $data = $query->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Firmas obtenidas", array('firmas' => $data));
        return $data;
    }

    public function almacenar_muestras_retencion($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();
        try {
            $stmt = $connection->prepare("SELECT * FROM batch_muestras_retencion WHERE batch = :batch AND referencia = :referencia");
            $stmt->execute(['referencia' => $dataBatch['referencia'], 'batch' => $dataBatch['idBatch']]);
            $rows = $stmt->rowCount();

            if (!$rows) {
                $sql = "SELECT MAX(muestra) as consecutivo FROM  batch_muestras_retencion";
                $query = $connection->prepare($sql);
                $query->execute();
                $data = $stmt->fetch($connection::FETCH_ASSOC);

                if ($data['consecutivo'] == null)
                    $muestra = 1;
                else
                    $muestra = $data['consecutivo'] + 1;

                for ($i = 1; $i < $dataBatch['retencion']; $i++) {
                    $sql = "INSERT INTO batch_muestras_retencion SET referencia = :referencia, muestra = :muestra,  batch = :batch";
                    $query = $connection->prepare($sql);
                    $query->execute(['referencia' => $dataBatch['referencia'], 'muestra' => $muestra, 'batch' => $dataBatch['idBatch']]);
                    $muestra = $muestra + 1;
                }
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }

    public function insertConciliacionParciales($dataBatch, $conciliacion)
    {
        $connection = Connection::getInstance()->getConnection();

        try {
            if ($dataBatch['modulo'] == 6) {
                if ($conciliacion) $retencion = 0;
                else return 1;

                $sql = "INSERT INTO batch_conciliacion_parciales (unidades, retencion, cajas, movimiento, modulo, batch, ref_multi, realizo) 
                        VALUES(:unidades, :retencion, :cajas, :movimiento, :modulo, :batch, :ref_multi, :realizo)";
                $query = $connection->prepare($sql);
                $query->execute([
                    'unidades' => $dataBatch['unidades'],
                    'retencion' => $retencion,
                    'cajas' => $dataBatch['cajas'],
                    'movimiento' => $dataBatch['mov'],
                    'modulo' => $dataBatch['modulo'],
                    'batch' => $dataBatch['idBatch'],
                    'ref_multi' => $dataBatch['ref_multi'],
                    'realizo' => $dataBatch['realizo']
                ]);
            } else {
                $sql = "INSERT INTO batch_conciliacion_parciales (unidades, cajas, movimiento, modulo, batch, ref_multi, realizo) 
                        VALUES(:unidades, :cajas, :movimiento, :modulo, :batch, :ref_multi, :realizo)";
                $query = $connection->prepare($sql);
                $query->execute([
                    'unidades' => $dataBatch['unidades'],
                    'cajas' => $dataBatch['cajas'],
                    'movimiento' => $dataBatch['mov'],
                    'modulo' => $dataBatch['modulo'],
                    'batch' => $dataBatch['batch'],
                    'ref_multi' => $dataBatch['ref_multi'],
                    'realizo' => $dataBatch['realizo']
                ]);
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }

    public function conciliacionRendimientoRealizo($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $batch =  $dataBatch['idBatch'];
        $modulo =  $dataBatch['modulo'];
        $referencia = $dataBatch['ref_multi'];

        $sql = "SELECT * FROM batch_conciliacion_rendimiento WHERE modulo = :modulo AND batch = :batch AND ref_multi = :referencia";
        $query = $connection->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch, 'referencia' => $referencia]);
        $rows = $query->rowCount();

        if ($rows == 0) {
            $unidades =  $dataBatch['unidades'];
            $modulo == 6 ? $retencion =  $dataBatch['retencion'] : $retencion = 0;
            $movimiento =  $dataBatch['mov'];
            $cajas = $dataBatch['cajas'];
            $modulo = $dataBatch['modulo'];
            $realizo = $dataBatch['realizo'];
            $entrega_final = $dataBatch['entrega_final'];

            $sql = "SELECT SUM(unidades) as unidades FROM batch_conciliacion_parciales WHERE modulo =:modulo AND batch = :batch AND ref_multi = :ref_multi";
            $query = $connection->prepare($sql);
            $query->execute(['modulo' => $modulo, 'batch' => $batch, 'ref_multi' => $referencia]);
            $data = $query->fetch($connection::FETCH_ASSOC);

            $sql = "INSERT INTO batch_conciliacion_parciales (unidades, cajas, movimiento, modulo, batch, ref_multi, realizo, entrega_final)
                VALUES(:unidades, :cajas, :movimiento, :modulo, :batch, :ref_multi, :realizo, :entrega_final)";
            $query = $connection->prepare($sql);
            $query->execute([
                'unidades' => $unidades,
                'cajas' => $cajas,
                'movimiento' => $movimiento,
                'modulo' => $modulo,
                'batch' => $batch,
                'ref_multi' => $referencia,
                'realizo' => $realizo,
                'entrega_final' => $entrega_final,

            ]);

            // proceso por recalculo de parciales de datos ingresados antes de la creacion de la función

            if ($modulo == 7 && $batch < 131) {
                $sql = "INSERT INTO batch_conciliacion_parciales (unidades, cajas, movimiento, modulo, batch, ref_multi, realizo) 
                    VALUES(:unidades, :cajas, :movimiento, :modulo, :batch, :ref_multi, :realizo)";
                $query = $connection->prepare($sql);
                $query->execute([
                    'unidades' => $unidades,
                    'cajas' => $cajas,
                    'movimiento' => $movimiento,
                    'modulo' => 6,
                    'batch' => $batch,
                    'ref_multi' => $referencia,
                    'realizo' => $realizo
                ]);
            }



            $unidades = intval($unidades) + intval($data['unidades']);

            $sql = "INSERT INTO batch_conciliacion_rendimiento 
                SET unidades_producidas = :unidades, muestras_retencion = :retencion, mov_inventario = :movimiento, cajas = :cajas, 
                    batch = :batch, modulo = :modulo, ref_multi = :referencia, entrego = :realizo";
            $query = $connection->prepare($sql);
            $query->execute([
                'unidades' => $unidades,
                'retencion' => $retencion,
                'movimiento' => $movimiento,
                'cajas' => $cajas,
                'batch' => $batch,
                'modulo' => $modulo,
                'referencia' => $referencia,
                'realizo' => $realizo,
            ]);
            // registrarFirmas($conn, $batch, $modulo);
            // CerrarBatch($conn, $batch);
        }
    }
}
