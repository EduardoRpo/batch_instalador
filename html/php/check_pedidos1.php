<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verificar estructura de pedidos1
    $sql = "DESCRIBE pedidos1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $pedidos1_columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Obtener algunos registros de pedidos1
    $sql = "SELECT * FROM pedidos1 LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $pedidos1_sample = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Verificar estructura de plan_pedidos
    $sql = "DESCRIBE plan_pedidos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $plan_pedidos_columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Obtener algunos registros de plan_pedidos
    $sql = "SELECT * FROM plan_pedidos LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $plan_pedidos_sample = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $response = [
        'pedidos1_columns' => $pedidos1_columns,
        'pedidos1_sample' => $pedidos1_sample,
        'plan_pedidos_columns' => $plan_pedidos_columns,
        'plan_pedidos_sample' => $plan_pedidos_sample
    ];
    
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?> 