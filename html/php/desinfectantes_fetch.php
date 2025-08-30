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
    
    error_log("🔍 desinfectantes_fetch.php - Desinfectantes encontrados: " . count($desinfectantes));
    error_log("🔍 desinfectantes_fetch.php - Datos: " . json_encode($desinfectantes));
    
    // Si no encuentra datos, devolver datos de prueba
    if (empty($desinfectantes)) {
        error_log("🔍 desinfectantes_fetch.php - No se encontraron datos, devolviendo datos de prueba");
        $desinfectantes = [
            [
                'id' => 1,
                'nombre' => 'Alcohol'
            ],
            [
                'id' => 2,
                'nombre' => 'Pure citrus'
            ],
            [
                'id' => 3,
                'nombre' => 'Glutapure'
            ],
            [
                'id' => 4,
                'nombre' => 'Sterilex a'
            ],
            [
                'id' => 5,
                'nombre' => 'Sterilex b'
            ]
        ];
    }
    
    echo json_encode($desinfectantes, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ desinfectantes_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 