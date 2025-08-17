<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

// Simular datos de prueba con ambos formatos (mayúsculas y minúsculas)
$testData = [
    // Formato con mayúsculas (como el archivo del usuario)
    [
        'Nombre_Cliente' => 'GRUPO EMPRESARIAL DEZHMA S.A.S',
        'Cliente' => 'GRUPO EMPRESARIAL DEZHMA S.A.S',
        'T_Dcto' => 'P1',
        'Documento' => '7268',
        'Fecha_Dcto' => '8/11/2025',
        'Producto' => '22799',
        'Nombre_Producto_Mvto' => 'ESPUMA LIMPIADORA Y DESMAQUILLANTE - (220 ML) - DEZHMA',
        'Bodega' => 'B_PTERMINADO',
        'Cant_Original' => '1500',
        'Cant_Entregada' => '0',
        'Cantidad' => '1500',
        'Vlr_Venta' => '9037',
        'Total_Bruto' => '13555500',
        'Total_Neto' => '15792157.5',
        'Vendedor' => '013'
    ],
    // Formato con minúsculas (formato original)
    [
        'nombre_cliente' => 'ASUBELL S.A.S',
        'cliente' => 'ASUBELL S.A.S',
        't_dcto' => 'P1',
        'documento' => '7269',
        'fecha_dcto' => '8/11/2025',
        'producto' => '20676',
        'nombre_producto_mvto' => 'SHAMPOO  MANGO UVA KARICIA   X 30',
        'bodega' => 'B_PTERMINADO',
        'cant_original' => '3333',
        'cant_entregada' => '0',
        'cantidad' => '3333',
        'vlr_venta' => '515',
        'total_bruto' => '1716495',
        'total_neto' => '1999716.675',
        'vendedor' => '013'
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
        
        // Normalizar las claves a minúsculas para búsqueda consistente
        $normalizedData = array();
        foreach ($dataPedidos as $key => $value) {
            $normalizedKey = strtolower(trim($key));
            $normalizedData[$normalizedKey] = $value;
        }
        
        // Mapear las columnas con búsqueda flexible
        $data['cliente'] = getValue($normalizedData, ['cliente'], '');
        $data['documento'] = getValue($normalizedData, ['documento'], '');
        $data['producto'] = getValue($normalizedData, ['producto'], '');
        $data['cant_original'] = getValue($normalizedData, ['cant_original'], '0');
        $data['cantidad'] = getValue($normalizedData, ['cantidad'], '0');
        $data['valor_pedido'] = getValue($normalizedData, ['valor_pedido', 'vlr_venta'], '0');

        return $data;
    }
    
    /**
     * Obtiene el valor de un array usando múltiples claves posibles
     */
    function getValue($array, $possibleKeys, $default = '') {
        foreach ($possibleKeys as $key) {
            if (isset($array[$key])) {
                return str_replace(',', '', $array[$key]);
            }
        }
        return $default;
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