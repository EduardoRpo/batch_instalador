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

    public function findAllBatchByDate()
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch WHERE fecha_actual = CURRENT_DATE
                                      ORDER BY `batch`.`id_batch` DESC");
        $stmt->execute();

        $batchs = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $batchs;
    }

    public function updateControlFirmas($id_batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch_control_firmas WHERE batch = :batch ORDER BY modulo");
        $stmt->execute(['batch' => $id_batch]);

        $controlFirmas = $stmt->fetchAll($connection::FETCH_ASSOC);

        foreach ($controlFirmas as $k) {

            if ($k['cantidad_firmas'] != $k['total_firmas']) {
                $sql = "UPDATE batch_control_firmas SET cantidad_firmas = 0 WHERE batch = :batch AND modulo = :modulo";
                $query = $connection->prepare($sql);
                $query->execute(['batch' => $id_batch, 'modulo' => $k['modulo']]);
            }
        }
    }
}
