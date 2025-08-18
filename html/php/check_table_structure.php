<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Incluir conexión a la base de datos
require_once('../../conexion.php');

try {
    // Verificar estructura de la tabla plan_pedidos
    $stmt = $conn->prepare("DESCRIBE plan_pedidos");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Verificar si existe el campo cantidad_acumulada
    $has_cantidad_acumulada = false;
    foreach ($columns as $column) {
        if ($column['Field'] === 'cantidad_acumulada') {
            $has_cantidad_acumulada = true;
            break;
        }
    }
    
    // Mostrar estructura completa
    $response = [
        'success' => true,
        'table_structure' => $columns,
        'has_cantidad_acumulada' => $has_cantidad_acumulada,
        'total_columns' => count($columns)
    ];
    
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?> 