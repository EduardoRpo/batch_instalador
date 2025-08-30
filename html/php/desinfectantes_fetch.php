<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    error_log("🔍 desinfectantes_fetch.php - Iniciando consulta de desinfectantes");
    
    // Consulta para obtener desinfectantes
    $sql = "SELECT id, nombre 
            FROM productos_desinfeccion 
            ORDER BY id ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $desinfectantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 desinfectantes_fetch.php - Desinfectantes encontrados: " . count($desinfectantes));
    error_log("🔍 desinfectantes_fetch.php - Datos: " . json_encode($desinfectantes));
    
    // Si no encuentra datos, usar valores por defecto
    if (empty($desinfectantes)) {
        error_log("🔍 desinfectantes_fetch.php - No se encontraron desinfectantes, usando valores por defecto");
        $desinfectantes = [
            ['id' => 1, 'nombre' => 'Alcohol 70%'],
            ['id' => 2, 'nombre' => 'Hipoclorito de Sodio'],
            ['id' => 3, 'nombre' => 'Agua Destilada']
        ];
    }
    
    echo json_encode($desinfectantes, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ desinfectantes_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 