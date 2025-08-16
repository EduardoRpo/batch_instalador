<?php
// Headers anti-caché
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: application/json');

require_once __DIR__ . '/../../env.php';

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 1;
    $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
    $search = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
    $order_column = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
    $order_dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'ASC';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
    
    $sql = "SELECT batch.id_batch, batch.estado, batch.id_producto as referencia, batch.numero_orden as pedido, batch.numero_lote, batch.unidad_lote, batch.tamano_lote FROM batch WHERE batch.estado >= 5.5";
    $count_sql = "SELECT COUNT(*) as total FROM batch WHERE batch.estado >= 5.5";
    
    if ($fecha) {
        $sql .= " AND DATE(batch.fecha_creacion) = :fecha";
        $count_sql .= " AND DATE(batch.fecha_creacion) = :fecha";
    }
    
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
    
    $sql .= " ORDER BY batch.id_batch $order_dir";
    $sql .= " LIMIT $start, $length";
    
    $stmt = $conn->prepare($count_sql);
    $stmt->execute($params);
    $total_records = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $formatted_data = [];
    foreach ($data as $row) {
        $formatted_data[] = [
            $row['id_batch'],
            $row['estado'],
            $row['referencia'],
            $row['pedido'],
            '',
            $row['referencia'],
            $row['referencia'],
            $row['numero_lote'],
            $row['unidad_lote'],
            $row['tamano_lote']
        ];
    }
    
    $response = [
        'draw' => $draw,
        'recordsTotal' => $total_records,
        'recordsFiltered' => $total_records,
        'data' => $formatted_data
    ];
    
    echo json_encode($response);
    
} catch (PDOException $e) {
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