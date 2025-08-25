<?php

// Configuración para diferentes entornos
$environment = getenv('APP_ENV') ?: 'development';

if ($environment === 'production') {
    // Configuración para producción (Linux/Docker)
    $servername = getenv('DB_HOST') ?: 'mariadb_pro'; // Nombre del contenedor Docker
    $database = getenv('DB_NAME') ?: 'batch_record';
    $username = getenv('DB_USER') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: 'S@m4r@_2025!';
} else {
    // Configuración para desarrollo (Windows)
    $servername = "127.0.0.1";
    $database = "batch_record";
    $username = "root";
    $password = "";
}
