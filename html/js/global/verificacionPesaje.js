/**
 * Función específica para automatizar verificación en pesaje
 * Solo se ejecuta en el módulo 2 (pesaje) y solo en el área de despeje
 */

// Función para marcar automáticamente el botón de verificado como aprobado
function marcarVerificadoDespejeComoAprobado() {
    // Solo ejecutar si estamos en el módulo de pesaje (módulo 2)
    if (modulo == 2) {
        console.log('🔍 marcarVerificadoDespejeComoAprobado - Módulo pesaje detectado');
        
        // Marcar el botón de verificado del despeje como aprobado
        const btnVerificado = $('.despeje_verificado');
        if (btnVerificado.length > 0) {
            btnVerificado
                .prop('disabled', true)
                .css({ 
                    background: "lightgray", 
                    border: "gray" 
                });
            console.log('✅ marcarVerificadoDespejeComoAprobado - Botón verificado marcado como aprobado');
        }
    }
} 