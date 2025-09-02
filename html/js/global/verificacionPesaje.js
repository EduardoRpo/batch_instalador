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
            // Marcar como aprobado
            btnVerificado
                .prop('disabled', true)
                .css({ 
                    background: "lightgray", 
                    border: "gray" 
                });
            console.log('✅ marcarVerificadoDespejeComoAprobado - Botón verificado marcado como aprobado');
            console.log('🔍 marcarVerificadoDespejeComoAprobado - Estado después del cambio:', btnVerificado.prop('disabled'));
        } else {
            console.log('❌ marcarVerificadoDespejeComoAprobado - No se encontró el botón .despeje_verificado');
        }
    } else {
        console.log('❌ marcarVerificadoDespejeComoAprobado - No es módulo de pesaje, módulo actual:', modulo);
    }
} 