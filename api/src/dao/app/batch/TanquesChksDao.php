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

    public function saveTanquesChks($dataTanques)
    {
        $connection = Connection::getInstance()->getConnection();

        $tanques = $_POST['tanques'];
        $tanquesOk = $_POST['tanquesOk'];

        /* revisar si existen un registro del modulo y batch para actualizar o insertar */

        $sql = "SELECT * FROM batch_tanques_chks WHERE modulo = :modulo AND batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['modulo' => $dataTanques['modulo'], 'batch' => $dataTanques['batch']]);
        $rows = $query->rowCount();

        /* Si existe un registro actualiza de lo contrario lo inserta */

        if ($rows > 0) {
            $sql = "UPDATE batch_tanques_chks SET tanquesOk =:tanquesOk WHERE modulo = :modulo AND batch = :batch";
            $query = $connection->prepare($sql);
            $query->execute(['tanquesOk' => $tanquesOk, 'modulo' => $dataTanques['modulo'], 'batch' => $dataTanques['batch']]);
        } else {
            $sql = "INSERT INTO batch_tanques_chks (tanques, tanquesOk, modulo, batch) VALUES(:tanques, :tanquesOk, :modulo, :batch)";
            $query = $connection->prepare($sql);
            $query->execute(['tanques' => $tanques, 'tanquesOk' => $tanquesOk, 'modulo' => $dataTanques['modulo'], 'batch' => $dataTanques['batch']]);
        }
    }
}
