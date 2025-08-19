<?php
// Archivo de prueba para verificar la configuración de base de datos
echo "<h2>Configuración de Base de Datos</h2>";

// Verificar variables de entorno
echo "<h3>Variables de Entorno:</h3>";
echo "APP_ENV: " . (getenv('APP_ENV') ?: 'NO DEFINIDA') . "<br>";
echo "DB_HOST: " . (getenv('DB_HOST') ?: 'NO DEFINIDA') . "<br>";
echo "DB_NAME: " . (getenv('DB_NAME') ?: 'NO DEFINIDA') . "<br>";
echo "DB_USER: " . (getenv('DB_USER') ?: 'NO DEFINIDA') . "<br>";
echo "DB_PASSWORD: " . (getenv('DB_PASSWORD') ?: 'NO DEFINIDA') . "<br>";

// Cargar configuración desde env.php
require_once __DIR__ . '/env.php';

echo "<h3>Configuración desde env.php:</h3>";
echo "Environment: " . $environment . "<br>";
echo "Servername: " . $servername . "<br>";
echo "Database: " . $database . "<br>";
echo "Username: " . $username . "<br>";
echo "Password: " . ($password ? 'DEFINIDA' : 'VACÍA') . "<br>";

// Probar conexión
echo "<h3>Prueba de Conexión:</h3>";
try {
    $dsn = "mysql:dbname=$database;host=$servername";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    echo "✅ Conexión exitosa a: $servername<br>";
    
    // Probar consulta simple
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM plan_pedidos");
    $result = $stmt->fetch();
    echo "✅ Consulta exitosa. Total de pedidos: " . $result['total'] . "<br>";
    
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "<br>";
    echo "DSN intentado: mysql:dbname=$database;host=$servername<br>";
}
?> 