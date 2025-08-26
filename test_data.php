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
                   WEEK(batch.fecha_creacion) as semana_creacion, 
                   WEEK(batch.fecha_programacion) as semana_programacion, 
                   batch.fecha_programacion, batch.estado
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
                 ", Sem Plan: " . $row['semana_creacion'] . 
                 ", Sem Prog: " . $row['semana_programacion'] . 
                 ", Fecha: " . $row['fecha_programacion'] . 
                 ", Estado: " . $row['estado'] . "\n";
        }
        
        echo "\n=== SIMULACIÓN DE FORMATO PARA DATATABLES ===\n";
        $formatted_data = [];
        foreach ($data as $row) {
            $formatted_data[] = [
                '', // Radio button placeholder
                $row['id_batch'],
                $row['referencia'],
                $row['nombre_referencia'],
                $row['numero_lote'],
                $row['tamano_lote'],
                $row['semana_creacion'],
                $row['semana_programacion'],
                $row['fecha_programacion'],
                $row['estado'],
                [
                    'id_batch' => $row['id_batch'],
                    'cant_observations' => 0
                ],
                $row['id_batch'], // Multi
                $row['id_batch'], // Modificar
                $row['id_batch']  // Eliminar
            ];
        }
        
        echo "Formato de datos para DataTables:\n";
        echo json_encode($formatted_data, JSON_PRETTY_PRINT);
    } else {
        echo "No se encontraron datos con estado >= 2\n";
    }
    
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage() . "\n";
}
?> 