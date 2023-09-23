<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class Firmas2SeccionDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findFirmas2seccionRealizoVerifico($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT bf2.observaciones as linea, bf2.modulo, bf2.batch, u.urlfirma as realizo, us.urlfirma as verifico 
                FROM batch_firmas2seccion bf2 
                    LEFT JOIN usuario u ON u.id = bf2.realizo 
                    LEFT JOIN usuario us ON us.id = bf2.verifico
                WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
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

    public function findFirmas2seccionRealizo($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT bf2.observaciones as linea, bf2.modulo, bf2.batch, u.urlfirma as realizo 
                FROM batch_firmas2seccion bf2 
                    LEFT JOIN usuario u ON u.id = bf2.realizo
                WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
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

    public function findFirmas2seccion($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT * FROM batch_firmas2seccion WHERE modulo = :modulo AND batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['modulo' => $dataBatch['modulo'], 'batch' => $dataBatch['idBatch']]);
        // if ($result > 0) {
        $this->logger->info(__FUNCTION__, array('query' => $query->queryString, 'errors' => $query->errorInfo()));
        $data = $query->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("Firmas obtenidas", array('firmas' => $data));
        return $data;
        // }
    }

    public function saveFirmaDespeje($query)
    {
        $connection = Connection::getInstance()->getConnection();

        $data = $query->fetch($connection::FETCH_ASSOC);

        if (!$data) {
            echo '3';
            exit();
        }
        // echo json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->logger->info(__FUNCTION__, array('query' => $query->queryString, 'errors' => $query->errorInfo()));
        $data = $query->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("Firmas obtenidas", array('firmas' => $data));
        return $data;
    }

    public function findFirmas2seccionByDespeje($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT u.urlfirma as realizo, us.urlfirma as verifico FROM batch_firmas2seccion d 
                    INNER JOIN usuario u ON u.id = d.realizo INNER JOIN usuario us ON us.id = d.verifico
                    WHERE modulo = :modulo AND batch = :batch";

        $query = $connection->prepare($sql);
        $query->execute(['batch' => $dataBatch['idBatch'], 'modulo' => $dataBatch['modulo']]);
        $rows = $query->rowCount();

        if ($rows > 0) {
            $data = $this->saveFirmaDespeje($query);
        } else {
            $sql = "SELECT u.urlfirma as realizo
                FROM batch_firmas2seccion d 
                INNER JOIN usuario u ON u.id = d.realizo
                WHERE modulo = :modulo AND batch = :batch";

            $query = $connection->prepare($sql);
            $query->execute(['batch' => $dataBatch['idBatch'], 'modulo' => $dataBatch['modulo']]);
            $rows = $query->rowCount();

            if ($rows > 0) $data = $this->saveFirmaDespeje($query);
            else echo 0;
        }

        return $data;
    }

    public function segundaSeccionRealizo($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $modulo = $dataBatch['modulo'];

        if ($modulo == 5 || $modulo == 6) {
            // $ref_multi = $_POST['ref_multi'];
            $sql = "SELECT * FROM batch_firmas2seccion WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
            $query = $connection->prepare($sql);
            $query->execute(['modulo' => $modulo, 'batch' => $dataBatch['idBatch'], 'ref_multi' => $dataBatch['ref_multi']]);
            $rows = $query->rowCount();
        } else {
            $sql = "SELECT * FROM batch_firmas2seccion WHERE modulo = :modulo AND batch = :batch";
            $query = $connection->prepare($sql);
            $query->execute(['modulo' => $modulo, 'batch' => $dataBatch['idBatch']]);
            $rows = $query->rowCount();
        }

        if ($rows == 0) {
            $modulo == 4 || $modulo == 9 ? $observaciones = $dataBatch['obs_batch'] : $observaciones = "";
            $modulo == 5 || $modulo == 6 ? $ref_multi = $dataBatch['ref_multi'] : $ref_multi = "";
            // $realizo = $_POST['realizo'];
            $verifico = '0';

            $sql = "INSERT INTO batch_firmas2seccion (observaciones, ref_multi, modulo, batch, realizo, verifico) 
                VALUES (:observaciones, :ref_multi, :modulo, :batch, :realizo, :verifico)";
            $query = $connection->prepare($sql);
            $query->execute([
                'observaciones' => $observaciones,
                'ref_multi' => $ref_multi,
                'realizo' => $dataBatch['realizo'],
                'verifico' => $verifico,
                'modulo' => $modulo,
                'batch' => $dataBatch['idBatch']
            ]);
            // registrarFirmas($conn, $batch, $modulo);
        }
    }

    public function segundaSeccionVerifico($dataBatch)
    {
        try {
            $connection = Connection::getInstance()->getConnection();

            // $batch = $_POST['idBatch'];
            $modulo = $dataBatch['modulo'];

            $sql = "SELECT * FROM batch_firmas2seccion WHERE modulo = :modulo AND batch = :batch";
            $query = $connection->prepare($sql);
            $query->execute(['modulo' => $modulo, 'batch' => $dataBatch['idBatch']]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                // $verifico = $dataBatch['verifico'];
                $verifico = json_decode($dataBatch['verifico']);

                if ($modulo == 5 || $modulo == 6) {
                    $ref_multi = $dataBatch['ref_multi'];
                    $sql = "UPDATE batch_firmas2seccion SET verifico = :verifico WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
                    $query = $connection->prepare($sql);
                    $query->execute([
                        'verifico' => $verifico->id,
                        'modulo' => $modulo, 'batch' => $dataBatch['idBatch'],
                        'ref_multi' => $ref_multi
                    ]);
                } else {
                    $ref_multi = 0;
                    $sql = "UPDATE batch_firmas2seccion SET verifico = :verifico WHERE modulo = :modulo AND batch = :batch";
                    $query = $connection->prepare($sql);
                    $query->execute([
                        'verifico' => $verifico,
                        'modulo' => $modulo,
                        'batch' => $dataBatch['idBatch']
                    ]);
                }

                // registrarFirmas($conn, $batch, $modulo);
                // if ($modulo == 2 || $modulo == 3 || $modulo == 4) // cerrarEstado($batch, $modulo, $conn);

                /* Elimina los registros en explosion de materiales */
                /* if ($modulo == 2) {
            $sql = "SELECT id_producto FROM batch WHERE id_batch = :id_batch";
            $query = $conn->prepare($sql);
            $query->execute(['id_batch' => $batch]);
            $referencia = $query->fetch(PDO::FETCH_ASSOC);
            cierreExplosionMaterialesBatch($conn, $batch, $referencia['id_producto']);
        } 
            CerrarBatch($conn, $batch);*/
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }
}
