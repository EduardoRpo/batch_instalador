idBatch = location.href.split('/')[4];
referencia = location.href.split('/')[5];
let queeProcess = 0;
var pasos;
let paso = 4;
let tanqueOk = 0;
let tiempoTotal = 0;
let pasoEjecutado = 0;
modulo = 3;

loadBatch = async () => {
  console.log('🔍 loadBatch - Función iniciada');
  console.log('🔍 loadBatch - Llamando a cargarInfoBatch()');
  
  let resp = await cargarInfoBatch();
  console.log('🔍 loadBatch - Respuesta de cargarInfoBatch:', resp);
  
  if (resp == null) {
    console.log('🔍 loadBatch - Respuesta es null, llamando a cargarTanques()');
    cargarTanques();
  } else {
    console.log('🔍 loadBatch - Respuesta no es null, saltando cargarTanques()');
  }
  
  console.log('🔍 loadBatch - Llamando a cargarEquipos()');
  cargarEquipos();
  
  console.log('🔍 loadBatch - Función completada');
};

loadBatch();
cargarInstructivos();

/* Cargar fecha */

Date.prototype.toDateInputValue = function () {
  var local = new Date(this);
  local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
  return local.toJSON().slice(0, 10);
};

$('#in_fecha').attr('min', new Date().toDateInputValue());

// Función para cargar equipos (agitador y marmita)
function cargarEquipos() {
    console.log('🔍 cargarEquipos - Función iniciada - PRUEBA SIMPLE');
    console.log('🔍 cargarEquipos - Función iniciada');
    console.log('🔍 cargarEquipos - Módulo actual:', modulo);
    console.log('🔍 cargarEquipos - ID Batch:', idBatch);
    
    // Verificar que los elementos existen
    const selectorAgitador = $('#sel_agitador');
    const selectorMarmita = $('#sel_marmita');
    
    console.log('🔍 cargarEquipos - Selector agitador encontrado:', selectorAgitador.length > 0);
    console.log('🔍 cargarEquipos - Selector marmita encontrado:', selectorMarmita.length > 0);
    
    if (selectorAgitador.length === 0) {
        console.error('❌ cargarEquipos - No se encontró el selector #sel_agitador');
        return;
    }
    
    if (selectorMarmita.length === 0) {
        console.error('❌ cargarEquipos - No se encontró el selector #sel_marmita');
        return;
    }
    
    console.log('🔍 cargarEquipos - Iniciando carga de agitadores...');
    
    // Cargar agitadores
    $.ajax({
        type: 'POST',
        url: '../../html/php/equipos_fetch.php',
        data: { tipo: 'agitador' },
        success: function(response) {
            console.log('🔍 cargarEquipos - Respuesta de agitadores recibida:', response);
            console.log('🔍 cargarEquipos - Tipo de respuesta:', typeof response);
            
            try {
                const agitadores = JSON.parse(response);
                console.log('✅ cargarEquipos - Agitadores parseados exitosamente:', agitadores);
                console.log('🔍 cargarEquipos - Cantidad de agitadores:', agitadores.length);
                
                // Limpiar selector
                selectorAgitador.empty();
                selectorAgitador.append('<option value="">Seleccione</option>');
                
                // Agregar opciones
                agitadores.forEach((agitador, index) => {
                    console.log(`🔍 cargarEquipos - Agregando agitador ${index + 1}:`, agitador);
                    selectorAgitador.append(`<option value="${agitador.id}">${agitador.nombre}</option>`);
                });
                
                // Agregar opción "No aplica"
                selectorAgitador.append('<option value="no_aplica">No aplica</option>');
                console.log('✅ cargarEquipos - Agitadores cargados exitosamente');
                
            } catch (error) {
                console.error('❌ cargarEquipos - Error parseando agitadores:', error);
                console.error('❌ cargarEquipos - Respuesta que causó el error:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ cargarEquipos - Error cargando agitadores:');
            console.error('❌ cargarEquipos - Status:', status);
            console.error('❌ cargarEquipos - Error:', error);
            console.error('❌ cargarEquipos - XHR:', xhr);
        }
    });
    
    console.log('🔍 cargarEquipos - Iniciando carga de marmitas...');
    
    // Cargar marmitas/tanques
    $.ajax({
        type: 'POST',
        url: '../../html/php/equipos_fetch.php',
        data: { tipo: 'marmita' },
        success: function(response) {
            console.log('🔍 cargarEquipos - Respuesta de marmitas recibida:', response);
            console.log('🔍 cargarEquipos - Tipo de respuesta:', typeof response);
            
            try {
                const marmitas = JSON.parse(response);
                console.log('✅ cargarEquipos - Marmitas parseadas exitosamente:', marmitas);
                console.log('🔍 cargarEquipos - Cantidad de marmitas:', marmitas.length);
                
                // Limpiar selector
                selectorMarmita.empty();
                selectorMarmita.append('<option value="">Seleccione</option>');
                
                // Agregar opciones
                marmitas.forEach((marmita, index) => {
                    console.log(`🔍 cargarEquipos - Agregando marmita ${index + 1}:`, marmita);
                    selectorMarmita.append(`<option value="${marmita.id}">${marmita.nombre}</option>`);
                });
                
                console.log('✅ cargarEquipos - Marmitas cargadas exitosamente');
                
            } catch (error) {
                console.error('❌ cargarEquipos - Error parseando marmitas:', error);
                console.error('❌ cargarEquipos - Respuesta que causó el error:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ cargarEquipos - Error cargando marmitas:');
            console.error('❌ cargarEquipos - Status:', status);
            console.error('❌ cargarEquipos - Error:', error);
            console.error('❌ cargarEquipos - XHR:', xhr);
        }
    });
    
    console.log('🔍 cargarEquipos - Función completada');
}
