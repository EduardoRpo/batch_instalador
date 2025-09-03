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
    
    // Usar archivo fetch local (como en pesaje) para evitar errores de API
    $.ajax({
        url: '../../html/php/equipos_fetch.php',
        type: 'GET',
        success: function(data) {
            console.log('🔍 cargarEquiposDesdeBD - Respuesta de /api/equipos:', data);
            console.log('🔍 cargarEquiposDesdeBD - Tipo de respuesta:', typeof data);
            console.log('🔍 cargarEquiposDesdeBD - Cantidad de equipos:', data.length);
            
            // Limpiar selectores
            $('#sel_agitador').empty();
            $('#sel_marmita').empty();
            
            // Agregar opciones por defecto
            $('#sel_agitador').append('<option value="">Seleccione</option>');
            $('#sel_marmita').append('<option value="">Seleccione</option>');
            
            // Procesar equipos por tipo (igual que equipos.js)
            data.forEach((equipo, index) => {
                console.log(`🔍 cargarEquiposDesdeBD - Procesando equipo ${index + 1}:`, equipo);
                
                if (equipo.tipo === 'agitador') {
                    console.log(`🔍 cargarEquiposDesdeBD - Agregando agitador: ${equipo.descripcion}`);
                    $('#sel_agitador').append(
                        `<option value="${equipo.id}">${equipo.descripcion}</option>`
                    );
                }
                
                if (equipo.tipo === 'marmita') {
                    console.log(`🔍 cargarEquiposDesdeBD - Agregando marmita: ${equipo.descripcion}`);
                    $('#sel_marmita').append(
                        `<option value="${equipo.id}">${equipo.descripcion}</option>`
                    );
                }
            });
            
            // Agregar opción "No aplica" para agitador
            $('#sel_agitador').append('<option value="no_aplica">No aplica</option>');
            
            console.log('✅ cargarEquiposDesdeBD - Equipos cargados exitosamente');
            console.log('🔍 cargarEquiposDesdeBD - Agitadores encontrados:', $('#sel_agitador option').length - 2); // -2 por "Seleccione" y "No aplica"
            console.log('🔍 cargarEquiposDesdeBD - Marmitas encontradas:', $('#sel_marmita option').length - 1); // -1 por "Seleccione"
        },
        error: function(xhr, status, error) {
            console.error('❌ cargarEquiposDesdeBD - Error cargando equipos:');
            console.error('❌ cargarEquiposDesdeBD - Status:', status);
            console.error('❌ cargarEquiposDesdeBD - Error:', error);
            console.error('❌ cargarEquiposDesdeBD - XHR:', xhr);
            
            // Agregar opciones por defecto en caso de error
            $('#sel_agitador').empty();
            $('#sel_agitador').append('<option value="">Error al cargar</option>');
            $('#sel_agitador').append('<option value="no_aplica">No aplica</option>');
            
            $('#sel_marmita').empty();
            $('#sel_marmita').append('<option value="">Error al cargar</option>');
        }
    });
}

console.log('✅ equiposPreparacion.js - Archivo cargado correctamente'); 