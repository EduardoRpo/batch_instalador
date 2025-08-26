<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Obtener los datos desde la petición POST
    $id_batch = $_POST['id_batch'] ?? null;
    $observacion = $_POST['observacion'] ?? null;
    
    if (!$id_batch || !$observacion) {
        throw new Exception('ID de batch y observación son requeridos');
    }
    
    // Validar que la observación tenga al menos 20 caracteres
    if (strlen($observacion) < 20) {
        throw new Exception('La observación debe tener al menos 20 caracteres');
    }
    
    // Obtener información del batch para la tabla observaciones_batch_inactivos
    $sql_batch = "SELECT id_producto, numero_lote FROM batch WHERE id_batch = :id_batch";
    $stmt_batch = $conn->prepare($sql_batch);
    $stmt_batch->bindParam(':id_batch', $id_batch, PDO::PARAM_INT);
    $stmt_batch->execute();
    $batch_info = $stmt_batch->fetch(PDO::FETCH_ASSOC);
    
    if (!$batch_info) {
        throw new Exception('Batch no encontrado');
    }
    
    // Insertar la nueva observación
    $sql = "INSERT INTO observaciones_batch_inactivos (observacion, batch, referencia, fecha_registro) 
            VALUES (:observacion, :batch, :referencia, CURDATE())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':observacion', $observacion, PDO::PARAM_STR);
    $stmt->bindParam(':batch', $id_batch, PDO::PARAM_INT);
    $stmt->bindParam(':referencia', $batch_info['id_producto'], PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        // Respuesta exitosa
        $response = [
            'success' => true,
            'message' => 'Observación guardada correctamente',
            'id_batch' => $id_batch
        ];
    } else {
        throw new Exception('Error al guardar la observación');
    }
    
    echo json_encode($response);
    
} catch (Exception $e) {
    // Respuesta de error
    $response = [
        'success' => false,
        'error' => $e->getMessage()
    ];
    
    echo json_encode($response);
}
?> 