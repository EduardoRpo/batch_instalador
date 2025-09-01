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
    
    // Consulta SQL real a la base de datos
    $sql = "SELECT p.id as id_pregunta, p.pregunta 
            FROM preguntas AS p 
            INNER JOIN modulo_pregunta AS mp ON mp.id_pregunta = p.id 
            WHERE mp.id_modulo = :modulo 
            ORDER BY p.id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['modulo' => $modulo]);
    $preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 questions_fetch.php - Consulta ejecutada: $sql");
    error_log("🔍 questions_fetch.php - Parámetro módulo: $modulo");
    error_log("🔍 questions_fetch.php - Preguntas encontradas: " . count($preguntas));
    error_log("🔍 questions_fetch.php - Datos: " . json_encode($preguntas));
    
    // Si no hay preguntas, devolver array vacío
    if (empty($preguntas)) {
        error_log("⚠️ questions_fetch.php - No se encontraron preguntas para el módulo $modulo");
        echo json_encode([], JSON_NUMERIC_CHECK);
    } else {
        echo json_encode($preguntas, JSON_NUMERIC_CHECK);
    }
    
} catch (Exception $e) {
    error_log("❌ questions_fetch.php - Error: " . $e->getMessage());
    error_log("❌ questions_fetch.php - Trace: " . $e->getTraceAsString());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 