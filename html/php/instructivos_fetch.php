<?php
/**
 * ARCHIVO NUEVO - Creado para evitar errores de API /api/instructivos
 * Consulta directamente la tabla instructivo_preparacion
 * Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
 * Motivo: La API /api/instructivos devuelve error 500
 */
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener referencia del parámetro GET
    $referencia = $_GET['referencia'] ?? '';
    
    if (empty($referencia)) {
        echo json_encode(['error' => 'Referencia no especificada']);
        exit;
    }
    
    // Consultar instructivos de preparación para el producto
    $sql = "SELECT id, pasos, tiempo FROM instructivo_preparacion WHERE id_producto = :referencia ORDER BY id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['referencia' => $referencia]);
    $instructivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($instructivos, JSON_UNESCAPED_UNICODE);
    
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de base de datos: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error general: ' . $e->getMessage()]);
}
?> 