<?php
/**
 * ARCHIVO NUEVO - Creado para evitar errores de API /api/productsDetails
 * Consulta directamente las tablas de especificaciones del producto
 * Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
 * Motivo: La API /api/productsDetails devuelve error 500
 */

require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    // Obtener referencia del parámetro GET
    $referencia = $_GET['referencia'] ?? '';
    
    if (empty($referencia)) {
        echo json_encode(['error' => 'Referencia no especificada']);
        exit;
    }
    
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consultar especificaciones del producto
    $sql = "SELECT 
                p.referencia, 
                p.nombre_referencia,
                c.nombre as color,
                o.nombre as olor,
                a.nombre as apariencia,
                ph.limite_inferior as limite_inferior_ph,
                ph.limite_superior as limite_superior_ph,
                v.limite_inferior as limite_inferior_viscosidad,
                v.limite_superior as limite_superior_viscosidad,
                d.limite_inferior as limite_inferior_densidad_gravedad,
                d.limite_superior as limite_superior_densidad_gravedad,
                u.nombre as untuosidad,
                pe.nombre as poder_espumoso,
                ga.limite_inferior as limite_inferior_grado_alcohol,
                ga.limite_superior as limite_superior_grado_alcohol,
                rm.nombre as mesofilos,
                ps.nombre as pseudomona,
                e.nombre as escherichia,
                s.nombre as staphylococcus
            FROM producto p
            LEFT JOIN color c ON c.id = p.id_color
            LEFT JOIN olor o ON o.id = p.id_olor
            LEFT JOIN apariencia a ON a.id = p.id_apariencia
            LEFT JOIN ph ON ph.id = p.id_ph
            LEFT JOIN viscosidad v ON v.id = p.id_viscosidad
            LEFT JOIN densidad_gravedad d ON d.id = p.id_densidad_gravedad
            LEFT JOIN untuosidad u ON u.id = p.id_untuosidad
            LEFT JOIN poder_espumoso pe ON pe.id = p.id_poder_espumoso
            LEFT JOIN grado_alcohol ga ON ga.id = p.id_grado_alcohol
            LEFT JOIN recuento_mesofilos rm ON rm.id = p.id_recuento_mesofilos
            LEFT JOIN pseudomona ps ON ps.id = p.id_pseudomona
            LEFT JOIN escherichia e ON e.id = p.id_escherichia
            LEFT JOIN staphylococcus s ON s.id = p.id_staphylococcus
            WHERE p.referencia = :referencia";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(['referencia' => $referencia]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($producto) {
        echo json_encode($producto, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['error' => 'Producto no encontrado']);
    }
    
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de base de datos: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error general: ' . $e->getMessage()]);
}
?> 