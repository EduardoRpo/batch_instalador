$(document).ready(function () {
  dataEnvasado = [];
  let date = new Date();

  /* Numero de semanas */
  // Calcular numero de semana actual
  Date.prototype.getWeekNumber = function () {
    var d = new Date(+this);
    d.setHours(0, 0, 0, 0);
    d.setDate(d.getDate() + 4 - (d.getDay() || 7));

    return Math.ceil(((d - new Date(d.getFullYear(), 0, 1)) / 8.64e7 + 1) / 7);
  };

  //Cargar total semanas
  loadNumSemanas = () => {
    // Calcular numero de semana actual
    semanaActual = new Date().getWeekNumber();

    select = $('#numSemana');

    select.empty();
    select.append(`<option disabled selected>Numero Semana</option>`);

    for (i = 1; i <= 52; i++) {
      if (i >= semanaActual) {
        options = $('#numSemana option').length;
        if (options <= 12) select.append(`<option value ="${i}">${i}</option>`);
      }
    }
  };
  loadNumSemanas();

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
    $('.fechaProgramar').attr('max', fecha_maxima);
  });

  setFecha = (date) => {
    year = date.getFullYear();

    month = `${date.getMonth() + 1}`.padStart(2, 0);

    day = `${date.getDate()}`.padStart(2, 0);

    stringDate = [year, month, day].join('-');

    return stringDate;
  };

  $(document).on('blur', '.fechaProgramar', function (e) {
    e.preventDefault();
    id = this.id;
    fecha = $(`#${id}`).val();
    arrayEnvasado(id, fecha);
  });

  arrayEnvasado = (id_batch, fecha) => {
    for (i = 0; i < dataEnvasado.length; i++) {
      if (id_batch == dataEnvasado[i].idBatch) deleteArray(id_batch);
    }

    envasado = {};

    envasado.idBatch = id_batch;
    envasado.fechaEnvasado = fecha;

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
      $.ajax({
        type: 'POST',
        url: '/api/addFechaEnvasado',
        data: { data: dataEnvasado },
        success: function (resp) {
          message(resp);
        },
      });
    }
  });

  /* Mensaje de exito */
  message = (data) => {
    alertify.set('notifier', 'position', 'top-right');

    if (data.success == true) {
      actualizarTabla();
      alertify.success(data.message);
    } else if (data.error == true) alertify.error(data.message);
    else if (data.info == true) alertify.info(data.message);
  };

  /* Actualizar tabla */

  actualizarTabla = () => {
    $('#tablaEnvasado').DataTable().clear();
    $('#tablaEnvasado').DataTable().ajax.reload();
  };
});
