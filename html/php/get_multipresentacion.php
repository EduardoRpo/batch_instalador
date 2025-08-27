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
    
    // Consulta corregida usando mul.total en lugar de mul.tamanio
    $sql = "SELECT mul.id, mul.referencia, mul.cantidad, mul.total,
                   prod.nombre_referencia,
                   CONCAT(mul.referencia, ' - ', prod.nombre_referencia) as referencia_completa
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
        
        $formatted_data[] = [
            'id' => $multi['id'],
            'referencia' => $multi['referencia'],
            'nombre_referencia' => $multi['nombre_referencia'],
            'referencia_completa' => $multi['referencia_completa'],
            'cantidad' => intval($multi['cantidad']),
            'tamanio' => floatval($multi['total']), // Usar total como tamanio
            'total' => floatval($multi['total'])
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