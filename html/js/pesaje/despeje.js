/**
 * Archivo despeje.js - Manejo de desinfectantes
 * Agregado parámetro de versión para evitar cache del navegador
 * Creado para resolver errores 500 en desinfectantes_fetch.php
 * 
 * @author Sistema
 * @version 1.0
 * @date 2025-01-01
 */

const desinfectantes = async () => {
    console.log('🔍 desinfectantes - Iniciando carga de desinfectantes');
    console.log('🔍 desinfectantes - URL que se va a llamar:', `/html/php/desinfectantes_fetch.php?v=${Date.now()}`);
    
    try {
        const response = await $.ajax({
            url: `/html/php/desinfectantes_fetch.php?v=${Date.now()}`,
            type: 'GET',
            dataType: 'json'
        });
        
        console.log('✅ desinfectantes - Respuesta exitosa:', response);
        return response;
        
    } catch (error) {
        console.log('❌ desinfectantes - Error en la petición:', error);
        console.log('❌ desinfectantes - Status:', error.status);
        console.log('❌ desinfectantes - Response:', error.responseJSON);
        return null;
    }
}; 