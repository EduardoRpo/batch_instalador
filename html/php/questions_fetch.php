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
    
    // Primero verificar si la tabla existe y su estructura
    $check_table = "SHOW TABLES LIKE 'preguntas'";
    $stmt_check = $conn->prepare($check_table);
    $stmt_check->execute();
    $table_exists = $stmt_check->fetch();
    
    if (!$table_exists) {
        error_log("❌ questions_fetch.php - Tabla 'preguntas' no existe");
        http_response_code(404);
        echo json_encode(['error' => 'Tabla preguntas no encontrada']);
        exit;
    }
    
    // Verificar la estructura de la tabla
    $check_columns = "DESCRIBE preguntas";
    $stmt_columns = $conn->prepare($check_columns);
    $stmt_columns->execute();
    $columns = $stmt_columns->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 questions_fetch.php - Estructura de tabla preguntas: " . json_encode($columns));
    
    // Buscar la columna correcta para el módulo
    $modulo_column = null;
    foreach ($columns as $column) {
        if (strpos(strtolower($column['Field']), 'modulo') !== false) {
            $modulo_column = $column['Field'];
            break;
        }
    }
    
    if (!$modulo_column) {
        error_log("❌ questions_fetch.php - No se encontró columna de módulo");
        http_response_code(404);
        echo json_encode(['error' => 'Columna de módulo no encontrada']);
        exit;
    }
    
    error_log("🔍 questions_fetch.php - Usando columna: $modulo_column");
    
    // Consulta para obtener preguntas del módulo
    $sql = "SELECT id, pregunta, $modulo_column as modulo 
            FROM preguntas 
            WHERE $modulo_column = :modulo 
            ORDER BY id ASC";
    
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