<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verificar datos con diferentes criterios
    $queries = [
        'total_batch' => "SELECT COUNT(*) as total FROM batch",
        'batch_estado_6_5' => "SELECT COUNT(*) as total FROM batch WHERE estado >= 6.5",
        'batch_estado_6' => "SELECT COUNT(*) as total FROM batch WHERE estado >= 6",
        'batch_control_firmas' => "SELECT COUNT(*) as total FROM batch_control_firmas WHERE modulo = 8",
        'batch_control_firmas_cantidad' => "SELECT COUNT(*) as total FROM batch_control_firmas WHERE modulo = 8 AND cantidad_firmas in (0, 1)",
        'datos_completos_6_5' => "SELECT COUNT(*) as total FROM batch b INNER JOIN batch_control_firmas bcf ON bcf.batch = b.id_batch WHERE b.estado >= 6.5 AND bcf.cantidad_firmas in (0, 1) AND bcf.modulo = 8",
        'datos_completos_6' => "SELECT COUNT(*) as total FROM batch b INNER JOIN batch_control_firmas bcf ON bcf.batch = b.id_batch WHERE b.estado >= 6 AND bcf.modulo = 8"
    ];
    
    $results = [];
    foreach ($queries as $key => $query) {
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $results[$key] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    // Mostrar algunos ejemplos de datos
    $stmt = $conn->prepare("SELECT id_batch, estado FROM batch WHERE estado >= 6 ORDER BY estado DESC LIMIT 5");
    $stmt->execute();
    $ejemplos_batch = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt = $conn->prepare("SELECT batch, modulo, cantidad_firmas FROM batch_control_firmas WHERE modulo = 8 LIMIT 5");
    $stmt->execute();
    $ejemplos_firmas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Verificar todos los módulos disponibles
    $stmt = $conn->prepare("SELECT DISTINCT modulo FROM batch_control_firmas ORDER BY modulo");
    $stmt->execute();
    $modulos_disponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $response = [
        'diagnostico' => $results,
        'ejemplos_batch' => $ejemplos_batch,
        'ejemplos_firmas' => $ejemplos_firmas,
        'modulos_disponibles' => $modulos_disponibles
    ];
    
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?> 