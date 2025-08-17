<?php
require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

// Probar si la clase Constants se puede cargar
try {
    // Incluir el autoloader
    require_once __DIR__ . '/../../api/AutoloaderSourceCode.php';
    
    // Intentar usar la clase Constants
    $constantsPath = __DIR__ . '/../../api/src/constants/Constants.php';
    
    if (file_exists($constantsPath)) {
        include_once $constantsPath;
        
        if (class_exists('BatchRecord\Constants\Constants')) {
            $result = [
                'status' => 'success',
                'message' => 'Clase Constants cargada correctamente',
                'constants_path' => $constantsPath,
                'logs_path' => \BatchRecord\Constants\Constants::LOGS_PATH
            ];
        } else {
            $result = [
                'status' => 'error',
                'message' => 'Clase Constants no encontrada después de incluir el archivo',
                'constants_path' => $constantsPath,
                'file_exists' => file_exists($constantsPath)
            ];
        }
    } else {
        $result = [
            'status' => 'error',
            'message' => 'Archivo Constants.php no encontrado',
            'constants_path' => $constantsPath
        ];
    }
    
} catch (Exception $e) {
    $result = [
        'status' => 'error',
        'message' => 'Error al cargar Constants: ' . $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ];
}

echo json_encode($result, JSON_PRETTY_PRINT);
?> 