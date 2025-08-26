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
    
    // Insertar la nueva observación con solo los campos requeridos
    $sql = "INSERT INTO observaciones_batch_inactivos (observacion, batch, fecha_registro) 
            VALUES (:observacion, :batch, CURDATE())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':observacion', $observacion, PDO::PARAM_STR);
    $stmt->bindParam(':batch', $id_batch, PDO::PARAM_INT);
    
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