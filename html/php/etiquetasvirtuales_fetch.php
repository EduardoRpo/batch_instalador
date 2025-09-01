<?php
/**
 * Archivo fetch.php para reemplazar /api/etiquetasvirtuales/{idProduct}/{batch}
 * Obtiene datos de materias primas, batch y tanques para etiquetas virtuales
 * Creado para resolver error 500 en APIs que usan MateriaPrimaDao
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
    $batch = $_GET['batch'] ?? '';
    
    error_log("🔍 etiquetasvirtuales_fetch.php - Parámetros recibidos: idProduct=$idProduct, batch=$batch");
    
    if (empty($idProduct) || empty($batch)) {
        throw new Exception('Parámetros idProduct y batch son requeridos');
    }
    
    // Consulta para obtener materias primas de la fórmula
    $sql = "SELECT f.id, mp.referencia, mp.alias, 
                   CAST(AES_DECRYPT(f.porcentaje, 'Wf[Ht^}2YL=D^DPD') AS CHAR) as porcentaje
            FROM formula f 
            INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
            WHERE f.id_producto = :referencia
            ORDER BY f.id ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['referencia' => $idProduct]);
    $materias_primas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Si no encuentra datos, intentar sin encriptación
    if (empty($materias_primas)) {
        $sql = "SELECT f.id, mp.referencia, mp.alias, f.porcentaje
                FROM formula f 
                INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
                WHERE f.id_producto = :referencia
                ORDER BY f.id ASC";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(['referencia' => $idProduct]);
        $materias_primas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Consulta para obtener datos del batch
    $sql = "SELECT CONCAT(us.nombre, ' ',us.apellido) as verifico, us.urlfirma, bf2.fecha_registro 
            FROM batch_firmas2seccion bf2 
            INNER JOIN usuario u ON bf2.realizo = u.id 
            INNER JOIN usuario us ON bf2.verifico = us.id 
            WHERE batch = :batch AND modulo = :modulo";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['batch' => $batch, 'modulo' => 2]);
    $batch_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Consulta para obtener tanques
    $sql = "SELECT tanques, tanquesOk FROM batch_tanques WHERE batch = :batch AND modulo = :modulo";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['batch' => $batch, 'modulo' => 2]);
    $tanques = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Combinar todos los datos
    $resultado = array_merge($materias_primas, $batch_data, $tanques);
    
    // Si no encuentra datos, devolver array vacío
    if (empty($resultado)) {
        error_log("⚠️ etiquetasvirtuales_fetch.php - No se encontraron datos para idProduct=$idProduct, batch=$batch");
    }
    
    error_log("🔍 etiquetasvirtuales_fetch.php - Datos finales: " . json_encode($resultado));
    echo json_encode($resultado, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ etiquetasvirtuales_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 