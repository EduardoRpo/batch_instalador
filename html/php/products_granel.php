<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT referencia, nombre_referencia, marca, propietario, producto, 
                   presentacion_comercial, linea, densidad_producto, ajuste, 
                   notificacion_sanitaria 
            FROM producto 
            WHERE tipo = 'Granel' 
            ORDER BY nombre_referencia";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($products);
    
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?> 