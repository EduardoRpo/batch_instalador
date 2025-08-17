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
    
    // Consulta para obtener datos de pedidos con la estructura correcta
    $sql = "SELECT 
                pp.id as num,
                pr.nombre as propietario,
                pp.pedido,
                pp.fecha_pedido,
                pp.id_producto as granel,
                pp.id_producto,
                p.nombre_referencia,
                pp.cant_original,
                pp.cantidad as saldo_ofima,
                pp.cantidad_acumulada,
                pp.fecha_insumo,
                pp.fecha_actual,
                'Escenario 1' as simulacion,
                DATE_FORMAT(DATE_ADD(pp.fecha_pedido, INTERVAL 15 DAY), '%Y-%m-%d') as entrega,
                0 as cant_observations,
                pp.id as id_batch,
                pp.estado
            FROM plan_pedidos pp
            LEFT JOIN producto p ON p.referencia = pp.id_producto
            LEFT JOIN propietario pr ON pr.id = p.propietario
            WHERE pp.flag_estado = 1";
    
    $count_sql = "SELECT COUNT(*) as total 
                  FROM plan_pedidos pp 
                  WHERE pp.flag_estado = 1";
    
    // Agregar búsqueda si existe
    $where_conditions = [];
    $params = [];
    
    if (!empty($search)) {
        $where_conditions[] = "(pp.pedido LIKE :search OR pp.id_producto LIKE :search OR p.nombre_referencia LIKE :search OR pr.nombre LIKE :search)";
        $params[':search'] = "%$search%";
    }
    
    if (!empty($where_conditions)) {
        $sql .= " AND " . implode(' AND ', $where_conditions);
        $count_sql .= " AND " . implode(' AND ', $where_conditions);
    }
    
    // Agregar ordenamiento
    $sql .= " ORDER BY pr.nombre, pp.pedido $order_dir";
    
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
    
    // Respuesta para DataTables (devolver objetos, no arrays)
    $response = [
        'draw' => $draw,
        'recordsTotal' => $total_records,
        'recordsFiltered' => $total_records,
        'data' => $data
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