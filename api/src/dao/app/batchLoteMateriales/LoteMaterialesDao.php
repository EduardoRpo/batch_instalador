<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class LoteMaterialesDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function registrarLotes($dataLote)
    {
        $connection = Connection::getInstance()->getConnection();

        $lotes = $dataLote['lotes'];

        foreach ($lotes as $lote) {
            $sql = "INSERT INTO batch_lote_materiales (ref_material, lote, tanque, batch) VALUES (:ref_material, :lote, :tanque, :batch)";
            $query = $connection->prepare($sql);
            $query->execute(['ref_material' => $lote['referenciaMP'], 'lote' => $lote['lote'], 'tanque' => $lote['tanque'], 'batch' => $lote['batch']]);
        }
    }
}
