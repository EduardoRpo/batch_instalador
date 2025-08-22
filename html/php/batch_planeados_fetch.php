<?php
require_once __DIR__ . '/../../env.php';

// Configurar headers para JSON
header('Content-Type: application/json');

// Log para debugging
error_log('🔍 batch_planeados_fetch.php - Iniciando consulta');

try {
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
    
    // Mapear columnas para plan_preplaneados
    $columns = ['id', 'pedido', 'id_producto', 'tamano_lote', 'unidad_lote', 'fecha_programacion', 'estado'];
    $order_by = $columns[$order_column] ?? 'id';
    
    // Construir consulta base para plan_preplaneados (planeado = 1)
    $sql = "SELECT 
                pp.id, 
                pp.pedido, 
                pp.id_producto as referencia, 
                pp.tamano_lote, 
                pp.unidad_lote, 
                pp.fecha_programacion, 
                pp.estado, 
                pp.fecha_insumo, 
                pp.sim, 
                pp.id_producto as granel, 
                pp.id_producto as nombre_referencia, 
                DATE_ADD(pp.fecha_insumo, INTERVAL 1 DAY) as fecha_pesaje, 
                DATE_ADD(pp.fecha_insumo, INTERVAL 2 DAY) as fecha_envasado, 
                WEEK(pp.fecha_programacion) as semana, 
                pr.nombre_referencia as nombre_ref_producto, 
                REPLACE(pr.multi, 'A-', 'Granel-') as granel_product
            FROM 
                plan_preplaneados pp 
            INNER JOIN 
                producto pr ON pp.id_producto = pr.referencia 
            WHERE 
                pp.planeado = 1";
    
    $count_sql = "SELECT COUNT(*) as total 
                  FROM plan_preplaneados pp 
                  INNER JOIN producto pr ON pp.id_producto = pr.referencia
                  WHERE pp.planeado = 1";
    
    // Agregar búsqueda si existe
    $where_conditions = [];
    $params = [];
    
    if (!empty($search)) {
        $where_conditions[] = "(pp.pedido LIKE :search OR pp.id_producto LIKE :search OR pr.nombre_referencia LIKE :search OR pr.multi LIKE :search)";
        $params[':search'] = "%$search%";
    }
    
    if (!empty($where_conditions)) {
        $sql .= " AND " . implode(' AND ', $where_conditions);
        $count_sql .= " AND " . implode(' AND ', $where_conditions);
    }
    
    // Agregar ordenamiento
    $sql .= " ORDER BY $order_by $order_dir";
    
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
    
    // Log para debugging
    error_log('🔍 batch_planeados_fetch.php - Datos obtenidos: ' . count($data) . ' registros');
    error_log('🔍 batch_planeados_fetch.php - SQL ejecutado: ' . $sql);
    
    // Formatear datos para DataTables como objetos
    $formatted_data = [];
    foreach ($data as $row) {
        $formatted_data[] = [
            'id' => $row['id'],
            'semana' => $row['semana'],
            'pedido' => $row['pedido'],
            'granel' => $row['granel_product'] ?? $row['granel'], // Usar granel_product si existe, sino granel
            'referencia' => $row['referencia'],
            'nombre_referencia' => $row['nombre_ref_producto'] ?? $row['nombre_referencia'], // Usar nombre_ref_producto si existe, sino nombre_referencia
            'tamano_lote' => $row['tamano_lote'],
            'unidad_lote' => $row['unidad_lote'],
            'sim' => $row['sim'],
            'fecha_insumo' => $row['fecha_insumo'],
            'fecha_pesaje' => $row['fecha_pesaje'],
            'fecha_envasado' => $row['fecha_envasado'],
            'estado' => $row['estado']
        ];
    }
    
    // Respuesta para DataTables
    $response = [
        'draw' => $draw,
        'recordsTotal' => $total_records,
        'recordsFiltered' => $total_records,
        'data' => $formatted_data
    ];
    
    // Log para debugging
    error_log('🔍 batch_planeados_fetch.php - Respuesta preparada: ' . json_encode($response));
    
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