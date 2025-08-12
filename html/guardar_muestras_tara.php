<?php 
// Configurar el archivo de log de errores en la misma carpeta
ini_set('log_errors', 'On');
ini_set('error_log', __DIR__ . '/error_log.log');

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
    error_log("Error de conexión: " . $conn->connect_error);
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit;
}

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Imprimir los datos recibidos para depuración
error_log("Datos recibidos: " . print_r($data, true));

if (!empty($data)) {
    // Preparar la declaración para incluir 'densidad_final'
    $stmt = $conn->prepare("INSERT INTO plan_muestras_tara (tara, lote, referencia, batch, hora_inicio, hora_final, densidad_final) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        error_log("Error al preparar la declaración: " . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta']);
        exit;
    }

    // Iterar sobre los datos y ejecutar la declaración
    foreach ($data as $row) {
        $tara = $row['tara'];
        $lote = $row['lote'];
        $referencia = $row['referencia'];
        $batch = $row['batch'];
        $hora_inicio = $row['horaInicio'];
        $hora_final = $row['horaFinal'];
        $densidad_final = $row['densidadFinal']; // Obtener densidad_final

        // Validar los datos antes de la inserción
        if (!is_numeric($tara) || empty($lote) || empty($referencia) || empty($batch) || empty($hora_inicio) || empty($hora_final) || !is_numeric($densidad_final)) {
            error_log("Datos inválidos: " . print_r($row, true));
            continue; // O puedes decidir salir del bucle
        }

        // Imprimir los valores de cada iteración para depuración
        error_log("Insertando fila: Tara: $tara, Lote: $lote, Referencia: $referencia, Batch: $batch, Hora Inicio: $hora_inicio, Hora Final: $hora_final, Densidad Final: $densidad_final");

        // Vincular los parámetros a la consulta SQL
        $stmt->bind_param("dsssssd", $tara, $lote, $referencia, $batch, $hora_inicio, $hora_final, $densidad_final);

        if (!$stmt->execute()) {
            error_log("Error al ejecutar la declaración: " . $stmt->error);
        }
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();

    echo json_encode(['success' => true, 'message' => 'Datos insertados correctamente']);
} else {
    error_log("No se recibieron datos.");
    echo json_encode(['success' => false, 'message' => 'No se recibieron datos.']);
}
?>
