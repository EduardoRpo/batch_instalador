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
  let resp = await cargarInfoBatch();
  if (resp == null) {
    cargarTanques();
    cargarEquipos(); // Cargar equipos (agitador y marmita)
  }
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
    console.log('🔍 cargarEquipos - Iniciando carga de equipos para preparación');
    
    // Cargar agitadores
    $.ajax({
        type: 'POST',
        url: '../../html/php/equipos_fetch.php',
        data: { tipo: 'agitador' },
        success: function(response) {
            try {
                const agitadores = JSON.parse(response);
                console.log('✅ cargarEquipos - Agitadores cargados:', agitadores);
                
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
                console.error('❌ cargarEquipos - Error parseando agitadores:', error);
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ cargarEquipos - Error cargando agitadores:', error);
        }
    });
    
    // Cargar marmitas/tanques
    $.ajax({
        type: 'POST',
        url: '../../html/php/equipos_fetch.php',
        data: { tipo: 'marmita' },
        success: function(response) {
            try {
                const marmitas = JSON.parse(response);
                console.log('✅ cargarEquipos - Marmitas cargadas:', marmitas);
                
                // Limpiar selector
                $('#sel_marmita').empty();
                $('#sel_marmita').append('<option value="">Seleccione</option>');
                
                // Agregar opciones
                marmitas.forEach(marmita => {
                    $('#sel_marmita').append(`<option value="${marmita.id}">${marmita.nombre}</option>`);
                });
                
            } catch (error) {
                console.error('❌ cargarEquipos - Error parseando marmitas:', error);
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ cargarEquipos - Error cargando marmitas:', error);
        }
        });
}
