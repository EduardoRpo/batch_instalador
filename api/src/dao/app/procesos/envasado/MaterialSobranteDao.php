<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class MaterialSobranteDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findMaterialSobranteRealizoVerifico($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT bms.id, bms.ref_material, bms.envasada, bms.averias, bms.sobrante, bms.ref_producto, bms.batch, bms.modulo, u.urlfirma as realizo, us.urlfirma as verifico 
                                      FROM batch_material_sobrante bms 
                                        LEFT JOIN usuario u ON u.id = bms.realizo
                                        LEFT JOIN usuario us ON us.id = bms.verifico 
                                      WHERE modulo = :modulo AND batch = :batch AND ref_producto = :ref_multi");
        $stmt->execute([
            'modulo' => $dataBatch['modulo'],
            'batch' => $dataBatch['idBatch'],
            'ref_multi' => $dataBatch['ref_multi']
        ]);

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $data = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Firmas obtenidas", array('firmas' => $data));
        return $data;
    }

    public function findMaterialSobranteRealizoByBatch($id_batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT bms.id, bms.ref_material, bms.envasada, bms.averias, bms.sobrante, bms.ref_producto, bms.batch, bms.modulo, u.urlfirma as realizo 
                                      FROM batch_material_sobrante bms 
                                        LEFT JOIN usuario u ON u.id = bms.realizo
                                      WHERE batch = :batch
                                      ORDER BY `bms`.`ref_producto` DESC");
        $stmt->execute(['batch' => $id_batch]);

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $data = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Firmas obtenidas", array('firmas' => $data));
        return $data;
    }

    public function findMaterialSobranteRealizo($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT bms.id, bms.ref_material, bms.envasada, bms.averias, bms.sobrante, bms.ref_producto, bms.batch, bms.modulo, u.urlfirma as realizo 
                                      FROM batch_material_sobrante bms 
                                        LEFT JOIN usuario u ON u.id = bms.realizo
                                      WHERE modulo = :modulo AND batch = :batch AND ref_producto = :ref_multi");
        $stmt->execute([
            'modulo' => $dataBatch['modulo'],
            'batch' => $dataBatch['idBatch'],
            'ref_multi' => $dataBatch['ref_multi']
        ]);

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $data = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Firmas obtenidas", array('firmas' => $data));
        return $data;
    }

    public function materialSobranteRealizo($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        // $batch = $_POST['idBatch'];
        $modulo = $dataBatch['modulo'];

        if ($modulo == 5 || $modulo == 6) {
            $referencia = $dataBatch['ref_multi'];
            $sql = "SELECT * FROM batch_material_sobrante WHERE modulo = :modulo AND batch = :batch AND ref_producto = :referencia";
            $query = $connection->prepare($sql);
            $query->execute(['modulo' => $modulo, 'batch' => $dataBatch['idBatch'], 'referencia' => $referencia]);
            $rows = $query->rowCount();
        } else {
            $sql = "SELECT * FROM batch_material_sobrante WHERE modulo = :modulo AND batch = :batch";
            $query = $connection->prepare($sql);
            $query->execute(['modulo' => $modulo, 'batch' => $dataBatch['idBatch']]);
            $rows = $query->rowCount();
        }

        if ($rows == 0) {

            $material = $dataBatch['materialsobrante'];
            $ref_producto = $dataBatch['ref_multi'];
            $realizo = $dataBatch['realizo'];
            $verifico = 0;

            foreach ($material as $valor) {
                $sql = "INSERT INTO batch_material_sobrante (ref_material, envasada, averias, sobrante, ref_producto, batch, modulo, realizo, verifico) 
                VALUES(:referencia, :envasada, :averias, :sobrante, :producto, :batch, :modulo, :realizo, :verifico)";
                $query = $connection->prepare($sql);
                $query->execute([
                    'referencia' => $valor['referencia'],
                    'envasada' => $valor['envasada'],
                    'averias' => $valor['averias'],
                    'sobrante' => $valor['sobrante'],
                    'producto' => $ref_producto,
                    'batch' => $dataBatch['idBatch'],
                    'modulo' => $modulo,
                    'realizo' => $realizo,
                    'verifico' => $verifico
                ]);
            }
            // registrarFirmas($conn, $batch, $modulo);
        }
    }

    public function materialSobranteVerifico($dataBatch)
    {

        try {
            $connection = Connection::getInstance()->getConnection();

            // $modulo = $_POST['modulo'];
            // $batch = $_POST['idBatch'];

            $sql = "SELECT * FROM batch_material_sobrante WHERE modulo = :modulo AND batch = :batch";
            $query = $connection->prepare($sql);
            $query->execute(['modulo' => $dataBatch['modulo'], 'batch' => $dataBatch['idBatch']]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                // $ref_multi = $_POST['ref_multi'];
                // $verifico = $_POST['verifico'];

                $sql = "UPDATE batch_material_sobrante SET verifico = :verifico WHERE batch = :batch AND modulo = :modulo AND ref_producto = :ref_multi";
                $query = $connection->prepare($sql);
                $query->execute([
                    'modulo' => $dataBatch['modulo'],
                    'batch' => $dataBatch['idBatch'],
                    'ref_multi' => $dataBatch['ref_multi'],
                    'verifico' => $dataBatch['verifico'],
                ]);
                // registrarFirmas($conn, $batch, $modulo);
                // CerrarBatch($conn, $batch);
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }
}
