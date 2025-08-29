<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class TanquesDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findTanquesById($id_batch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT tanque, cantidad FROM batch_tanques WHERE id_batch = :id_batch";
        $query = $connection->prepare($sql);
        $query->execute(['id_batch' => $id_batch]);
        $tanques = $query->fetch($connection::FETCH_ASSOC);
        return $tanques;
    }

    public function saveTanques($id_batch, $dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt =  $connection->prepare("SELECT * FROM batch_tanques WHERE id_batch = :id_batch");
        $stmt->execute(['id_batch' => $id_batch]);
        $result = $stmt->rowCount();

        if ($result > 0) {
            $stmt =  $connection->prepare("UPDATE batch_tanques SET tanque = :tanque, cantidad = :cantidad WHERE id_batch = :id_batch");
            $stmt->execute([
                'tanque' => $dataBatch['tanque'],
                'cantidad' => $dataBatch['cantidades'],
                'id_batch' => $id_batch
            ]);
        } else {
            $stmt = $connection->prepare("INSERT INTO batch_tanques(tanque, cantidad, id_batch) 
                VALUES(:tanque, :cantidad, :id_batch)");
            $stmt->execute([
                'tanque' => $dataBatch['tanque'],
                'cantidad' => $dataBatch['cantidades'],
                'id_batch' => $id_batch
            ]);
        }
    }

    public function saveMultipleTanques($id_batch, $tanque, $cantidad_tanques)
    {
        $connection = Connection::getInstance()->getConnection();
        
        try {
            // Log para consola del navegador
            echo "<script>console.log('🔍 TanquesDao - Iniciando saveMultipleTanques: id_batch=$id_batch, tanque=$tanque, cantidad_tanques=$cantidad_tanques');</script>";
            
            // Crear un solo registro con la cantidad total de tanques
            $stmt = $connection->prepare("INSERT INTO batch_tanques(tanque, cantidad, id_batch) 
                VALUES(:tanque, :cantidad, :id_batch)");
            $stmt->execute([
                'tanque' => $tanque,
                'cantidad' => $cantidad_tanques, // Usar la cantidad total en lugar de 1
                'id_batch' => $id_batch
            ]);
            
            // Log para debugging en frontend
            error_log("✅ TanquesDao - Registro creado exitosamente: tanque=$tanque, cantidad=$cantidad_tanques, id_batch=$id_batch");
            
            // Log para consola del navegador
            echo "<script>console.log('✅ TanquesDao - Registro creado exitosamente: tanque=$tanque, cantidad=$cantidad_tanques, id_batch=$id_batch');</script>";
            
            return null; // Éxito
        } catch (Exception $e) {
            // Log del error para debugging
            error_log("❌ TanquesDao - Error al crear registro: " . $e->getMessage());
            
            // Log para consola del navegador
            echo "<script>console.error('❌ TanquesDao - Error al crear registro: " . $e->getMessage() . "');</script>";
            
            return $e->getMessage();
        }
    }
}
