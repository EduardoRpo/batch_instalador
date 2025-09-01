<?php
/**
 * Archivo fetch.php para reemplazar /api/materiasp/{idProduct}
 * Obtiene datos de materias primas para un producto específico
 * Creado para resolver error 500 en /api/materiasp/Granel-67
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
    $idProduct = $_GET['idProduct'] ?? '';
    
    error_log("🔍 materiasp_fetch.php - Parámetros recibidos: idProduct=$idProduct");
    
    if (empty($idProduct)) {
        throw new Exception('Parámetro idProduct es requerido');
    }
    
    // Consulta para obtener materias primas de la fórmula
    // Intentar primero con AES_DECRYPT
    $sql = "SELECT f.id, mp.referencia, mp.alias, 
                   CAST(AES_DECRYPT(f.porcentaje, 'Wf[Ht^}2YL=D^DPD') AS CHAR) as porcentaje
            FROM formula f 
            INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
            WHERE f.id_producto = :referencia
            ORDER BY f.id ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['referencia' => $idProduct]);
    $materias_primas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 materiasp_fetch.php - Materias primas encontradas: " . count($materias_primas));
    
    // Si no encuentra datos o hay error con AES_DECRYPT, intentar sin encriptación
    if (empty($materias_primas)) {
        error_log("🔍 materiasp_fetch.php - Intentando consulta sin AES_DECRYPT");
        
        $sql = "SELECT f.id, mp.referencia, mp.alias, f.porcentaje
                FROM formula f 
                INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
                WHERE f.id_producto = :referencia
                ORDER BY f.id ASC";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(['referencia' => $idProduct]);
        $materias_primas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        error_log("🔍 materiasp_fetch.php - Materias primas encontradas (sin encriptación): " . count($materias_primas));
    }
    
    // Procesar los datos
    $resultado = [];
    foreach ($materias_primas as $mp) {
        $porcentaje = floatval($mp['porcentaje']);
        
        $resultado[] = [
            'id' => $mp['id'],
            'referencia' => $mp['referencia'],
            'alias' => $mp['alias'],
            'porcentaje' => $porcentaje
        ];
        
        error_log("🔍 materiasp_fetch.php - MP: {$mp['alias']}, %: $porcentaje");
    }
    
    // Si no encuentra datos, devolver array vacío
    if (empty($resultado)) {
        error_log("⚠️ materiasp_fetch.php - No se encontraron materias primas para la referencia: $idProduct");
    }
    
    error_log("🔍 materiasp_fetch.php - Datos finales: " . json_encode($resultado));
    echo json_encode($resultado, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ materiasp_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 