<?php
require_once __DIR__ . '/env.php';

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== VERIFICACIÓN DE ESTRUCTURA DE TABLA BATCH ===\n";
    
    // Verificar qué columnas existen en la tabla batch
    $stmt = $conn->prepare("DESCRIBE batch");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Columnas en tabla 'batch':\n";
    foreach ($columns as $column) {
        echo "- " . $column['Field'] . " (" . $column['Type'] . ")\n";
    }
    echo "\n";
    
    // Verificar qué columnas existen en la tabla producto
    $stmt = $conn->prepare("DESCRIBE producto");
    $stmt->execute();
    $producto_columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Columnas en tabla 'producto':\n";
    foreach ($producto_columns as $column) {
        echo "- " . $column['Field'] . " (" . $column['Type'] . ")\n";
    }
    echo "\n";
    
    // Intentar una consulta más simple primero
    echo "=== PRUEBA DE CONSULTA SIMPLE ===\n";
    $sql = "SELECT batch.id_batch, batch.id_producto as referencia, 
                   p.nombre_referencia, batch.numero_lote, batch.tamano_lote,
                   batch.estado
            FROM batch 
            INNER JOIN producto p ON p.referencia = batch.id_producto
            WHERE batch.estado >= 2
            LIMIT 5";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Datos encontrados: " . count($data) . "\n\n";
    
    if (count($data) > 0) {
        echo "Columnas disponibles en la consulta:\n";
        $first_row = $data[0];
        foreach ($first_row as $key => $value) {
            echo "- $key\n";
        }
        echo "\n";
        
        echo "Datos de ejemplo:\n";
        foreach ($data as $row) {
            echo "Batch: " . $row['id_batch'] . 
                 ", Referencia: " . $row['referencia'] . 
                 ", Producto: " . $row['nombre_referencia'] . 
                 ", No Lote: " . $row['numero_lote'] . 
                 ", Tamaño: " . $row['tamano_lote'] . 
                 ", Estado: " . $row['estado'] . "\n";
        }
    } else {
        echo "No se encontraron datos con estado >= 2\n";
    }
    
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage() . "\n";
}
?> 