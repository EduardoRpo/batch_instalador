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
    
    console.log('🔍 cargarEquiposPreparacion - Elementos encontrados, continuando...');
    
    // PRUEBA SIMPLE - Solo agregar una opción de prueba
    selectorAgitador.append('<option value="test">PRUEBA AGITADOR</option>');
    selectorMarmita.append('<option value="test">PRUEBA MARMITA</option>');
    
    console.log('✅ cargarEquiposPreparacion - Prueba completada exitosamente');
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
            
            try {
                const agitadores = JSON.parse(response);
                console.log('✅ cargarEquiposDesdeBD - Agitadores cargados:', agitadores);
                
                // Limpiar selector
                $('#sel_agitador').empty();
                $('#sel_agitador').append('<option value="">Seleccione</option>');
                
                // Agregar opciones
                agitadores.forEach(agitador => {
                    $('#sel_agitador').append(`<option value="${agitador.id}">${agitador.nombre}</option>`);
                });
                
                // Agregar opción "No aplica"
                $('#sel_agitador').append('<option value="no_aplica">No aplica</option>');
                
            } catch (error) {
                console.error('❌ cargarEquiposDesdeBD - Error parseando agitadores:', error);
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ cargarEquiposDesdeBD - Error cargando agitadores:', error);
        }
    });
    
    // Cargar marmitas/tanques
    $.ajax({
        type: 'POST',
        url: '../../html/php/equipos_fetch.php',
        data: { tipo: 'marmita' },
        success: function(response) {
            console.log('🔍 cargarEquiposDesdeBD - Respuesta de marmitas:', response);
            
            try {
                const marmitas = JSON.parse(response);
                console.log('✅ cargarEquiposDesdeBD - Marmitas cargadas:', marmitas);
                
                // Limpiar selector
                $('#sel_marmita').empty();
                $('#sel_marmita').append('<option value="">Seleccione</option>');
                
                // Agregar opciones
                marmitas.forEach(marmita => {
                    $('#sel_marmita').append(`<option value="${marmita.id}">${marmita.nombre}</option>`);
                });
                
            } catch (error) {
                console.error('❌ cargarEquiposDesdeBD - Error parseando marmitas:', error);
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ cargarEquiposDesdeBD - Error cargando marmitas:', error);
        }
    });
}

console.log('✅ equiposPreparacion.js - Archivo cargado correctamente'); 