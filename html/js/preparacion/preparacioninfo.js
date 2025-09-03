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
  
  console.log('🔍 loadBatch - Llamando a cargarEquiposPreparacion()');
  try {
    cargarEquiposPreparacion();
    console.log('🔍 loadBatch - cargarEquiposPreparacion() ejecutado sin errores');
  } catch (error) {
    console.error('❌ loadBatch - Error al ejecutar cargarEquiposPreparacion():', error);
  }
  console.log('🔍 loadBatch - Después de llamar a cargarEquiposPreparacion()');
  
  // MODIFICADO: Agregar llamada a cargarControlProceso para cargar especificaciones
  // ANTES: No se llamaba a cargarControlProceso(), por eso el "Control de proceso" aparecía vacío
  // AHORA: Se llama a cargarControlProceso() para cargar las especificaciones desde la BD
  // Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
  console.log('🔍 loadBatch - Llamando a cargarControlProceso()');
  try {
    cargarControlProceso();
    console.log('🔍 loadBatch - cargarControlProceso() ejecutado sin errores');
  } catch (error) {
    console.error('❌ loadBatch - Error al ejecutar cargarControlProceso():', error);
  }
  console.log('🔍 loadBatch - Después de llamar a cargarControlProceso()');
  
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

console.log('🔍 PREPARACIÓN - Antes de definir cargarEquipos');

// Función eliminada - Se movió a equiposPreparacion.js para evitar conflictos

console.log('🔍 PREPARACIÓN - Después de definir cargarEquipos');

// Comentario para Git - Función cargarEquipos implementada para cargar equipos de preparación
