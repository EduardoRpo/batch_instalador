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

    public function findAllTanquesChks($dataTanques)
    {
        $connection = Connection::getInstance()->getConnection();

        $query = $this->findTanquesChks($dataTanques);
        $rows = $query->rowCount();

        if ($rows > 0) {
            $this->logger->info(__FUNCTION__, array('query' => $query->queryString, 'errors' => $query->errorInfo()));
            $data = $query->fetch($connection::FETCH_ASSOC);
            $this->logger->notice("Tanques obtenidos", array('tanques' => $data));
            return $data;
        }
    }

    public function findTanquesChks($dataTanques)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT * FROM batch_tanques_chks WHERE modulo = :modulo AND batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute([
            'modulo' => $dataTanques['modulo'],
            'batch' => $dataTanques['idBatch']
        ]);

        return $query;
    }

    public function saveTanquesChks($dataTanques)
    {
        try {
            error_log('🔍 TanquesChksDao::saveTanquesChks - Iniciando');
            error_log('🔍 TanquesChksDao::saveTanquesChks - Datos recibidos: ' . json_encode($dataTanques));
            
            $connection = Connection::getInstance()->getConnection();
            error_log('🔍 TanquesChksDao::saveTanquesChks - Conexión obtenida');

            //$tanques = $dataTanques['tanques'];
            //$tanquesOk = $dataTanques['tanquesOk'];

            /* revisar si existen un registro del modulo y batch para actualizar o insertar */

            error_log('🔍 TanquesChksDao::saveTanquesChks - Ejecutando findTanquesChks');
            $query = $this->findTanquesChks($dataTanques);
            $rows = $query->rowCount();
            error_log("🔍 TanquesChksDao::saveTanquesChks - Filas encontradas: $rows");

            /* Si existe un registro actualiza de lo contrario lo inserta */

            if ($rows > 0) {
                error_log('🔍 TanquesChksDao::saveTanquesChks - Actualizando registro existente');
                $sql = "UPDATE batch_tanques_chks SET tanquesOk =:tanquesOk WHERE modulo = :modulo AND batch = :batch";
                $query = $connection->prepare($sql);
                $result = $query->execute([
                    'tanquesOk' => $dataTanques['tanquesOk'],
                    'modulo' => $dataTanques['modulo'],
                    'batch' => $dataTanques['idBatch']
                ]);
                error_log('🔍 TanquesChksDao::saveTanquesChks - Resultado UPDATE: ' . ($result ? 'true' : 'false'));
                if (!$result) {
                    error_log('❌ TanquesChksDao::saveTanquesChks - Error en UPDATE: ' . json_encode($query->errorInfo()));
                }
            } else {
                error_log('🔍 TanquesChksDao::saveTanquesChks - Insertando nuevo registro');
                $sql = "INSERT INTO batch_tanques_chks (tanques, tanquesOk, modulo, batch) VALUES(:tanques, :tanquesOk, :modulo, :batch)";
                $query = $connection->prepare($sql);
                $result = $query->execute([
                    'tanques' => $dataTanques['tanques'],
                    'tanquesOk' => $dataTanques['tanquesOk'],
                    'modulo' => $dataTanques['modulo'],
                    'batch' => $dataTanques['idBatch']
                ]);
                error_log('🔍 TanquesChksDao::saveTanquesChks - Resultado INSERT: ' . ($result ? 'true' : 'false'));
                if (!$result) {
                    error_log('❌ TanquesChksDao::saveTanquesChks - Error en INSERT: ' . json_encode($query->errorInfo()));
                }
            }
            
            error_log('✅ TanquesChksDao::saveTanquesChks - Completado exitosamente');
            return null; // Retorna null si todo está bien
            
        } catch (Exception $e) {
            error_log('❌ TanquesChksDao::saveTanquesChks - Excepción: ' . $e->getMessage());
            error_log('❌ TanquesChksDao::saveTanquesChks - Stack trace: ' . $e->getTraceAsString());
            return $e->getMessage(); // Retorna el error
        }
    }
}
