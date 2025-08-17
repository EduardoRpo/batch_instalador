<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener todas las tablas
    $sql = "SHOW TABLES";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Verificar si existe alguna tabla relacionada con pedidos
    $pedidos_tables = array_filter($tables, function($table) {
        return stripos($table, 'pedido') !== false || 
               stripos($table, 'orden') !== false || 
               stripos($table, 'order') !== false;
    });
    
    // Verificar estructura de la tabla batch para ver si tiene datos de pedidos
    $sql = "DESCRIBE batch";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $batch_columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Obtener algunos registros de batch para ver qué datos tenemos
    $sql = "SELECT * FROM batch LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $batch_sample = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $response = [
        'all_tables' => $tables,
        'pedidos_related_tables' => array_values($pedidos_tables),
        'batch_columns' => $batch_columns,
        'batch_sample' => $batch_sample
    ];
    
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?> 