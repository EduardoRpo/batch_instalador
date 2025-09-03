<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consultar todos los equipos
    $sql = "SELECT id, descripcion, tipo FROM equipos WHERE tipo IN ('agitador', 'marmita') ORDER BY tipo, descripcion";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($equipos, JSON_UNESCAPED_UNICODE);
    
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de base de datos: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error general: ' . $e->getMessage()]);
}
?> 