<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class AnalisisMicrobiologicoDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function analisisMicrobiologiaRealizo($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $modulo = $dataBatch['modulo'];
        $batch = $dataBatch['idBatch'];
        $realizo = $dataBatch['realizo'];
        $dataMicrobiologia = json_decode($dataBatch['dataMicro'], true);

        for ($i = 2; $i < sizeof($dataMicrobiologia); $i++) {
            $sql = "INSERT INTO `batch_analisis_microbiologico`(mesofilos, pseudomona, escherichia, staphylococcus, fecha_siembra, fecha_resultados, realizo, referencia, batch, modulo) 
                    VALUES(:mesofilos, :pseudomona, :escherichia, :staphylococcus, :fecha_siembra, :fecha_resultados, :realizo, :referencia, :batch, :modulo)";
            $query = $connection->prepare($sql);
            $query->execute([
                'mesofilos' => $dataMicrobiologia[$i]["mesofilos"],
                'pseudomona' => $dataMicrobiologia[$i]["pseudomona"],
                'escherichia' => $dataMicrobiologia[$i]["escherichia"],
                'staphylococcus' => $dataMicrobiologia[$i]["staphylococcus"],
                'fecha_siembra' => $dataMicrobiologia[$i]["fechaSiembra"],
                'fecha_resultados' => $dataMicrobiologia[$i]["fechaResultados"],
                'referencia' => $dataMicrobiologia[$i]["referencia"],
                'realizo' => $realizo,
                'batch' => $batch,
                'modulo' => $modulo
            ]);
        }

        $sql = "SELECT * FROM `batch_analisis_microbiologico` WHERE batch = :batch AND modulo = :modulo";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $batch, 'modulo' => $modulo]);
        $cantMicro = $query->rowCount();

        $sql = "SELECT * FROM `multipresentacion` WHERE id_batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $batch]);
        $cantMulti = $query->rowCount();

        /* Validacion referencia sin multipresentacion */
        if ($cantMulti == 0) $cantMulti = 1;

        if ($cantMicro == $cantMulti)
            echo '1';

        // registrarFirmas($conn, $batch, $modulo);
    }

    public function AnalisisMicrobiologiaVerifico($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $batch = $dataBatch['idBatch'];

        $sql = "SELECT * FROM batch_analisis_microbiologico WHERE batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $batch]);
        $rows = $query->rowCount();

        if ($rows > 0) {
            $verifico = $dataBatch['verifico'];
            //$modulo = $dataBatch['modulo'];

            $sql = "UPDATE `batch_analisis_microbiologico` SET verifico = :verifico WHERE batch = :batch";
            $query = $connection->prepare($sql);
            $query->execute(['verifico' => $verifico, 'batch' => $batch]);
            // registrarFirmas($conn, $batch, $modulo);
            // CerrarBatch($conn, $batch);
        }
    }
}
