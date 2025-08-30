<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Obtener el módulo de la URL
    $modulo = $_GET['modulo'] ?? null;
    
    if (!$modulo) {
        http_response_code(400);
        echo json_encode(['error' => 'Módulo no proporcionado']);
        exit;
    }
    
    error_log("🔍 questions_fetch.php - Buscando preguntas para módulo: $modulo");
    
    // Consulta para obtener preguntas del módulo
    $sql = "SELECT id_pregunta, pregunta, modulo 
            FROM preguntas 
            WHERE modulo = :modulo 
            ORDER BY id_pregunta ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['modulo' => $modulo]);
    $preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 questions_fetch.php - Preguntas encontradas: " . count($preguntas));
    error_log("🔍 questions_fetch.php - Datos: " . json_encode($preguntas));
    
    echo json_encode($preguntas, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ questions_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 