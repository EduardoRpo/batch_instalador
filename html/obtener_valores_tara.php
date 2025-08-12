<?php 
// Configuración de la base de datos
require_once __DIR__ . '/../env.php';
$db_config = [
    'host' => $servername,
    'user' => $username,
    'password' => $password,
    'database' => $database
];

// Crear conexión
$conn = new mysqli($db_config['host'], $db_config['user'], $db_config['password'], $db_config['database']);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit;
}

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Validar que se recibieron los parámetros
if (empty($data['referencia']) || empty($data['lote'])) {
    echo json_encode(['success' => false, 'message' => 'Referencia y Lote son requeridos']);
    exit;
}

$referencia = $data['referencia'];
$lote = $data['lote'];

// Preparar la consulta para obtener los valores máximos y mínimos de tara
$query = "
    SELECT MIN(tara) AS minTara, MAX(tara) AS maxTara 
    FROM plan_muestras_tara 
    WHERE referencia = ? AND lote = ?
";

// Preparar la declaración
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $referencia, $lote);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Enviar la respuesta con los valores mínimos y máximos
    echo json_encode([
        'success' => true,
        'minTara' => $row['minTara'] ?? '',
        'maxTara' => $row['maxTara'] ?? ''
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al ejecutar la consulta']);
}

$stmt->close();
$conn->close();
?>
