<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Obtener parámetros de la URL
    $referencia = $_GET['referencia'] ?? null;
    $tamano_lote = $_GET['tamano_lote'] ?? null;
    
    if (!$referencia || !$tamano_lote) {
        http_response_code(400);
        echo json_encode(['error' => 'Parámetros referencia y tamano_lote son requeridos']);
        exit;
    }
    
    error_log("🔍 pesaje_dispensacion_fetch.php - Buscando datos para referencia: $referencia, tamaño lote: $tamano_lote");
    
    // Consulta para obtener datos de pesaje y dispensación
    $sql = "SELECT 
                mp.referencia,
                mp.alias,
                mp.lote,
                mp.peso_total as pesoTotal
            FROM materia_prima mp
            INNER JOIN producto p ON p.referencia = :referencia
            WHERE mp.id_producto = p.referencia
            ORDER BY mp.id ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['referencia' => $referencia]);
    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 pesaje_dispensacion_fetch.php - Datos encontrados: " . count($datos));
    error_log("🔍 pesaje_dispensacion_fetch.php - Datos: " . json_encode($datos));
    
    // Si no encuentra datos, devolver estructura vacía
    if (empty($datos)) {
        error_log("🔍 pesaje_dispensacion_fetch.php - No se encontraron datos, devolviendo estructura vacía");
        $datos = [];
    }
    
    echo json_encode($datos, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ pesaje_dispensacion_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 