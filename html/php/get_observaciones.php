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
    
    // Consulta para obtener observaciones del batch
    $sql = "SELECT id, observacion, fecha_registro, referencia 
            FROM observaciones_batch_inactivos 
            WHERE batch = :id_batch 
            ORDER BY fecha_registro DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_batch', $id_batch, PDO::PARAM_INT);
    $stmt->execute();
    
    $observaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Formatear datos para el modal
    $formatted_data = [];
    foreach ($observaciones as $obs) {
        $formatted_data[] = [
            'fecha_registro' => $obs['fecha_registro'],
            'observacion' => $obs['observacion'],
            'referencia' => $obs['referencia']
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