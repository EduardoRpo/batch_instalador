<?php
// Archivo de prueba para verificar la API de aprobación

echo "<h2>Prueba de API de Aprobación</h2>";

// URL de la API
$api_url = "http://localhost:8580/api/aprobacion";

echo "<p><strong>URL de la API:</strong> $api_url</p>";

// Hacer la petición
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
));

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "<p><strong>Código HTTP:</strong> $http_code</p>";

if ($error) {
    echo "<p><strong>Error de cURL:</strong> $error</p>";
} else {
    echo "<p><strong>Respuesta:</strong></p>";
    echo "<pre>" . htmlspecialchars($response) . "</pre>";
    
    // Intentar decodificar JSON
    $json_data = json_decode($response, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        echo "<p><strong>JSON válido:</strong> Sí</p>";
        echo "<p><strong>Número de registros:</strong> " . count($json_data) . "</p>";
    } else {
        echo "<p><strong>Error JSON:</strong> " . json_last_error_msg() . "</p>";
    }
}

// También probar con file_get_contents
echo "<h3>Prueba alternativa con file_get_contents:</h3>";
try {
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => [
                'Content-Type: application/json',
                'Accept: application/json'
            ],
            'timeout' => 30
        ]
    ]);
    
    $response2 = file_get_contents($api_url, false, $context);
    if ($response2 === false) {
        echo "<p><strong>Error:</strong> No se pudo obtener respuesta</p>";
    } else {
        echo "<p><strong>Respuesta alternativa:</strong></p>";
        echo "<pre>" . htmlspecialchars($response2) . "</pre>";
    }
} catch (Exception $e) {
    echo "<p><strong>Excepción:</strong> " . $e->getMessage() . "</p>";
}
?> 