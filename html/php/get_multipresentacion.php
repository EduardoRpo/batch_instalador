<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Obtener el ID del batch desde la petición
    $id_batch = $_POST['id_batch'] ?? $_GET['id_batch'] ?? null;
    
    if (!$id_batch) {
        throw new Exception('ID de batch no proporcionado');
    }
    
    // Consulta para obtener multipresentaciones del batch con INNER JOIN a producto
    $sql = "SELECT mul.id, mul.referencia, mul.cantidad, mul.tamanio, mul.total,
                   prod.nombre_referencia,
                   CONCAT(prod.nombre_referencia, ' - ', mul.referencia) as referencia_completa
            FROM multipresentacion mul 
            INNER JOIN producto prod ON mul.referencia = prod.referencia 
            WHERE mul.id_batch = :id_batch 
            ORDER BY mul.id ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_batch', $id_batch, PDO::PARAM_INT);
    $stmt->execute();
    
    $multipresentaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Formatear datos para el modal
    $formatted_data = [];
    foreach ($multipresentaciones as $multi) {
        $formatted_data[] = [
            'id' => $multi['id'],
            'referencia' => $multi['referencia'],
            'nombre_referencia' => $multi['nombre_referencia'],
            'referencia_completa' => $multi['referencia_completa'],
            'cantidad' => intval($multi['cantidad']),
            'tamanio' => floatval($multi['tamanio']),
            'total' => floatval($multi['total'])
        ];
    }
    
    // Respuesta exitosa
    $response = [
        'success' => true,
        'data' => $formatted_data,
        'total' => count($formatted_data)
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    // Respuesta de error
    $response = [
        'success' => false,
        'error' => $e->getMessage(),
        'data' => []
    ];
    
    echo json_encode($response);
}
?> 