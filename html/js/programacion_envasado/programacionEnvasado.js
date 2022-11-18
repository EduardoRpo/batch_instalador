$(document).ready(function () {
  dataEnvasado = [];
  let date = new Date();
  apiPost = '/api/addFechaEnvasado';
  btnDeleteMulti = false;

  $('.adicionarMulti').hide();
  $('.footSaveMulti').hide();

  // Cargar tabla envasados por numero de semana

  $('#numSemana').change(function (e) {
    e.preventDefault();
    semana = $('#numSemana').val();

    //Aquí obtenemos el primer domingo del año
    primerdia = new Date(date.getFullYear(), 0, 1);

    // obtenemos la corrección necesaria
    correccion = 6 - primerdia.getDay();

    // obtenemos el lunes y domingo de la semana especificada
    primer = new Date(date.getFullYear(), 0, (semana - 1) * 7 + 3 + correccion);

    if (primer <= date) {
      primer.setDate(date.getDate() + 1);
      primer.setMonth(date.getMonth());
    }

    ultimo = new Date(date.getFullYear(), 0, (semana - 1) * 7 + 9 + correccion);

    fecha_minima = setFecha(primer);
    fecha_maxima = setFecha(ultimo);

    mesPrimer = primer.toLocaleString(undefined, { month: 'long' });
    mesUltimo = ultimo.toLocaleString(undefined, { month: 'long' });

    $('#fechaSemana').html(
      `${primer.getDate()} ${
        mesPrimer.charAt(0).toUpperCase() + mesPrimer.slice(1)
      } - ${ultimo.getDate()} ${
        mesUltimo.charAt(0).toUpperCase() + mesUltimo.slice(1)
      }`
    );

    $('.fechaProgramar').attr('min', fecha_minima);
    //$('.fechaProgramar').attr('max', fecha_maxima);
  });

  setFecha = (date) => {
    year = date.getFullYear();

    month = `${date.getMonth() + 1}`.padStart(2, 0);

    day = `${date.getDate()}`.padStart(2, 0);

    hour = date.toLocaleTimeString('de-DE', {
      hour: '2-digit',
      minute: '2-digit',
    });

    stringDate = `${[year, month, day].join('-')} ${hour}`;

    return stringDate;
  };

  $(document).on('blur', '.fechaProgramar', function (e) {
    e.preventDefault();
    id = this.id;
    fecha = $(`#${id}`).val();
    id_batch = id.slice(5, id.length);
    if (fecha == '' || !fecha) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese la fecha para programar el envasado');
      return false;
    } else {
      no_lote = $(this).parent().parent().children().eq(6).text();
      tamano_lote = $(this).parent().parent().children().eq(8).text();
      arrayEnvasado(id_batch, fecha, no_lote, tamano_lote);
    }
  });

  arrayEnvasado = (id_batch, fecha, no_lote, tamano_lote) => {
    for (i = 0; i < dataEnvasado.length; i++) {
      if (id_batch == dataEnvasado[i].idBatch) deleteArray(id_batch);
    }

    envasado = {};

    envasado.idBatch = id_batch;
    envasado.fechaEnvasado = fecha;
    envasado.no_lote = no_lote;
    envasado.tamano_lote = tamano_lote;

    let semana = new Date(fecha).getWeekNumber();

    envasado.semana = semana;

    dataEnvasado.push(envasado);
  };

  deleteArray = (id_batch) => {
    for (i = 0; i < dataEnvasado.length; i++) {
      if (dataEnvasado[i].idBatch == id_batch) {
        dataEnvasado.splice(i, 1);
      }
    }
  };

  $(document).on('click', '#btnProgramar', function (e) {
    e.preventDefault();
    if (dataEnvasado.length == 0) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese la fecha para programar el envasado');
      return false;
    } else {
      saveFechaEnvasado({ data: dataEnvasado });
    }
  });

  saveFechaEnvasado = async (data) => {
    resp = await sendDataPOST(apiPost, data);
    message(resp);
  };

  /* Mensaje de exito */
  message = (data) => {
    alertify.set('notifier', 'position', 'top-right');

    if (data.success == true) {
      actualizarTabla();
      $('#m_observaciones').modal('hide');
      alertify.success(data.message);
      dataEnvasado = [];
    } else if (data.error == true) alertify.error(data.message);
    else if (data.info == true) alertify.info(data.message);
  };

  /* Actualizar tabla */

  actualizarTabla = async () => {
    $('#tablaEnvasado').DataTable().clear();
    $('#tablaEnvasado').DataTable().ajax.reload();

    if ($.fn.dataTable.isDataTable('#tblCalcCapacidadEnvasado')) {
      $('#tblCalcCapacidadEnvasado').DataTable().destroy();
    }
    $('#tblCalcCapacidadEnvasadoBody').empty();
    await getDataCapacidadEnvasado();
  };
});
