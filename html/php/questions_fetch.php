<?php
require_once __DIR__ . '/../../conexion.php';

// Configurar headers para JSON
header('Content-Type: application/json');

try {
    // Obtener el módulo de la URL
    $modulo = $_GET['modulo'] ?? null;
    
    if (!$modulo) {
        http_response_code(400);
        echo json_encode(['error' => 'Módulo no proporcionado']);
        exit;
    }
    
    error_log("🔍 questions_fetch.php - Buscando preguntas para módulo: $modulo");
    
    // Datos de prueba para el módulo 2 (pesaje)
    $preguntas = [
        [
            'id_pregunta' => 1,
            'pregunta' => '¿Se encuentran el área con materias primas, materiales, insumos y productos que no se requieren para la referencia y lote a fabricar?'
        ],
        [
            'id_pregunta' => 2,
            'pregunta' => '¿Están las áreas, equipos y herramientas necesarios para el proceso de preparación limpios y desinfectados?'
        ],
        [
            'id_pregunta' => 3,
            'pregunta' => '¿El personal que participará del proceso, porta el uniforme incompleto y sucio, de acuerdo con el procedimiento pr-cc-10?'
        ],
        [
            'id_pregunta' => 4,
            'pregunta' => '¿Están los procedimientos escritos de preparación, desinfección de áreas y equipos corresponde al producto a elaborar?'
        ],
        [
            'id_pregunta' => 5,
            'pregunta' => '¿Verificar si las cantidades de las materias primas corresponden a la orden, si se encuentran limpias, aprobadas por control calidad y rotuladas?'
        ],
        [
            'id_pregunta' => 6,
            'pregunta' => '¿Los recipientes que se utilizaran para mezclar y preparar el producto a fabricar, se encuentran sucios y sin desinfectar?'
        ],
        [
            'id_pregunta' => 7,
            'pregunta' => '¿El agua (fría y/o caliente) a utilizar en la manufactura del producto, cumple con las especificaciones definidas?'
        ],
        [
            'id_pregunta' => 8,
            'pregunta' => '¿En el área de preparación disponen del patrón estándar del producto a elaborar?'
        ]
    ];
    
    error_log("🔍 questions_fetch.php - Preguntas encontradas: " . count($preguntas));
    error_log("🔍 questions_fetch.php - Datos: " . json_encode($preguntas));
    
    echo json_encode($preguntas, JSON_NUMERIC_CHECK);
    
} catch (Exception $e) {
    error_log("❌ questions_fetch.php - Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error interno del servidor: ' . $e->getMessage()]);
}
?> 