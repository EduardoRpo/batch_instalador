<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    error_log("🔍 cargos_fetch.php - Iniciando consulta de cargos");
    
    // Consulta para obtener cargos
    $sql = "SELECT id, cargo 
            FROM cargos 
            ORDER BY id ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $cargos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 cargos_fetch.php - Cargos encontrados: " . count($cargos));
    error_log("🔍 cargos_fetch.php - Datos: " . json_encode($cargos));
    
    echo json_encode($cargos, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ cargos_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 