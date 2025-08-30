<?php
/**
 * Archivo para limpiar el cache de OPcache
 * Creado para resolver problemas de cache en archivos JS y PHP
 * 
 * @author Sistema
 * @version 1.0
 * @date 2025-01-01
 */

// Verificar si OPcache está disponible
if (function_exists('opcache_reset')) {
    // Limpiar el cache de OPcache
    $result = opcache_reset();
    
    if ($result) {
        echo "✅ Cache de OPcache limpiado exitosamente";
        echo "<br>Fecha: " . date('Y-m-d H:i:s');
        echo "<br>Servidor: " . $_SERVER['SERVER_NAME'];
    } else {
        echo "❌ Error al limpiar el cache de OPcache";
    }
} else {
    echo "⚠️ OPcache no está disponible en este servidor";
}

// También limpiar cache de archivos si es posible
if (function_exists('clearstatcache')) {
    clearstatcache();
    echo "<br>✅ Cache de archivos limpiado";
}

echo "<br><br><a href='javascript:history.back()'>← Volver</a>";
?> 