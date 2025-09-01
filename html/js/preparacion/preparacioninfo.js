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
  if (resp != null) {
    cargarTanques();
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
