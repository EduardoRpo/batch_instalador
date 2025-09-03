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
    
    // PRUEBA SIMPLE - Solo verificar que la función se ejecuta
    try {
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
        
        console.log('🔍 cargarEquipos - Elementos encontrados, continuando...');
        
        // PRUEBA SIMPLE - Solo agregar una opción de prueba
        selectorAgitador.append('<option value="test">PRUEBA AGITADOR</option>');
        selectorMarmita.append('<option value="test">PRUEBA MARMITA</option>');
        
        console.log('✅ cargarEquipos - Prueba completada exitosamente');
        
    } catch (error) {
        console.error('❌ cargarEquipos - Error en la función:', error);
    }
}
