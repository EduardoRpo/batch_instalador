<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir conexión a la base de datos
require_once('../../conexion.php');

try {
    // Obtener datos del POST
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (!$data || !isset($data['data']) || !is_array($data['data'])) {
        throw new Exception('Datos inválidos');
    }
    
    $pedidos = $data['data'];
    $insert = 0;
    $update = 0;
    $nonProducts = 0;
    $referencias = [];
    $nonExistentProducts = [];
    
    // Procesar cada pedido
    foreach ($pedidos as $pedido) {
        // Normalizar datos
        $cliente = trim($pedido['Cliente'] ?? $pedido['cliente'] ?? '');
        $documento = trim($pedido['Documento'] ?? $pedido['documento'] ?? '');
        $producto = trim($pedido['Producto'] ?? $pedido['producto'] ?? '');
        $cant_original = intval($pedido['Cant_Original'] ?? $pedido['cant_original'] ?? 0);
        $cantidad = intval($pedido['Cantidad'] ?? $pedido['cantidad'] ?? 0);
        $valor_pedido = floatval($pedido['Vlr_Venta'] ?? $pedido['valor_pedido'] ?? 0);
        $fecha_dcto = $pedido['Fecha_Dcto'] ?? $pedido['fecha_dcto'] ?? date('Y-m-d');
        
        // Validar datos básicos
        if (empty($documento) || empty($producto)) {
            $nonProducts++;
            $nonExistentProducts[] = $pedido;
            continue;
        }
        
        // Verificar si el producto existe
        $stmt = $conn->prepare("SELECT referencia FROM producto WHERE referencia = ?");
        $stmt->execute([$producto]);
        $producto_existe = $stmt->fetch();
        
        if (!$producto_existe) {
            $nonProducts++;
            $nonExistentProducts[] = $pedido;
            continue;
        }
        
        // Agregar a referencias únicas
        if (!in_array($producto, $referencias)) {
            $referencias[] = $producto;
        }
        
        // Verificar si el pedido ya existe
        $stmt = $conn->prepare("SELECT * FROM plan_pedidos WHERE pedido = ? AND id_producto = ?");
        $stmt->execute([$documento, "M-" . $producto]);
        $pedido_existe = $stmt->fetch();
        
        if ($pedido_existe) {
            // Actualizar pedido existente
            $stmt = $conn->prepare("UPDATE plan_pedidos SET 
                cantidad = ?, 
                valor_pedido = ?, 
                importado = NOW(), 
                flag_estado = 1 
                WHERE pedido = ? AND id_producto = ?");
            $stmt->execute([$cantidad, $valor_pedido, $documento, "M-" . $producto]);
            $update++;
        } else {
            // Insertar nuevo pedido
            $fecha_pedido = date('Y-m-d', strtotime($fecha_dcto));
            $stmt = $conn->prepare("INSERT INTO plan_pedidos 
                (pedido, id_producto, cant_original, cantidad, valor_pedido, fecha_pedido) 
                VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$documento, "M-" . $producto, $cant_original, $cantidad, $valor_pedido, $fecha_pedido]);
            $insert++;
        }
    }
    
    // Preparar respuesta
    $response = [
        'success' => true,
        'insert' => $insert,
        'update' => $update,
        'nonProducts' => $nonProducts,
        'pedidos' => count($pedidos),
        'referencias' => count($referencias),
        'message' => 'Procesamiento completado'
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?> 