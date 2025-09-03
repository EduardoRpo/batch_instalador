<?php
/**
 * ARCHIVO NUEVO - Creado para guardar la cantidad de agua en batch_lote_materiales
 * Actualiza el campo lote donde batch=X y ref_material=10003
 * Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
 * Motivo: Guardar cantidad de agua ingresada en el control de proceso
 */

require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    // Validar parámetros recibidos
    $batch = $_POST['batch'] ?? null;
    $ref_material = $_POST['ref_material'] ?? null;
    $cantidad_agua = $_POST['cantidad_agua'] ?? null;
    
    if (!$batch || !$ref_material || !$cantidad_agua) {
        echo json_encode(['error' => 'Parámetros incompletos']);
        exit;
    }
    
    // Validar que ref_material sea 10003 (agua)
    if ($ref_material != 10003) {
        echo json_encode(['error' => 'ref_material debe ser 10003 para agua']);
        exit;
    }
    
    // Validar que cantidad_agua sea un número válido
    if (!is_numeric($cantidad_agua) || $cantidad_agua <= 0) {
        echo json_encode(['error' => 'cantidad_agua debe ser un número positivo']);
        exit;
    }
    
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Primero verificar si existe el registro
    $sqlCheck = "SELECT id FROM batch_lote_materiales WHERE batch = :batch AND ref_material = :ref_material";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->execute(['batch' => $batch, 'ref_material' => $ref_material]);
    $existe = $stmtCheck->fetch();
    
    if (!$existe) {
        // No existe el registro, no se hace nada
        echo json_encode(['success' => false, 'message' => 'No se encontró registro de agua para este batch']);
        exit;
    }
    
    // Existe el registro, actualizar el campo lote
    $sqlUpdate = "UPDATE batch_lote_materiales SET lote = :cantidad_agua WHERE batch = :batch AND ref_material = :ref_material";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $resultado = $stmtUpdate->execute([
        'cantidad_agua' => $cantidad_agua,
        'batch' => $batch,
        'ref_material' => $ref_material
    ]);
    
    if ($resultado) {
        echo json_encode(['success' => true, 'message' => 'Cantidad de agua actualizada correctamente']);
    } else {
        echo json_encode(['error' => 'Error al actualizar la cantidad de agua']);
    }
    
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de base de datos: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error general: ' . $e->getMessage()]);
}
?> 