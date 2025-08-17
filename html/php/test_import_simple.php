<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

// Simular datos de prueba que deberían venir del Excel
$testData = [
    [
        'Cliente' => 'CLIENTE001',
        'Nombre_Cliente' => 'Cliente de Prueba 1',
        'Documento' => 'DOC001',
        'Fecha_Dcto' => '2025-01-15',
        'Producto' => '20002',
        'Nombre_Producto_Mvto' => 'BODY SPLASH PAVI 165 ML',
        'Cant_Original' => '100',
        'Cantidad' => '50',
        'Vlr_Venta' => '150000'
    ],
    [
        'Cliente' => 'CLIENTE002',
        'Nombre_Cliente' => 'Cliente de Prueba 2',
        'Documento' => 'DOC002',
        'Fecha_Dcto' => '2025-01-16',
        'Producto' => '20004',
        'Nombre_Producto_Mvto' => 'JABON LIQUIDO - MAWIE (500 ML)',
        'Cant_Original' => '200',
        'Cantidad' => '100',
        'Vlr_Venta' => '250000'
    ]
];

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nonProducts = 0;
    $insert = 0;
    $update = 0;
    $nonExistentProducts = [];

    $dataGlobal = $testData;

    // Función para convertir datos (simulando PreBatchDao::convertData)
    function convertData($dataPedidos) {
        $data = array();
        
        // Verificar que las claves existan antes de acceder a ellas
        $data['cliente'] = isset($dataPedidos['Cliente']) ? str_replace(',', '', $dataPedidos['Cliente']) : '';
        $data['documento'] = isset($dataPedidos['Documento']) ? str_replace(',', '', $dataPedidos['Documento']) : '';
        $data['producto'] = isset($dataPedidos['Producto']) ? str_replace(',', '', $dataPedidos['Producto']) : '';
        $data['cant_original'] = isset($dataPedidos['Cant_Original']) ? str_replace(',', '', $dataPedidos['Cant_Original']) : '0';
        $data['cantidad'] = isset($dataPedidos['Cantidad']) ? str_replace(',', '', $dataPedidos['Cantidad']) : '0';
        $data['valor_pedido'] = isset($dataPedidos['Vlr_Venta']) ? str_replace(',', '', $dataPedidos['Vlr_Venta']) : '0';

        return $data;
    }

    // Convertir campos
    for ($i = 0; $i < sizeof($dataGlobal); $i++) {
        try {
            $dataConvertPedidos = convertData($dataGlobal[$i]);

            $dataGlobal[$i]['cliente'] = $dataConvertPedidos['cliente'];
            $dataGlobal[$i]['documento'] = $dataConvertPedidos['documento'];
            $dataGlobal[$i]['producto'] = $dataConvertPedidos['producto'];
            $dataGlobal[$i]['cant_original'] = $dataConvertPedidos['cant_original'];
            $dataGlobal[$i]['cantidad'] = $dataConvertPedidos['cantidad'];
            $dataGlobal[$i]['valor_pedido'] = $dataConvertPedidos['valor_pedido'];
        } catch (Exception $e) {
            continue;
        }
    }
    $data = $dataGlobal;

    for ($i = 0; $i < sizeof($dataGlobal); $i++) {
        try {
            // Verificar que el producto existe
            if (empty($dataGlobal[$i]['producto'])) {
                $nonExistentProducts[$i] = $dataGlobal[$i];
                unset($data[$i]);
                $nonProducts = $nonProducts + 1;
                continue;
            }

            // Consultar si existe producto en la base de datos
            $sql = "SELECT * FROM producto WHERE referencia = :referencia";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['referencia' => trim($dataGlobal[$i]['producto'])]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$product) {
                $nonExistentProducts[$i] = $dataGlobal[$i];
                unset($data[$i]);
                $nonProducts = $nonProducts + 1;
            } else {
                // Consultar si el pedido ya existe
                $sql = "SELECT * FROM plan_pedidos WHERE pedido = :pedido AND id_producto = :id_producto";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    'pedido' => trim($dataGlobal[$i]['documento']),
                    'id_producto' => trim("M-" . $dataGlobal[$i]['producto'])
                ]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $result ? $update = $update + 1 : $insert = $insert + 1;
            }
        } catch (Exception $e) {
            $nonExistentProducts[$i] = $dataGlobal[$i];
            unset($data[$i]);
            $nonProducts = $nonProducts + 1;
        }
    }

    // Obtener cantidad de referencias
    $key_array = array();
    $temp_array = array();
    $i = 0;

    foreach ($data as $val) {
        if (!in_array($val['producto'], $key_array)) {
            $key_array[$i] = $val['producto'];
            $temp_array[$i] = $val;
        }
        $i++;
    }

    $dataImportOrders = array(
        'success' => true, 
        'update' => $update, 
        'insert' => $insert, 
        'nonProducts' => $nonProducts, 
        'pedidos' => sizeof($testData), 
        'referencias' => sizeof($temp_array)
    );

    $result = [
        'status' => 'success',
        'data' => $dataImportOrders,
        'test_data' => $testData,
        'processed_data' => $data
    ];

} catch (PDOException $e) {
    $result = [
        'status' => 'error',
        'message' => 'Error de base de datos: ' . $e->getMessage(),
        'test_data' => $testData
    ];
}

echo json_encode($result, JSON_PRETTY_PRINT);
?> 