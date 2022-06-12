<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class TanquesChksDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findTanquesChks($dataTanques)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT * FROM batch_tanques_chks WHERE modulo = :modulo AND batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['modulo' => $dataTanques['modulo'], 'batch' => $dataTanques['batch']]);

        return $query;
    }

    public function saveTanquesChks($dataTanques)
    {
        $connection = Connection::getInstance()->getConnection();

        //$tanques = $dataTanques['tanques'];
        //$tanquesOk = $dataTanques['tanquesOk'];

        /* revisar si existen un registro del modulo y batch para actualizar o insertar */

        $query = $this->findTanquesChks($dataTanques);
        $rows = $query->rowCount();

        /* Si existe un registro actualiza de lo contrario lo inserta */

        if ($rows > 0) {
            $sql = "UPDATE batch_tanques_chks SET tanquesOk =:tanquesOk WHERE modulo = :modulo AND batch = :batch";
            $query = $connection->prepare($sql);
            $query->execute(['tanquesOk' => $dataTanques['tanquesOk'], 'modulo' => $dataTanques['modulo'], 'batch' => $dataTanques['batch']]);
        } else {
            $sql = "INSERT INTO batch_tanques_chks (tanques, tanquesOk, modulo, batch) VALUES(:tanques, :tanquesOk, :modulo, :batch)";
            $query = $connection->prepare($sql);
            $query->execute(['tanques' => $dataTanques['tanques'], 'tanquesOk' => $dataTanques['tanquesOk'], 'modulo' => $dataTanques['modulo'], 'batch' => $dataTanques['batch']]);
        }
    }

    public function findAllTanquesChks($dataTanques)
    {
        $connection = Connection::getInstance()->getConnection();

        $query = $this->findTanquesChks($dataTanques);
        $rows = $query->rowCount();

        if ($rows > 0) {
            // $data = $query->fetch($connection::FETCH_ASSOC);
            // $arreglo[] = $data;
            // echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
            $this->logger->info(__FUNCTION__, array('query' => $query->queryString, 'errors' => $query->errorInfo()));
            $data = $query->fetch($connection::FETCH_ASSOC);
            $this->logger->notice("Tanques obtenidos", array('tanques' => $data));
            return $data;
        }
    }
}
