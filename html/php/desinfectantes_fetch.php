<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    error_log("🔍 desinfectantes_fetch.php - Iniciando consulta de desinfectantes");
    
    // Datos de prueba para desinfectantes
    $desinfectantes = [
        [
            'id' => 1,
            'nombre' => 'Desinfectante A'
        ],
        [
            'id' => 2,
            'nombre' => 'Desinfectante B'
        ],
        [
            'id' => 3,
            'nombre' => 'Desinfectante C'
        ],
        [
            'id' => 4,
            'nombre' => 'Desinfectante D'
        ]
    ];
    
    error_log("🔍 desinfectantes_fetch.php - Desinfectantes encontrados: " . count($desinfectantes));
    error_log("🔍 desinfectantes_fetch.php - Datos: " . json_encode($desinfectantes));
    
    echo json_encode($desinfectantes, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ desinfectantes_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 