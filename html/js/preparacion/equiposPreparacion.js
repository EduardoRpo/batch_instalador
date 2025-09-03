/**
 * Archivo específico para cargar equipos en el módulo de PREPARACIÓN
 * Evita conflictos con otras funciones del sistema
 */

// Función para cargar equipos (agitador y marmita)
function cargarEquiposPreparacion() {
    console.log('🔍 cargarEquiposPreparacion - Función iniciada');
    console.log('🔍 cargarEquiposPreparacion - Módulo actual:', modulo);
    console.log('🔍 cargarEquiposPreparacion - ID Batch:', idBatch);
    
    // Verificar que los elementos existen
    const selectorAgitador = $('#sel_agitador');
    const selectorMarmita = $('#sel_marmita');
    
    console.log('🔍 cargarEquiposPreparacion - Selector agitador encontrado:', selectorAgitador.length > 0);
    console.log('🔍 cargarEquiposPreparacion - Selector marmita encontrado:', selectorMarmita.length > 0);
    
    if (selectorAgitador.length === 0) {
        console.error('❌ cargarEquiposPreparacion - No se encontró el selector #sel_agitador');
        return;
    }
    
    if (selectorMarmita.length === 0) {
        console.error('❌ cargarEquiposPreparacion - No se encontró el selector #sel_marmita');
        return;
    }
    
    console.log('🔍 cargarEquiposPreparacion - Elementos encontrados, cargando desde BD...');
    
    // CARGAR DESDE BASE DE DATOS REAL
    cargarEquiposDesdeBD();
    
    console.log('✅ cargarEquiposPreparacion - Función completada');
}

// Función para cargar equipos desde la base de datos
function cargarEquiposDesdeBD() {
    console.log('🔍 cargarEquiposDesdeBD - Iniciando carga desde BD');
    
    // Cargar agitadores
    $.ajax({
        type: 'POST',
        url: '../../html/php/equipos_fetch.php',
        data: { tipo: 'agitador' },
        success: function(response) {
            console.log('🔍 cargarEquiposDesdeBD - Respuesta de agitadores:', response);
            console.log('🔍 cargarEquiposDesdeBD - Tipo de respuesta:', typeof response);
            
            try {
                const agitadores = JSON.parse(response);
                console.log('✅ cargarEquiposDesdeBD - Agitadores parseados exitosamente:', agitadores);
                console.log('🔍 cargarEquiposDesdeBD - Cantidad de agitadores:', agitadores.length);
                
                // Limpiar selector
                $('#sel_agitador').empty();
                $('#sel_agitador').append('<option value="">Seleccione</option>');
                
                // Agregar opciones
                agitadores.forEach((agitador, index) => {
                    console.log(`🔍 cargarEquiposDesdeBD - Agregando agitador ${index + 1}:`, agitador);
                    $('#sel_agitador').append(`<option value="${agitador.id}">${agitador.nombre}</option>`);
                });
                
                // Agregar opción "No aplica"
                $('#sel_agitador').append('<option value="no_aplica">No aplica</option>');
                console.log('✅ cargarEquiposDesdeBD - Agitadores cargados exitosamente');
                
            } catch (error) {
                console.error('❌ cargarEquiposDesdeBD - Error parseando agitadores:', error);
                console.error('❌ cargarEquiposDesdeBD - Respuesta que causó el error:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ cargarEquiposDesdeBD - Error cargando agitadores:');
            console.error('❌ cargarEquiposDesdeBD - Status:', status);
            console.error('❌ cargarEquiposDesdeBD - Error:', error);
            console.error('❌ cargarEquiposDesdeBD - XHR:', xhr);
        }
    });
    
    // Cargar marmitas/tanques
    $.ajax({
        type: 'POST',
        url: '../../html/php/equipos_fetch.php',
        data: { tipo: 'marmita' },
        success: function(response) {
            console.log('🔍 cargarEquiposDesdeBD - Respuesta de marmitas:', response);
            console.log('🔍 cargarEquiposDesdeBD - Tipo de respuesta:', typeof response);
            
            try {
                const marmitas = JSON.parse(response);
                console.log('✅ cargarEquiposDesdeBD - Marmitas parseadas exitosamente:', marmitas);
                console.log('🔍 cargarEquiposDesdeBD - Cantidad de marmitas:', marmitas.length);
                
                // Limpiar selector
                $('#sel_marmita').empty();
                $('#sel_marmita').append('<option value="">Seleccione</option>');
                
                // Agregar opciones
                marmitas.forEach((marmita, index) => {
                    console.log(`🔍 cargarEquiposDesdeBD - Agregando marmita ${index + 1}:`, marmita);
                    $('#sel_marmita').append(`<option value="${marmita.id}">${marmita.nombre}</option>`);
                });
                
                console.log('✅ cargarEquiposDesdeBD - Marmitas cargadas exitosamente');
                
            } catch (error) {
                console.error('❌ cargarEquiposDesdeBD - Error parseando marmitas:', error);
                console.error('❌ cargarEquiposDesdeBD - Respuesta que causó el error:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ cargarEquiposDesdeBD - Error cargando marmitas:');
            console.error('❌ cargarEquiposDesdeBD - Status:', status);
            console.error('❌ cargarEquiposDesdeBD - Error:', error);
            console.error('❌ cargarEquiposDesdeBD - XHR:', xhr);
        }
    });
}

console.log('✅ equiposPreparacion.js - Archivo cargado correctamente'); 