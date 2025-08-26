<?php
require_once __DIR__ . '/env.php';

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== VERIFICACIÓN DE TABLA OBSERVACIONES_BATCH_INACTIVOS ===\n";
    
    // Verificar estructura de la tabla
    $stmt = $conn->prepare("DESCRIBE observaciones_batch_inactivos");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Estructura de tabla 'observaciones_batch_inactivos':\n";
    foreach ($columns as $column) {
        echo "- " . $column['Field'] . " (" . $column['Type'] . ")\n";
    }
    echo "\n";
    
    // Contar total de observaciones
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM observaciones_batch_inactivos");
    $stmt->execute();
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    echo "Total de observaciones: $total\n\n";
    
    // Mostrar algunos ejemplos de observaciones
    $stmt = $conn->prepare("SELECT * FROM observaciones_batch_inactivos LIMIT 5");
    $stmt->execute();
    $observaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Ejemplos de observaciones:\n";
    foreach ($observaciones as $obs) {
        echo "ID: " . $obs['id'] . 
             ", Batch: " . $obs['batch'] . 
             ", Referencia: " . $obs['referencia'] . 
             ", Observación: " . substr($obs['observacion'], 0, 50) . "..." .
             ", Fecha: " . $obs['fecha_registro'] . "\n";
    }
    echo "\n";
    
    // Verificar observaciones por batch
    $stmt = $conn->prepare("SELECT batch, COUNT(*) as cant_observations 
                           FROM observaciones_batch_inactivos 
                           GROUP BY batch 
                           ORDER BY cant_observations DESC 
                           LIMIT 10");
    $stmt->execute();
    $batch_counts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Observaciones por batch (top 10):\n";
    foreach ($batch_counts as $count) {
        echo "Batch " . $count['batch'] . ": " . $count['cant_observations'] . " observaciones\n";
    }
    echo "\n";
    
    // Probar la consulta que usaremos en batch_fetch.php
    echo "=== PRUEBA DE CONSULTA CON OBSERVACIONES ===\n";
    $sql = "SELECT batch.id_batch, batch.id_producto as referencia, 
                   p.nombre_referencia, batch.numero_lote, batch.tamano_lote,
                   WEEK(batch.fecha_creacion) as semana_creacion, 
                   WEEK(batch.fecha_programacion) as semana_programacion, 
                   batch.fecha_programacion, batch.estado,
                   COALESCE(obs_count.cant_observations, 0) as cant_observations
            FROM batch 
            INNER JOIN producto p ON p.referencia = batch.id_producto
            LEFT JOIN (
                SELECT batch, COUNT(*) as cant_observations 
                FROM observaciones_batch_inactivos 
                GROUP BY batch
            ) obs_count ON obs_count.batch = batch.id_batch
            WHERE batch.estado >= 2
            LIMIT 5";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Datos con conteo de observaciones:\n";
    foreach ($data as $row) {
        echo "Batch: " . $row['id_batch'] . 
             ", Referencia: " . $row['referencia'] . 
             ", Observaciones: " . $row['cant_observations'] . "\n";
    }
    
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage() . "\n";
}
?> 