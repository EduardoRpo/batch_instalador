<?php
/**
 * Script para corregir automáticamente todos los archivos DAO que usan Constants
 * Reemplaza el uso de Constants::LOGS_PATH con una ruta hardcodeada
 */

$apiDir = __DIR__ . '/api/src/dao';
$files = [];

// Función recursiva para encontrar todos los archivos PHP
function findPhpFiles($dir, &$files) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    
    foreach ($iterator as $file) {
        if ($file->getExtension() === 'php') {
            $files[] = $file->getPathname();
        }
    }
}

// Encontrar todos los archivos PHP en el directorio dao
findPhpFiles($apiDir, $files);

$modifiedFiles = [];
$totalFiles = count($files);

echo "Analizando $totalFiles archivos PHP...\n";

foreach ($files as $file) {
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Verificar si el archivo usa Constants
    if (strpos($content, 'use BatchRecord\\Constants\\Constants;') !== false) {
        echo "Procesando: " . basename($file) . "\n";
        
        // Comentar la línea de use
        $content = str_replace(
            'use BatchRecord\\Constants\\Constants;',
            '// use BatchRecord\\Constants\\Constants;',
            $content
        );
        
        // Reemplazar Constants::LOGS_PATH con ruta hardcodeada
        $content = preg_replace(
            '/Constants::LOGS_PATH/',
            '__DIR__ . \'/../../../../logs/\'',
            $content
        );
        
        // Si el contenido cambió, guardar el archivo
        if ($content !== $originalContent) {
            file_put_contents($file, $content);
            $modifiedFiles[] = basename($file);
            echo "  ✓ Modificado: " . basename($file) . "\n";
        }
    }
}

echo "\nResumen:\n";
echo "Archivos modificados: " . count($modifiedFiles) . "\n";
if (!empty($modifiedFiles)) {
    echo "Archivos:\n";
    foreach ($modifiedFiles as $file) {
        echo "  - $file\n";
    }
}

echo "\n¡Proceso completado!\n";
?> 