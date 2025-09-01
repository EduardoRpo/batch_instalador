<?php
/**
 * Archivo fetch.php para reemplazar /api/user/{modulo}/{batch}
 * Obtiene datos de usuario para un módulo y batch específico
 * Creado para resolver error 500 en /api/user/2/5559
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
    $modulo = $_GET['modulo'] ?? '';
    $batch = $_GET['batch'] ?? '';
    
    error_log("🔍 user_fetch.php - Parámetros recibidos: modulo=$modulo, batch=$batch");
    
    if (empty($modulo) || empty($batch)) {
        throw new Exception('Parámetros modulo y batch son requeridos');
    }
    
    // Primero buscar en batch_desinfectante_seleccionado
    $sql = "SELECT realizo FROM batch_desinfectante_seleccionado WHERE modulo = :modulo AND batch = :batch";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['modulo' => $modulo, 'batch' => $batch]);
    $idUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("🔍 user_fetch.php - Usuario encontrado en batch_desinfectante_seleccionado: " . json_encode($idUsuario));
    
    $user = null;
    
    // Si no existe usuario en batch desinfectante, usar usuario por defecto
    if (empty($idUsuario)) {
        error_log("🔍 user_fetch.php - No se encontró usuario en batch_desinfectante_seleccionado, usando usuario por defecto");
        
        $sql = "SELECT CONCAT(nombre, ' ', apellido) AS nombres FROM usuario WHERE id_cargo = :id_cargo";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_cargo' => 12]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        error_log("🔍 user_fetch.php - Usuario por defecto encontrado: " . json_encode($user));
    } else {
        // Encontrar Usuario por ID
        $sql = "SELECT CONCAT(nombre, ' ', apellido) AS nombres FROM usuario WHERE id = :idUser";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idUser' => $idUsuario[0]['realizo']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        error_log("🔍 user_fetch.php - Usuario encontrado por ID: " . json_encode($user));
    }
    
    // Si no encuentra datos, devolver array vacío
    if (empty($user)) {
        error_log("⚠️ user_fetch.php - No se encontró usuario para modulo=$modulo, batch=$batch");
        $user = [];
    }
    
    error_log("🔍 user_fetch.php - Datos finales: " . json_encode($user));
    echo json_encode($user, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ user_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 