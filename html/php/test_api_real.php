<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

// Datos reales del archivo Excel del usuario
$testData = [
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
    ]
];

// Simular la llamada a la API real
$postData = [
    'data' => $testData
];

// Hacer la llamada a la API real
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8580/api/validacionDatosPedidos');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($postData))
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

$result = [
    'http_code' => $httpCode,
    'curl_error' => $error,
    'response' => json_decode($response, true),
    'raw_response' => $response,
    'test_data' => $testData,
    'post_data' => $postData
];

echo json_encode($result, JSON_PRETTY_PRINT);
?> 