<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class EstadoDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function actualizarEstado($dataBatch)
    {
        $modulo = $dataBatch['modulo'];
        // $batch = $dataBatch['idBatch'];
        switch ($modulo) {
            case '2': //pesaje
                $estado = 3.5;
                break;
            case '3': //preparacion
                $estado = 4.5;
                break;
            case '4': //aprobacion
                $estado = 5.5;
                break;
            case '5': //envasado
                $estado = 6.5;
                break;
            case '6': //acondicionamiento
                $estado = 6.5;
                break;
            case '7': //despachos
                $estado = 7.5;
                break;
            case '8': //Microbiologia
                $estado = 8.5;
                break;
            case '9': //fisicoquimico
                $estado = 8.5;
                break;
        }
        //Modifica el estado de acuerdo con el modulo
        $this->ActualizarBatchEstado($dataBatch, $estado);
    }

    public function cerrarEstado($dataBatch)
    {
        $modulo = $dataBatch['modulo'];
        // $batch = $dataBatch['idBatch'];
        switch ($modulo) {
            case '2': // pesaje
                $estado = 4;
                break;
            case '3': // Preparacion
                $estado = 5;
                break;
            case '4': // Aprobacion
                $estado = 6;
                break;
            case '5': //Envasado
                $estado = 7;
                break;
            case '6': //Acondicionamiento
                $estado = 7;
                break;
            case '7': // Despachos
                $estado = 8;
                break;
            case '8': // Microbiologia
                $estado = 10;
                break;
            case '9': // FisicoQuimico
                $estado = 9;
                break;
            case '10': // Liberacion Lote
                $estado = 10;
                break;
        }
        //Modifica el estado de acuerdo con el modulo
        $this->ActualizarBatchEstado($dataBatch, $estado);
    }

    public function ActualizarBatchEstado($dataBatch, $estado)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT estado FROM batch WHERE id_batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $dataBatch['idBatch']]);
        $data = $query->fetch($connection::FETCH_ASSOC);

        /* valida el estado si es mayor al que se encuentra no lo cambia */

        if ($data['estado'] < $estado) {
            $sql = "UPDATE batch SET estado = :estado WHERE id_batch = :batch";
            $query = $connection->prepare($sql);
            $query->execute(['estado' => $estado, 'batch' => $dataBatch['idBatch']]);
        }
    }

    /* Cerrar el batch por completo, paso por todos los proceso */
    public function CerrarBatch($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT SUM(cantidad_firmas) as cantidad FROM `batch_control_firmas` WHERE batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $dataBatch['idBatch']]);
        $firmas = $query->fetch($connection::FETCH_ASSOC);

        if ($firmas['cantidad'] == 28) {
            $sql = "UPDATE batch SET estado = '10' WHERE id_batch = :batch";
            $query = $connection->prepare($sql);
            $query->execute(['batch' => $dataBatch['idBatch']]);
        }
    }
}
