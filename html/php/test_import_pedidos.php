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

// Simular la llamada a la API
$postData = [
    'data' => $testData
];

// Hacer la llamada a la API
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
curl_close($ch);

$result = [
    'http_code' => $httpCode,
    'response' => json_decode($response, true),
    'raw_response' => $response,
    'test_data' => $testData
];

echo json_encode($result, JSON_PRETTY_PRINT);
?> 