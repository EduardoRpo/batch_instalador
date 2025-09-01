<?php
/**
 * Archivo fetch.php para reemplazar /api/pesajeDispensacion
 * Obtiene datos de materia prima para pesaje y dispensación
 * Creado para resolver error de DataTables en tablePesaje
 *
 * @author Sistema
 * @version 1.0
 * @date 2025-01-01
 */
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Obtener parámetros de la URL
    $referencia = $_GET['referencia'] ?? '';
    $tamano_lote = $_GET['tamano_lote'] ?? 0;
    
    error_log("🔍 pesaje_dispensacion_fetch.php - Parámetros recibidos: referencia=$referencia, tamano_lote=$tamano_lote");
    
    if (empty($referencia)) {
        throw new Exception('Parámetro referencia es requerido');
    }
    
    // Consulta para obtener materias primas de la fórmula
    $sql = "SELECT f.id, mp.referencia, mp.alias, 
                   CAST(AES_DECRYPT(f.porcentaje, 'Wf[Ht^}2YL=D^DPD') AS CHAR) as porcentaje
            FROM formula f 
            INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
            WHERE f.id_producto = :referencia
            ORDER BY f.id ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['referencia' => $referencia]);
    $materias_primas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 pesaje_dispensacion_fetch.php - Materias primas encontradas: " . count($materias_primas));
    
    // Calcular peso total para cada materia prima
    $resultado = [];
    foreach ($materias_primas as $mp) {
        $porcentaje = floatval($mp['porcentaje']);
        $pesoTotal = ($porcentaje / 100) * $tamano_lote;
        
        $resultado[] = [
            'id' => $mp['id'],
            'referencia' => $mp['referencia'],
            'alias' => $mp['alias'],
            'porcentaje' => $porcentaje,
            'pesoTotal' => round($pesoTotal, 3)
        ];
        
        error_log("🔍 pesaje_dispensacion_fetch.php - MP: {$mp['alias']}, %: $porcentaje, Peso: $pesoTotal");
    }
    
    // Si no encuentra datos, devolver array vacío
    if (empty($resultado)) {
        error_log("⚠️ pesaje_dispensacion_fetch.php - No se encontraron materias primas para la referencia: $referencia");
    }
    
    error_log("🔍 pesaje_dispensacion_fetch.php - Datos finales: " . json_encode($resultado));
    echo json_encode($resultado, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ pesaje_dispensacion_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 