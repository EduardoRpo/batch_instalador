<?php
require_once __DIR__ . '/../../env.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Conectar a la base de datos usando PDO
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener el tipo de equipo solicitado
    $tipo = $_POST['tipo'] ?? '';
    
    if ($tipo === 'agitador') {
        // Consultar agitadores
        $sql = "SELECT id, nombre FROM agitador ORDER BY nombre";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($equipos, JSON_UNESCAPED_UNICODE);
        
    } elseif ($tipo === 'marmita') {
        // Consultar marmitas/tanques
        $sql = "SELECT id, nombre FROM marmita ORDER BY nombre";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($equipos, JSON_UNESCAPED_UNICODE);
        
    } else {
        echo json_encode(['error' => 'Tipo de equipo no especificado']);
    }
    
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de base de datos: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error general: ' . $e->getMessage()]);
}
?> 