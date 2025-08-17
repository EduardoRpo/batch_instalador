<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verificar estructura de producto
    $sql = "DESCRIBE producto";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $producto_columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Verificar si existe tabla propietario
    $sql = "SHOW TABLES LIKE 'propietario'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $propietario_exists = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Obtener algunos registros de producto para ver qué campos tienen
    $sql = "SELECT * FROM producto LIMIT 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $producto_sample = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $response = [
        'producto_columns' => $producto_columns,
        'propietario_exists' => $propietario_exists,
        'producto_sample' => $producto_sample
    ];
    
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?> 