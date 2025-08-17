<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verificar si hay tabla de clientes/empresas
    $sql = "SHOW TABLES LIKE '%cliente%'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $cliente_tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Verificar si hay tabla de empresas
    $sql = "SHOW TABLES LIKE '%empresa%'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $empresa_tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Verificar estructura de explosion_materiales_pedidos
    $sql = "DESCRIBE explosion_materiales_pedidos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $explosion_columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Obtener algunos registros de explosion_materiales_pedidos
    $sql = "SELECT * FROM explosion_materiales_pedidos LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $explosion_sample = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Verificar estructura de trck_pedidos_pendientes
    $sql = "DESCRIBE trck_pedidos_pendientes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $trck_columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Obtener algunos registros de trck_pedidos_pendientes
    $sql = "SELECT * FROM trck_pedidos_pendientes LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $trck_sample = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $response = [
        'cliente_tables' => $cliente_tables,
        'empresa_tables' => $empresa_tables,
        'explosion_columns' => $explosion_columns,
        'explosion_sample' => $explosion_sample,
        'trck_columns' => $trck_columns,
        'trck_sample' => $trck_sample
    ];
    
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?> 