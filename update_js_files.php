<?php
// Script para actualizar todos los archivos JavaScript

$js_updates = [
    'html/js/envasado/envasado.js' => [
        'old_url' => '/api/envasado',
        'new_url' => '/html/php/envasado_fetch.php',
        'old_dataSrc' => '',
        'new_dataSrc' => 'data',
        'add_type' => 'POST'
    ],
    'html/js/acondicionamiento/acondicionamiento.js' => [
        'old_url' => '/api/acondicionamiento',
        'new_url' => '/html/php/acondicionamiento_fetch.php',
        'old_dataSrc' => '',
        'new_dataSrc' => 'data',
        'add_type' => 'POST'
    ],
    'html/js/microbiologia/microbiologia.js' => [
        'old_url' => '/api/microbiologia',
        'new_url' => '/html/php/microbiologia_fetch.php',
        'old_dataSrc' => '',
        'new_dataSrc' => 'data',
        'add_type' => 'POST'
    ],
    'html/js/fisicoquimica/fisicoquimica.js' => [
        'old_url' => '/api/fisicoquimica',
        'new_url' => '/html/php/fisicoquimica_fetch.php',
        'old_dataSrc' => '',
        'new_dataSrc' => 'data',
        'add_type' => 'POST'
    ],
    'html/js/liberacionlote/liberacionlote.js' => [
        'old_url' => '/api/liberacionlote',
        'new_url' => '/html/php/liberacionlote_fetch.php',
        'old_dataSrc' => '',
        'new_dataSrc' => 'data',
        'add_type' => 'POST'
    ],
    'html/js/despachos/despachos.js' => [
        'old_url' => '/api/despachos',
        'new_url' => '/html/php/despachos_fetch.php',
        'old_dataSrc' => '',
        'new_dataSrc' => 'data',
        'add_type' => 'POST'
    ]
];

foreach ($js_updates as $filename => $changes) {
    if (file_exists($filename)) {
        $content = file_get_contents($filename);
        
        // Reemplazar URL
        $content = str_replace($changes['old_url'], $changes['new_url'], $content);
        
        // Reemplazar dataSrc
        $content = str_replace("dataSrc: \"{$changes['old_dataSrc']}\"", "dataSrc: \"{$changes['new_dataSrc']}\"", $content);
        
        // Agregar type si no existe
        if (!strpos($content, "type: \"POST\"")) {
            $content = str_replace(
                "ajax: {",
                "ajax: {\n      type: \"POST\",",
                $content
            );
        }
        
        // Actualizar referencias de datos de objetos a índices
        $content = str_replace('data: "id_batch"', 'data: 0', $content);
        $content = str_replace('data: "fecha_programacion"', 'data: 1', $content);
        $content = str_replace('data: "numero_orden"', 'data: 2', $content);
        $content = str_replace('data: "referencia"', 'data: 3', $content);
        $content = str_replace('data: "numero_lote"', 'data: 4', $content);
        $content = str_replace('data: "cantidad_firmas"', 'data: 5', $content);
        $content = str_replace('data: "total_firmas"', 'data: 6', $content);
        
        // Actualizar referencias en render functions
        $content = str_replace('row.id_batch', 'row[0]', $content);
        $content = str_replace('row.referencia', 'row[3]', $content);
        
        file_put_contents($filename, $content);
        echo "Actualizado: $filename\n";
    } else {
        echo "No encontrado: $filename\n";
    }
}

echo "\n¡Todos los archivos JavaScript han sido actualizados!\n";
?> 