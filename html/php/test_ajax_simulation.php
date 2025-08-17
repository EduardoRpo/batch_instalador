<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

// Simular exactamente los datos que envía el JavaScript
$testData = [
    [
        'cliente' => 'GRUPO EMPRESARIAL DEZHMA S.A.S',
        'nombre_cliente' => 'GRUPO EMPRESARIAL DEZHMA S.A.S',
        'documento' => '7268',
        'fecha_dcto' => '8/11/2025',
        'producto' => '22799',
        'nombre_producto' => 'ESPUMA LIMPIADORA Y DESMAQUILLANTE - (220 ML) - DEZHMA',
        'cant_original' => 1500,
        'cantidad' => 1500,
        'valor_pedido' => 9037.0
    ]
];

// Simular la llamada AJAX exacta
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