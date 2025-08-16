<?php
// Deshabilitar reportes de error para evitar interferencias
error_reporting(0);
ini_set('display_errors', 0);

// Configurar headers para JSON y CORS
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Si es una petición OPTIONS, responder inmediatamente
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    require_once __DIR__ . '/../../env.php';

    // Conectar a la base de datos usando PDO
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener parámetros de DataTables
    $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
    $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
    $search = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
    $order_column = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
    $order_dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'ASC';
    
    // Obtener fecha si se proporciona
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
    
    // Construir consulta base usando solo columnas esenciales
    $sql = "SELECT batch.id_batch, batch.estado, batch.id_producto as referencia, 
                   batch.numero_orden as pedido, batch.numero_lote, 
                   batch.unidad_lote, batch.tamano_lote
            FROM batch 
            WHERE batch.estado >= 5.5";
    
    $count_sql = "SELECT COUNT(*) as total 
                  FROM batch 
                  WHERE batch.estado >= 5.5";
    
    // Agregar filtro de fecha si se proporciona
    if ($fecha) {
        $sql .= " AND DATE(batch.fecha_creacion) = :fecha";
        $count_sql .= " AND DATE(batch.fecha_creacion) = :fecha";
    }
    
    // Agregar búsqueda si existe
    $where_conditions = [];
    $params = [];
    
    if ($fecha) {
        $params[':fecha'] = $fecha;
    }
    
    if (!empty($search)) {
        $where_conditions[] = "batch.id_producto LIKE :search";
        $params[':search'] = "%$search%";
    }
    
    if (!empty($where_conditions)) {
        $sql .= " AND " . implode(' AND ', $where_conditions);
        $count_sql .= " AND " . implode(' AND ', $where_conditions);
    }
    
    // Agregar ordenamiento
    $sql .= " ORDER BY batch.id_batch $order_dir";
    
    // Agregar paginación
    $sql .= " LIMIT $start, $length";
    
    // Ejecutar consulta de conteo total
    $stmt = $conn->prepare($count_sql);
    $stmt->execute($params);
    $total_records = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Ejecutar consulta principal
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Formatear datos para DataTables
    $formatted_data = [];
    foreach ($data as $row) {
        $formatted_data[] = [
            $row['id_batch'],
            $row['estado'],
            $row['referencia'],
            $row['pedido'],
            $row['fecha_creacion'] ?? '',
            $row['referencia'], // Propietario placeholder
            $row['referencia'], // Descripción placeholder
            $row['numero_lote'],
            $row['unidad_lote'],
            $row['tamano_lote']
        ];
    }
    
    // Respuesta para DataTables
    $response = [
        'draw' => $draw,
        'recordsTotal' => $total_records,
        'recordsFiltered' => $total_records,
        'data' => $formatted_data
    ];
    
    // Asegurar que no hay salida antes del JSON
    if (ob_get_length()) ob_clean();
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    // En caso de error, devolver respuesta de error
    $response = [
        'draw' => $draw ?? 1,
        'recordsTotal' => 0,
        'recordsFiltered' => 0,
        'data' => [],
        'error' => 'Error: ' . $e->getMessage()
    ];
    
    if (ob_get_length()) ob_clean();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
?> 