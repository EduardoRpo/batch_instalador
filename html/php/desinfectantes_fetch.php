<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    error_log("🔍 desinfectantes_fetch.php - Iniciando consulta de desinfectantes");
    
    // Verificar qué tablas relacionadas con desinfectantes existen
    $check_tables = "SHOW TABLES LIKE '%desinfect%'";
    $stmt_check = $conn->prepare($check_tables);
    $stmt_check->execute();
    $tables = $stmt_check->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 desinfectantes_fetch.php - Tablas encontradas: " . json_encode($tables));
    
    // Buscar la tabla correcta
    $table_name = null;
    foreach ($tables as $table) {
        $table_name = array_values($table)[0];
        break;
    }
    
    if (!$table_name) {
        // Si no encuentra tabla, buscar en otras tablas que puedan contener desinfectantes
        $check_other_tables = "SHOW TABLES LIKE '%producto%'";
        $stmt_other = $conn->prepare($check_other_tables);
        $stmt_other->execute();
        $other_tables = $stmt_other->fetchAll(PDO::FETCH_ASSOC);
        
        error_log("🔍 desinfectantes_fetch.php - Otras tablas encontradas: " . json_encode($other_tables));
        
        // Intentar con tabla productos si existe
        foreach ($other_tables as $table) {
            $table_name = array_values($table)[0];
            if (strpos(strtolower($table_name), 'producto') !== false) {
                break;
            }
        }
    }
    
    if (!$table_name) {
        error_log("❌ desinfectantes_fetch.php - No se encontró tabla para desinfectantes");
        http_response_code(404);
        echo json_encode(['error' => 'Tabla de desinfectantes no encontrada']);
        exit;
    }
    
    error_log("🔍 desinfectantes_fetch.php - Usando tabla: $table_name");
    
    // Verificar la estructura de la tabla
    $check_columns = "DESCRIBE $table_name";
    $stmt_columns = $conn->prepare($check_columns);
    $stmt_columns->execute();
    $columns = $stmt_columns->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 desinfectantes_fetch.php - Estructura de tabla $table_name: " . json_encode($columns));
    
    // Buscar columnas de id y nombre
    $id_column = 'id';
    $nombre_column = 'nombre';
    
    foreach ($columns as $column) {
        $field = strtolower($column['Field']);
        if ($field === 'id' || $field === 'id_desinfectante') {
            $id_column = $column['Field'];
        }
        if ($field === 'nombre' || $field === 'descripcion' || $field === 'producto') {
            $nombre_column = $column['Field'];
        }
    }
    
    error_log("🔍 desinfectantes_fetch.php - Usando columnas: id=$id_column, nombre=$nombre_column");
    
    // Consulta para obtener desinfectantes
    $sql = "SELECT $id_column as id, $nombre_column as nombre 
            FROM $table_name 
            ORDER BY $id_column ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $desinfectantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 desinfectantes_fetch.php - Desinfectantes encontrados: " . count($desinfectantes));
    error_log("🔍 desinfectantes_fetch.php - Datos: " . json_encode($desinfectantes));
    
    echo json_encode($desinfectantes, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ desinfectantes_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 