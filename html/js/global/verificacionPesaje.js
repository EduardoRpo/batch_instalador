/**
 * Función específica para automatizar verificación en pesaje
 * Solo se ejecuta en el módulo 2 (pesaje) y solo en el área de despeje
 */

// Función para marcar automáticamente el botón de verificado como aprobado
function marcarVerificadoDespejeComoAprobado() {
    console.log('🔍 marcarVerificadoDespejeComoAprobado - Función iniciada');
    console.log('🔍 marcarVerificadoDespejeComoAprobado - Módulo actual:', modulo);
    console.log('🔍 marcarVerificadoDespejeComoAprobado - Tipo de módulo:', typeof modulo);
    
    // Solo ejecutar si estamos en el módulo de pesaje (módulo 2)
    if (modulo == 2) {
        console.log('✅ marcarVerificadoDespejeComoAprobado - Módulo pesaje detectado correctamente');
        
        // Buscar el botón de verificado del despeje
        const btnVerificado = $('.despeje_verificado');
        console.log('🔍 marcarVerificadoDespejeComoAprobado - Botón verificado encontrado:', btnVerificado.length > 0);
        console.log('🔍 marcarVerificadoDespejeComoAprobado - HTML del botón:', btnVerificado.html());
        
        if (btnVerificado.length > 0) {
            // Marcar como aprobado visualmente
            btnVerificado
                .prop('disabled', true)
                .css({ 
                    background: "lightgray", 
                    border: "gray" 
                });
            console.log('✅ marcarVerificadoDespejeComoAprobado - Botón verificado marcado como aprobado');
            console.log('🔍 marcarVerificadoDespejeComoAprobado - Estado después del cambio:', btnVerificado.prop('disabled'));
            
            // Guardar en la base de datos
            guardarVerificacionEnBD();
        } else {
            console.log('❌ marcarVerificadoDespejeComoAprobado - No se encontró el botón .despeje_verificado');
        }
    } else {
        console.log('❌ marcarVerificadoDespejeComoAprobado - No es módulo de pesaje, módulo actual:', modulo);
    }
}

// Función para guardar la verificación en la base de datos
function guardarVerificacionEnBD() {
    console.log('🔍 guardarVerificacionEnBD - Iniciando guardado en BD');
    console.log('🔍 guardarVerificacionEnBD - ID Batch:', idBatch);
    console.log('🔍 guardarVerificacionEnBD - Módulo:', modulo);
    
    // Crear datos para enviar
    let data = new FormData();
    data.append('operacion', '5'); // Operación para actualizar verifico
    data.append('modulo', modulo);
    data.append('batch', idBatch);
    data.append('verifico', '41'); // Usuario automático
    
    console.log('🔍 guardarVerificacionEnBD - Enviando datos:', {
        operacion: '5',
        modulo: modulo,
        batch: idBatch,
        verifico: '41'
    });
    
    // Llamar al endpoint para actualizar la base de datos usando jQuery AJAX
    $.ajax({
        type: 'POST',
        url: '../../html/php/despeje.php',
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {
            console.log('✅ guardarVerificacionEnBD - Respuesta exitosa:', result);
            if (result == '1') {
                console.log('✅ guardarVerificacionEnBD - Verificación guardada correctamente en BD');
            } else {
                console.log('❌ guardarVerificacionEnBD - Error al guardar en BD, respuesta:', result);
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ guardarVerificacionEnBD - Error en la petición:', error);
        }
    });
} 