<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener parámetros de DataTables
    $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
    $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
    $search = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
    $order_column = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
    $order_dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'ASC';
    
    // Consulta específica para pedidos
    $sql = "SELECT 
                p.numero_orden as pedido,
                p.fecha_pedido as f_pedido,
                p.referencia as granel,
                p.referencia,
                p.producto,
                p.saldo_ofima,
                p.acum_prog,
                p.cant_programar,
                p.recep_insumos_dia1,
                p.escenario,
                p.fecha_entrega_dia15
            FROM pedidos p
            WHERE p.estado = 'activo'";
    
    $count_sql = "SELECT COUNT(*) as total FROM pedidos p WHERE p.estado = 'activo'";
    
    // Agregar búsqueda si existe
    $where_conditions = [];
    $params = [];
    
    if (!empty($search)) {
        $where_conditions[] = "(p.numero_orden LIKE :search OR p.referencia LIKE :search OR p.producto LIKE :search)";
        $params[':search'] = "%$search%";
    }
    
    if (!empty($where_conditions)) {
        $sql .= " AND " . implode(' AND ', $where_conditions);
        $count_sql .= " AND " . implode(' AND ', $where_conditions);
    }
    
    // Agregar ordenamiento
    $sql .= " ORDER BY p.numero_orden $order_dir";
    
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
            $row['pedido'],
            $row['f_pedido'],
            $row['granel'],
            $row['referencia'],
            $row['producto'],
            $row['saldo_ofima'],
            $row['acum_prog'],
            $row['cant_programar'],
            $row['recep_insumos_dia1'],
            $row['escenario'],
            $row['fecha_entrega_dia15']
        ];
    }
    
    // Respuesta para DataTables
    $response = [
        'draw' => $draw,
        'recordsTotal' => $total_records,
        'recordsFiltered' => $total_records,
        'data' => $formatted_data
    ];
    
    echo json_encode($response);
    
} catch (PDOException $e) {
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