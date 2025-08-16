<?php
// Script para crear todos los archivos fetch de respaldo

$modules = [
    'acondicionamiento' => [
        'estado_min' => 6.5,
        'modulo' => 7,
        'columns' => ['id_batch', 'fecha_programacion', 'numero_orden', 'referencia', 'numero_lote', 'cantidad_firmas', 'total_firmas']
    ],
    'microbiologia' => [
        'estado_min' => 7.5,
        'modulo' => 8,
        'columns' => ['id_batch', 'fecha_programacion', 'numero_orden', 'referencia', 'numero_lote', 'cantidad_firmas', 'total_firmas']
    ],
    'fisicoquimica' => [
        'estado_min' => 8.5,
        'modulo' => 9,
        'columns' => ['id_batch', 'fecha_programacion', 'numero_orden', 'referencia', 'numero_lote', 'cantidad_firmas', 'total_firmas']
    ],
    'liberacionlote' => [
        'estado_min' => 9.5,
        'modulo' => 10,
        'columns' => ['id_batch', 'fecha_programacion', 'numero_orden', 'referencia', 'numero_lote', 'cantidad_firmas', 'total_firmas']
    ],
    'despachos' => [
        'estado_min' => 10.5,
        'modulo' => 11,
        'columns' => ['id_batch', 'fecha_programacion', 'numero_orden', 'referencia', 'numero_lote', 'cantidad_firmas', 'total_firmas']
    ]
];

foreach ($modules as $module => $config) {
    $filename = "html/php/{$module}_fetch.php";
    $content = "<?php
require_once __DIR__ . '/../../env.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Conectar a la base de datos usando PDO
    \$conn = new PDO(\"mysql:dbname=\$database;host=\$servername\", \$username, \$password);
    \$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener parámetros de DataTables
    \$draw = isset(\$_POST['draw']) ? intval(\$_POST['draw']) : 1;
    \$start = isset(\$_POST['start']) ? intval(\$_POST['start']) : 0;
    \$length = isset(\$_POST['length']) ? intval(\$_POST['length']) : 10;
    \$search = isset(\$_POST['search']['value']) ? \$_POST['search']['value'] : '';
    \$order_column = isset(\$_POST['order'][0]['column']) ? intval(\$_POST['order'][0]['column']) : 0;
    \$order_dir = isset(\$_POST['order'][0]['dir']) ? \$_POST['order'][0]['dir'] : 'ASC';
    
    // Mapear columnas para {$module}
    \$columns = " . var_export($config['columns'], true) . ";
    \$order_by = \$columns[\$order_column] ?? 'id_batch';
    
    // Construir consulta base para {$module}
    \$sql = \"SELECT batch.id_batch, batch.fecha_programacion, batch.numero_orden, batch.id_producto as referencia, 
                   batch.numero_lote, batch.estado, bcf.cantidad_firmas, bcf.modulo, bcf.total_firmas   
            FROM batch 
            INNER JOIN batch_control_firmas bcf ON bcf.batch = batch.id_batch  
            WHERE (batch.estado >= {$config['estado_min']}) AND bcf.cantidad_firmas in (0, 1) AND bcf.modulo = {$config['modulo']}\";
    
    \$count_sql = \"SELECT COUNT(*) as total 
                  FROM batch 
                  INNER JOIN batch_control_firmas bcf ON bcf.batch = batch.id_batch  
                  WHERE (batch.estado >= {$config['estado_min']}) AND bcf.cantidad_firmas in (0, 1) AND bcf.modulo = {$config['modulo']}\";
    
    // Agregar búsqueda si existe
    \$where_conditions = [];
    \$params = [];
    
    if (!empty(\$search)) {
        \$where_conditions[] = \"(batch.id_producto LIKE :search OR batch.numero_orden LIKE :search)\";
        \$params[':search'] = \"%\$search%\";
    }
    
    if (!empty(\$where_conditions)) {
        \$sql .= \" AND \" . implode(' AND ', \$where_conditions);
        \$count_sql .= \" AND \" . implode(' AND ', \$where_conditions);
    }
    
    // Agregar ordenamiento
    \$sql .= \" ORDER BY \$order_by \$order_dir\";
    
    // Agregar paginación
    \$sql .= \" LIMIT \$start, \$length\";
    
    // Ejecutar consulta de conteo total
    \$stmt = \$conn->prepare(\$count_sql);
    \$stmt->execute(\$params);
    \$total_records = \$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Ejecutar consulta principal
    \$stmt = \$conn->prepare(\$sql);
    \$stmt->execute(\$params);
    \$data = \$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Formatear datos para DataTables
    \$formatted_data = [];
    foreach (\$data as \$row) {
        \$formatted_data[] = [
            \$row['id_batch'],
            \$row['fecha_programacion'],
            \$row['numero_orden'],
            \$row['referencia'],
            \$row['numero_lote'],
            \$row['cantidad_firmas'],
            \$row['total_firmas']
        ];
    }
    
    // Respuesta para DataTables
    \$response = [
        'draw' => \$draw,
        'recordsTotal' => \$total_records,
        'recordsFiltered' => \$total_records,
        'data' => \$formatted_data
    ];
    
    echo json_encode(\$response);
    
} catch (PDOException \$e) {
    // En caso de error, devolver respuesta de error
    \$response = [
        'draw' => \$draw ?? 1,
        'recordsTotal' => 0,
        'recordsFiltered' => 0,
        'data' => [],
        'error' => 'Error de base de datos: ' . \$e->getMessage()
    ];
    
    echo json_encode(\$response);
}
?>";
    
    file_put_contents($filename, $content);
    echo "Creado: $filename\n";
}

echo "\n¡Todos los archivos fetch han sido creados!\n";
?> 