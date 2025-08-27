<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Obtener parámetros de DataTables
    $draw = $_POST['draw'] ?? 1;
    $start = intval($_POST['start'] ?? 0);
    $length = intval($_POST['length'] ?? 10);
    $search = $_POST['search']['value'] ?? '';
    
    // Log para debugging
    error_log("=== BATCH_FETCH.PHP PARÁMETROS ===");
    error_log("Draw: " . $draw);
    error_log("Start: " . $start);
    error_log("Length: " . $length);
    error_log("Search: " . $search);
    
    // Consulta para contar total de registros (sin paginación)
    $count_sql = "SELECT COUNT(*) as total
                  FROM batch 
                  INNER JOIN producto p ON p.referencia = batch.id_producto
                  WHERE batch.estado >= 2";
    
    if (!empty($search)) {
        $count_sql .= " AND (batch.numero_lote LIKE :search OR p.nombre_referencia LIKE :search OR batch.id_producto LIKE :search)";
    }
    
    $count_stmt = $conn->prepare($count_sql);
    if (!empty($search)) {
        $searchParam = "%$search%";
        $count_stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    }
    $count_stmt->execute();
    $total_records = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    error_log("Total registros en BD: " . $total_records);
    
    // Consulta principal con paginación
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
            WHERE batch.estado >= 2";
    
    // Agregar búsqueda si se proporciona
    if (!empty($search)) {
        $sql .= " AND (batch.numero_lote LIKE :search OR p.nombre_referencia LIKE :search OR batch.id_producto LIKE :search)";
    }
    
    $sql .= " ORDER BY batch.id_batch DESC";
    
    // Agregar LIMIT para paginación
    if ($length > 0) {
        $sql .= " LIMIT :start, :length";
    }
    
    error_log("SQL Query: " . $sql);
    
    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare($sql);
    
    if (!empty($search)) {
        $searchParam = "%$search%";
        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    }
    
    if ($length > 0) {
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':length', $length, PDO::PARAM_INT);
    }
    
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("Registros obtenidos después de LIMIT: " . count($data));
    
    // Formatear datos para DataTables
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
            intval($row['estado']), // Convertir estado a número
            [
                'id_batch' => $row['id_batch'],
                'cant_observations' => intval($row['cant_observations'])
            ],
            $row['id_batch'], // Multi
            $row['id_batch'], // Modificar
            $row['id_batch']  // Eliminar
        ];
    }
    
    // Preparar respuesta
    $response = [
        'draw' => intval($draw),
        'recordsTotal' => $total_records,
        'recordsFiltered' => $total_records,
        'data' => $formatted_data
    ];
    
    // Log para debugging
    error_log("=== DEBUG BATCH_FETCH.PHP ===");
    error_log("Total records: " . $total_records);
    error_log("Formatted data count: " . count($formatted_data));
    error_log("Response recordsTotal: " . $response['recordsTotal']);
    error_log("Response recordsFiltered: " . $response['recordsFiltered']);
    error_log("Response data count: " . count($response['data']));
    
    echo json_encode($response);
    
} catch (PDOException $e) {
    error_log("ERROR en batch_fetch.php: " . $e->getMessage());
    // En caso de error, devolver respuesta de error
    $response = [
        'draw' => $draw ?? 1,
        'recordsTotal' => 0,
        'recordsFiltered' => 0,
        'data' => [],
        'error' => 'Error de base de datos: ' . $e->getMessage()
    ];
    echo json_encode($response);
}
?> 