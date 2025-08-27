<?php
require_once __DIR__ . '/env.php';

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== ESTRUCTURA DE LA TABLA BATCH ===\n";
    $stmt = $conn->prepare("DESCRIBE batch");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($columns as $column) {
        echo "Campo: " . $column['Field'] . " | Tipo: " . $column['Type'] . " | Null: " . $column['Null'] . " | Default: " . $column['Default'] . "\n";
    }
    
    echo "\n=== ÚLTIMOS 5 REGISTROS DE BATCH ===\n";
    $stmt = $conn->prepare("SELECT * FROM batch ORDER BY id_batch DESC LIMIT 5");
    $stmt->execute();
    $batches = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($batches as $batch) {
        echo "ID: " . $batch['id_batch'] . " | Producto: " . $batch['id_producto'] . " | Tamaño: " . $batch['tamano_lote'] . " | Estado: " . $batch['estado'] . "\n";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 