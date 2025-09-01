<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    error_log("🔍 desinfectantes_fetch.php - Iniciando consulta de desinfectantes");
    
    // Consulta para obtener desinfectantes de la tabla desinfectante
    $sql = "SELECT id, nombre FROM desinfectante ORDER BY id ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $desinfectantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 desinfectantes_fetch.php - Consulta ejecutada: $sql");
    error_log("🔍 desinfectantes_fetch.php - Desinfectantes encontrados: " . count($desinfectantes));
    error_log("🔍 desinfectantes_fetch.php - Datos: " . json_encode($desinfectantes));
    
    // Si no encuentra datos, devolver array vacío
    if (empty($desinfectantes)) {
        error_log("⚠️ desinfectantes_fetch.php - No se encontraron desinfectantes en la base de datos");
    }
    
    echo json_encode($desinfectantes, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ desinfectantes_fetch.php - Error: " . $e->getMessage());
    error_log("❌ desinfectantes_fetch.php - Trace: " . $e->getTraceAsString());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 