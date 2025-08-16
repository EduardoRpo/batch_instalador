<?php
require_once __DIR__ . '/../../env.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Conectar a la base de datos usando PDO
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener estructura de la tabla batch
    $sql = "DESCRIBE batch";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Obtener una muestra de datos
    $sql_sample = "SELECT * FROM batch LIMIT 1";
    $stmt_sample = $conn->prepare($sql_sample);
    $stmt_sample->execute();
    $sample_data = $stmt_sample->fetch(PDO::FETCH_ASSOC);
    
    // Obtener información de la tabla
    $sql_info = "SHOW TABLE STATUS LIKE 'batch'";
    $stmt_info = $conn->prepare($sql_info);
    $stmt_info->execute();
    $table_info = $stmt_info->fetch(PDO::FETCH_ASSOC);
    
    $response = [
        'success' => true,
        'table_info' => $table_info,
        'columns' => $columns,
        'sample_data' => $sample_data
    ];
    
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'error' => 'Error de base de datos: ' . $e->getMessage()
    ];
    
    echo json_encode($response, JSON_PRETTY_PRINT);
}
?> 