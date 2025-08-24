<?php
// Archivo temporal para verificar documentos de M-21407

try {
    // Configuración de base de datos
    $host = '172.17.0.1';
    $port = '3307';
    $dbname = 'batch_record';
    $username = 'root';
    $password = 'S@m4r@_2025!';
    
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $referencia = 'M-21407';
    
    echo "<h2>Verificación de documentos para: $referencia</h2>";
    
    // Primero obtener el granel correspondiente a la referencia
    echo "<h3>Búsqueda del granel:</h3>";
    $stmtGranel = $pdo->prepare("
        SELECT multi as granel 
        FROM producto 
        WHERE referencia = :referencia
    ");
    $stmtGranel->execute(['referencia' => $referencia]);
    $productoData = $stmtGranel->fetch(PDO::FETCH_ASSOC);
    
    if ($productoData) {
        $granel = $productoData['granel'];
        echo "Granel encontrado para $referencia: <strong>$granel</strong><br>";
    } else {
        echo "No se encontró producto para referencia: $referencia<br>";
        exit;
    }
    
    // Verificar fórmulas por granel
    echo "<h3>Fórmulas (buscando por granel '$granel'):</h3>";
    $stmtFormula = $pdo->prepare("
        SELECT COUNT(*) as count 
        FROM formula 
        WHERE id_producto = :granel
    ");
    $stmtFormula->execute(['granel' => $granel]);
    $formulas = $stmtFormula->fetch(PDO::FETCH_ASSOC)['count'];
    echo "Fórmulas encontradas: $formulas<br>";
    
    // Verificar instructivos por granel
    echo "<h3>Instructivos (buscando por granel '$granel'):</h3>";
    $stmtInstructivo = $pdo->prepare("
        SELECT COUNT(*) as count 
        FROM instructivo_preparacion 
        WHERE id_producto = :granel
    ");
    $stmtInstructivo->execute(['granel' => $granel]);
    $instructivos = $stmtInstructivo->fetch(PDO::FETCH_ASSOC)['count'];
    echo "Instructivos encontrados: $instructivos<br>";
    
    // Calcular estado
    $result = $formulas * $instructivos;
    $estado = ($result == 0) ? 0 : 1;
    
    echo "<h3>Resultado:</h3>";
    echo "Fórmulas × Instructivos = $formulas × $instructivos = $result<br>";
    echo "Estado calculado: $estado<br>";
    echo "Descripción: " . ($estado == 0 ? 'Falta Formula e Instructivo' : 'Inactivo') . "<br>";
    
    // Verificar si el producto existe
    echo "<h3>Verificación del producto:</h3>";
    $stmtProducto = $pdo->prepare("
        SELECT * FROM producto WHERE referencia = :referencia
    ");
    $stmtProducto->execute(['referencia' => $referencia]);
    $producto = $stmtProducto->fetch(PDO::FETCH_ASSOC);
    
    if ($producto) {
        echo "Producto encontrado: " . $producto['nombre_referencia'] . "<br>";
    } else {
        echo "Producto NO encontrado<br>";
    }
    
    // Verificar estructura de tablas
    echo "<h3>Estructura de tabla formula:</h3>";
    $stmtStructure = $pdo->prepare("DESCRIBE formula");
    $stmtStructure->execute();
    $formulaStructure = $stmtStructure->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>" . print_r($formulaStructure, true) . "</pre>";
    
    echo "<h3>Estructura de tabla instructivo_preparacion:</h3>";
    $stmtStructure2 = $pdo->prepare("DESCRIBE instructivo_preparacion");
    $stmtStructure2->execute();
    $instructivoStructure = $stmtStructure2->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>" . print_r($instructivoStructure, true) . "</pre>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?> 