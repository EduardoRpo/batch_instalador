<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Primero vamos a ver qué columnas existen en la tabla producto
    $sql = "DESCRIBE producto";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Consulta básica con columnas que sabemos que existen
    $sql = "SELECT referencia, nombre_referencia 
            FROM producto 
            ORDER BY nombre_referencia";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Agregar columnas adicionales si existen
    $response = [];
    foreach ($products as $product) {
        $product_data = [
            'referencia' => $product['referencia'],
            'nombre_referencia' => $product['nombre_referencia'],
            'marca' => '', // Valor por defecto
            'propietario' => '', // Valor por defecto
            'producto' => '', // Valor por defecto
            'presentacion_comercial' => '', // Valor por defecto
            'linea' => '', // Valor por defecto
            'densidad_producto' => '', // Valor por defecto
            'ajuste' => '', // Valor por defecto
            'notificacion_sanitaria' => '' // Valor por defecto
        ];
        
        // Intentar obtener datos adicionales si las columnas existen
        if (in_array('marca', $columns)) {
            $product_data['marca'] = $product['marca'] ?? '';
        }
        if (in_array('propietario', $columns)) {
            $product_data['propietario'] = $product['propietario'] ?? '';
        }
        if (in_array('producto', $columns)) {
            $product_data['producto'] = $product['producto'] ?? '';
        }
        if (in_array('presentacion_comercial', $columns)) {
            $product_data['presentacion_comercial'] = $product['presentacion_comercial'] ?? '';
        }
        if (in_array('linea', $columns)) {
            $product_data['linea'] = $product['linea'] ?? '';
        }
        if (in_array('densidad_producto', $columns)) {
            $product_data['densidad_producto'] = $product['densidad_producto'] ?? '';
        }
        if (in_array('ajuste', $columns)) {
            $product_data['ajuste'] = $product['ajuste'] ?? '';
        }
        if (in_array('notificacion_sanitaria', $columns)) {
            $product_data['notificacion_sanitaria'] = $product['notificacion_sanitaria'] ?? '';
        }
        
        $response[] = $product_data;
    }
    
    echo json_encode($response);
    
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?> 