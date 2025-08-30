let idBatch = location.href.split('/')[4];
let referencia = location.href.split('/')[5];
let proceso = $('h1:eq(1)').text();
var modulo;
var batch;
let template;
let cantidadpreguntas;
let completo = 0;
let text;

/* cargar batch al finalizar la carga de los demas procesos */

dataBatch = async () => {
  let result;
  try {
    console.log('🔍 dataBatch - Iniciando búsqueda de batch con ID:', idBatch);
    console.log('🔍 dataBatch - URL que se va a llamar:', `/html/php/batch_info_fetch.php?id=${idBatch}`);
    
    result = await $.ajax({ url: `/html/php/batch_info_fetch.php?id=${idBatch}` });
    console.log('✅ dataBatch - Respuesta exitosa:', result);
    return result;
  } catch (error) {
    console.error('❌ dataBatch - Error en la petición:', error);
    console.error('❌ dataBatch - Status:', error.status);
    console.error('❌ dataBatch - Response:', error.responseText);
  }
};

cargarInfoBatch = async () => {
  console.log('🔍 cargarInfoBatch - Iniciando carga de información del batch');
  const data = await dataBatch();
  console.log('🔍 cargarInfoBatch - Datos recibidos de dataBatch:', data);

  if (!data || data == null) {
    console.error('❌ cargarInfoBatch - No se encontraron datos para el batch');
    alertify.set('notifier', 'position', 'top-right');
    alertify.error(`No existe el batch en la Base de datos (${idBatch})`);
    return 1;
  } else {
    console.log('✅ cargarInfoBatch - Datos encontrados, procesando...');
    batch = data;
    const tamano_lote = formatoCO(Math.ceil(data.tamano_lote));
    console.log('🔍 cargarInfoBatch - Tamaño lote formateado:', tamano_lote);

    $('#in_numero_orden').val(data.numero_orden);
    $('#in_numero_lote').val(data.numero_lote);
    $('#in_referencia').val(data.referencia);
    $('#in_nombre_referencia').val(data.nombre_referencia);
    $('#in_linea').val(data.linea);
    $('#in_tamano_lote').val(tamano_lote);

    var fecha = new Date(data.fecha_programacion);
    var dias = 2; // Número de días a agregar
    fecha.setDate(fecha.getDate() + dias);
    $('#in_fecha_programacion').val(data.fecha_programacion);

    localStorage.setItem('orden', data.numero_orden);
    localStorage.setItem('tamano_lote', data.tamano_lote);
    batchInfo = JSON.stringify(batch);
    sessionStorage.setItem('batch', batchInfo);
    
    console.log('✅ cargarInfoBatch - Información del batch cargada exitosamente');
  }
};

$(document).ready(function () {
  Date.prototype.toDateInputValue = function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
  };

  $('#in_fecha').val(new Date().toDateInputValue());
  $('#in_fecha').attr('min', new Date().toDateInputValue());

  /* Deshabilitar botones de firmas */

  setTimeout(() => {
    $('.despeje_verificado').prop('disabled', true);
    $('.pesaje_realizado').prop('disabled', true);
    $('.pesaje_verificado').prop('disabled', true);

    if (modulo == 3) {
      $('.preparacion_realizado').prop('disabled', true);
      $('.preparacion_verificado').prop('disabled', true);
    } else if (modulo == 4) {
      $('.preparacion_realizado').prop('disabled', true);
      $('.preparacion_verificado').prop('disabled', true);
    }
  }, 500);

  /* Calcular la fecha del dia  */

  fechaHoy = () => {
    var d = new Date();

    var mes = d.getMonth() + 1;
    var dia = d.getDate();
    var fechaActual =
      d.getFullYear() +
      '/' +
      (mes < 10 ? '0' : '') +
      mes +
      '/' +
      (dia < 10 ? '0' : '') +
      dia;
  };

  //Validar seleccion en microbiologia y fisicoquimico

  validarSeleccion = () => {
    if ($("input[name='rdbtnConfirmacion']:radio").is(':checked')) {
    } else {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Seleccione Rechazado o Aprobado para el Batch Record ');
      return false;
    }
    let btnSeleccionado = $(
      'input:radio[name=rdbtnConfirmacion]:checked'
    ).val();
    if (btnSeleccionado == 0) {
      text = $('#observacionesLoteRechazado').val();
      if (text.lenght == 0 || text == '') {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Ingrese el motivo por el cual es Rechazado');
        return false;
      }
    } else {
      $('#observacionesLoteRechazado').val('');
      text = '';
    }
  };
});

/* formato de numeros miles y decimales */

const formatoCO = (number) => {
  if (number === undefined) {
    return false;
  }
  const exp = /(\d)(?=(\d{3})+(?!\d))/g;
  const rep = '$1.';
  let arr = number.toString().split('.');
  arr[0] = arr[0].replace(exp, rep);
  return arr[1] ? arr.join(',') : arr[0];
};

const formatoGeneral = (number) => {
  const numero = number.replace('.', '');
  const numero1 = numero.replace(',', '.');
  return numero1;
};
