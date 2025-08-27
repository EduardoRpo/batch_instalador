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
    
    // Consulta para obtener multipresentaciones del batch
    $sql = "SELECT id, referencia, cantidad, tamanio, total 
            FROM multipresentacion 
            WHERE id_batch = :id_batch 
            ORDER BY id ASC";
    
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