<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

// Log para debugging
error_log("=== GET_MULTIPRESENTACION.PHP INICIADO ===");

try {
    // Obtener el ID del batch desde la petición
    $id_batch = $_POST['id_batch'] ?? $_GET['id_batch'] ?? null;
    
    error_log("ID de batch recibido: " . $id_batch);
    
    if (!$id_batch) {
        throw new Exception('ID de batch no proporcionado');
    }
    
    // Primero verificar la estructura de la tabla multipresentacion
    error_log("Verificando estructura de tabla multipresentacion...");
    $stmt_describe = $conn->prepare("DESCRIBE multipresentacion");
    $stmt_describe->execute();
    $columns = $stmt_describe->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("Columnas de multipresentacion:");
    foreach ($columns as $column) {
        error_log("  - " . $column['Field'] . " (" . $column['Type'] . ")");
    }
    
    // Verificar si hay datos para este batch
    $stmt_check = $conn->prepare("SELECT COUNT(*) as total FROM multipresentacion WHERE id_batch = :id_batch");
    $stmt_check->bindParam(':id_batch', $id_batch, PDO::PARAM_INT);
    $stmt_check->execute();
    $count_result = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
    error_log("Total de registros para batch " . $id_batch . ": " . $count_result['total']);
    
    // Si hay registros, mostrar uno como ejemplo
    if ($count_result['total'] > 0) {
        $stmt_sample = $conn->prepare("SELECT * FROM multipresentacion WHERE id_batch = :id_batch LIMIT 1");
        $stmt_sample->bindParam(':id_batch', $id_batch, PDO::PARAM_INT);
        $stmt_sample->execute();
        $sample = $stmt_sample->fetch(PDO::FETCH_ASSOC);
        error_log("Ejemplo de registro: " . json_encode($sample));
    }
    
    // Consulta adaptada según las columnas reales
    // Por ahora usamos una consulta básica para ver qué columnas existen
    $sql = "SELECT mul.*, prod.nombre_referencia
            FROM multipresentacion mul 
            INNER JOIN producto prod ON mul.referencia = prod.referencia 
            WHERE mul.id_batch = :id_batch 
            ORDER BY mul.id ASC";
    
    error_log("SQL Query: " . $sql);
    error_log("Parámetro id_batch: " . $id_batch);
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_batch', $id_batch, PDO::PARAM_INT);
    $stmt->execute();
    
    $multipresentaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("Registros encontrados: " . count($multipresentaciones));
    
    // Formatear datos para el modal
    $formatted_data = [];
    foreach ($multipresentaciones as $multi) {
        error_log("Procesando registro: " . json_encode($multi));
        
        // Crear referencia_completa
        $referencia_completa = $multi['nombre_referencia'] . ' - ' . $multi['referencia'];
        
        $formatted_data[] = [
            'id' => $multi['id'],
            'referencia' => $multi['referencia'],
            'nombre_referencia' => $multi['nombre_referencia'],
            'referencia_completa' => $referencia_completa,
            'cantidad' => intval($multi['cantidad'] ?? 0),
            'tamanio' => floatval($multi['tamanio'] ?? 0), // Intentar con tamanio, si no existe será 0
            'total' => floatval($multi['total'] ?? 0)
        ];
    }
    
    // Respuesta exitosa
    $response = [
        'success' => true,
        'data' => $formatted_data,
        'total' => count($formatted_data)
    ];
    
    error_log("Respuesta final: " . json_encode($response));
    echo json_encode($response);
    
} catch (Exception $e) {
    error_log("ERROR en get_multipresentacion.php: " . $e->getMessage());
    // Respuesta de error
    $response = [
        'success' => false,
        'error' => $e->getMessage(),
        'data' => []
    ];
    
    echo json_encode($response);
}
?> 