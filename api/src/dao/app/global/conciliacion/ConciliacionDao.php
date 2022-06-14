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
