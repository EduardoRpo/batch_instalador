<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Obtener el ID del batch de la URL
    $idBatch = $_GET['id'] ?? null;
    
    if (!$idBatch) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de batch no proporcionado']);
        exit;
    }
    
    error_log("🔍 batch_info_fetch.php - Buscando batch con ID: $idBatch");
    
    // Consulta para obtener información del batch
    $sql = "SELECT b.id_batch, b.pedido, p.referencia, p.nombre_referencia, pc.nombre AS presentacion, m.nombre AS marca, 
                   ns.nombre AS notificacion_sanitaria, p.unidad_empaque, pp.nombre as propietario, b.numero_orden, b.tamano_lote, b.numero_lote, 
                   b.unidad_lote, l.nombre as linea, l.densidad, p.densidad_producto, b.fecha_programacion, b.fecha_creacion, b.estado, p.img, 
                   DATE_ADD(exp.fecha_insumo, INTERVAL 8 DAY) AS fecha_insumo, 
                   IFNULL(bt.tanque,0) AS tanque, IFNULL(bt.cantidad,0) AS cantidad
            FROM batch b
            INNER JOIN producto p ON p.referencia = b.id_producto
            LEFT JOIN multipresentacion mul ON mul.id_batch = b.id_batch
            INNER JOIN presentacion_comercial pc ON pc.id = p.presentacion_comercial 
            INNER JOIN linea l ON l.id = p.id_linea 
            INNER JOIN propietario pp ON pp.id = p.id_propietario 
            INNER JOIN marca m ON m.id = p.id_marca
            INNER JOIN notificacion_sanitaria ns ON ns.id = p.id_notificacion_sanitaria
            LEFT JOIN plan_pedidos exp ON exp.id_producto = mul.referencia
            LEFT JOIN batch_tanques bt ON bt.id_batch = b.id_batch
            WHERE b.id_batch = :idBatch
            ORDER BY exp.fecha_insumo DESC LIMIT 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idBatch' => $idBatch]);
    $batch = $stmt->fetch(PDO::FETCH_ASSOC);
    
    error_log("🔍 batch_info_fetch.php - Resultado de consulta: " . json_encode($batch));
    
    if ($batch) {
        echo json_encode($batch, JSON_NUMERIC_CHECK);
    } else {
        // Si no encuentra con la consulta principal, intentar una consulta más simple
        error_log("🔍 batch_info_fetch.php - No se encontró con consulta principal, intentando consulta simple...");
        
        $sql_simple = "SELECT b.id_batch, b.pedido, p.referencia, p.nombre_referencia, 
                              pc.nombre AS presentacion, m.nombre AS marca, 
                              ns.nombre AS notificacion_sanitaria, p.unidad_empaque, pp.nombre as propietario, 
                              b.numero_orden, b.tamano_lote, b.numero_lote, 
                              b.unidad_lote, l.nombre as linea, l.densidad, p.densidad_producto, 
                              b.fecha_programacion, b.fecha_creacion, b.estado, p.img,
                              IFNULL(bt.tanque,0) AS tanque, IFNULL(bt.cantidad,0) AS cantidad
                       FROM batch b
                       INNER JOIN producto p ON p.referencia = b.id_producto
                       INNER JOIN presentacion_comercial pc ON pc.id = p.presentacion_comercial 
                       INNER JOIN linea l ON l.id = p.id_linea 
                       INNER JOIN propietario pp ON pp.id = p.id_propietario 
                       INNER JOIN marca m ON m.id = p.id_marca
                       INNER JOIN notificacion_sanitaria ns ON ns.id = p.id_notificacion_sanitaria
                       LEFT JOIN batch_tanques bt ON bt.id_batch = b.id_batch
                       WHERE b.id_batch = :idBatch";
        
        $stmt_simple = $conn->prepare($sql_simple);
        $stmt_simple->execute(['idBatch' => $idBatch]);
        $batch_simple = $stmt_simple->fetch(PDO::FETCH_ASSOC);
        
        error_log("🔍 batch_info_fetch.php - Resultado de consulta simple: " . json_encode($batch_simple));
        
        if ($batch_simple) {
            echo json_encode($batch_simple, JSON_NUMERIC_CHECK);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Batch no encontrado']);
        }
    }
    
} catch (Exception $e) {
    error_log("❌ batch_info_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 