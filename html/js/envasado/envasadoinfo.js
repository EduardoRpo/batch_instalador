let pres;
let envase;
let presentacion;
let r1, r2, r3 = 0;

//Cargar equipos

$.ajax({
  url: `/api/equipos`,
  type: 'GET'
}).done((data, status, xhr) => {
  $('#sel_envasadora').append(`<option value="">Seleccionar</option>`);
  $('#sel_loteadora').append(`<option value="">Seleccionar</option>`);
  data.forEach(equipo => {
    if (equipo.tipo == 'envasadora')
      $('#sel_envasadora').append(`<option value="${equipo.id}">${equipo.descripcion}</option>`);
    if (equipo.tipo == 'loteadora')
      $('#sel_loteadora').append(`<option value="${equipo.id}">${equipo.descripcion}</option>`);
  });
});


//validacion de campos y botones

function cargar(btn, idbtn) {

  localStorage.setItem("idbtn", idbtn);
  localStorage.setItem("btn", btn.id);
  id = btn.id;

  /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */

  let seleccion = $('.in_desinfeccion').val();

  if (seleccion == "Seleccione") {
    alertify.set("notifier", "position", "top-right"); alertify.error("Seleccione el producto para desinfección.");
    return false;
  }

  if (typeof id_multi !== 'undefined') {
    /* Validacion que todos los datos en linea y el formulario de control en preparacion no esten vacios */

    if (id == `controlpeso_realizado${id_multi}`) {
      validar = validarLinea();

      if (validar == 0)
        return false;

      /* Valida que todas las muestras y el lote se encuentren correctas*/

      validar = validarLote();

      if (validar == 0)
        return false;

      i = localStorage.getItem('totalmuestras')
      cantidad_muestras = $(`#muestras${id_multi}`).val();

      if (i != cantidad_muestras) {
        alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todas las muestras");
        return false;
      }
    }

    if (id == `devolucion_realizado${id_multi}`) {

      let cantidadEnvasada = $(`.txtEnvasada${id_multi}`).val();

      if (cantidadEnvasada == '') {
        alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos");
        return false;
      }

      //validar en que multipresentacion se encuentra
      id_multi == 1 ? (start = 1, end = 4) : id_multi == 2 ? (start = 4, end = 7) : (start = 7, end = 10)

      //validar que los datos de toda la tabla se encuentran completos
      for (let i = start; i < end; i++) {
        let averias = $(`#averias${i}`).val();
        let sobrante = $(`#sobrante${i}`).val();
        if (averias == '' || sobrante == '') {
          alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos");
          return false;
        }
      }
    }
  }

  /* Carga el modal para la autenticacion */

  $('#usuario').val('');
  $('#clave').val('');
  $('#m_firmar').modal('show');

}

//Carga el proceso despues de cargar la data  del Batch

$(document).ready(function () {

  /* setTimeout(() => {
    if (proceso == 5) { */
      batch_record();
      busqueda_multi();
      identificarDensidad(batch);
      deshabilitarbotones();
 /*    }
  }, 500); */
});

/* deshabilitar botones */

function deshabilitarbotones() {

  for (let i = 1; i < 4; i++) {
    $(`.controlpeso_realizado${i}`).prop('disabled', true);
    $(`.controlpeso_verificado${i}`).prop('disabled', true);
    $(`.devolucion_realizado${i}`).prop('disabled', true);
    $(`.devolucion_verificado${i}`).prop('disabled', true);
  }
}


/* Cargar Multipresentacion */

function busqueda_multi() {
  //batch = batch_record();
  ocultarEnvasado();
  /* ocultarfilasTanques(5); */

  $.ajax({

    'method': 'POST',
    'url': '../../html/php/busqueda_multipresentacion.php',
    'data': { idBatch },

    success: function (data) {

      batchMulti = JSON.parse(data);

      let j = 1;
      if (batchMulti !== 0) {
        for (let i = 0; i < batchMulti.length; i++) {
          referencia = batchMulti[i].referencia;
          presentacion = batchMulti[i].presentacion;
          cantidad = batchMulti[i].cantidad;
          total = batchMulti[i].total;

          $(`#ref${j}`).val(referencia);

          $(`#tanque${j}`).html(formatoCO(presentacion));
          $(`#cantidad${j}`).html(formatoCO(cantidad));
          $(`#total${j}`).html(formatoCO(total));

          $(`#fila${j}`).attr("hidden", false);
          $(`#envasado${j}`).attr("hidden", false);
          $(`#envasadoMulti${j}`).html('ENVASADO PRESENTACIÓN: ' + presentacion);
          cargarTablaEnvase(j, referencia, cantidad);
          calcularMuestras(j, cantidad);
          j++;
        }
      } else {
        //debugger;

        $(`#tanque${j}`).html(formatoCO(batch.presentacion));
        $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
        $(`#total${j}`).html(formatoCO(batch.tamano_lote));
        $(`#envasadoMulti${j}`).html('ENVASADO PRESENTACIÓN: ' + batch.presentacion);
        $(`#ref${j}`).val(referencia);
        cargarTablaEnvase(j, batch.referencia, batch.unidad_lote);
        calcularMuestras(j, batch.unidad_lote);
      }
      multi = j + 1;
    },
    error: function (r) {
      alertify.set("notifier", "position", "top-right"); alertify.error("Error al Cargar la multipresentacion.");
    }

  });
};

/* Ocultar Envasado */

function ocultarEnvasado() {
  for (let i = 2; i < 6; i++) {
    $(`#envasado${i}`).attr("hidden", true);
  }
}

/* Cargar referencia */

$('.ref_multi1').click(function (e) {
  e.preventDefault();
  ref_multi = $(`.ref1`).val();
  id_multi = 1;
  r1++;
  presentacion_multi();
});

$('.ref_multi2').click(function (e) {
  e.preventDefault();
  ref_multi = $(`.ref2`).val();
  id_multi = 2;
  r2++;
  presentacion_multi();
});

$('.ref_multi3').click(function (e) {
  e.preventDefault();
  ref_multi = $(`.ref3`).val();
  id_multi = 3;
  r3++;
  presentacion_multi();
});

function presentacion_multi() {
  envase = $(`#envasadoMulti${id_multi}`).html();
  presentacion = envase.slice(23, envase.length);
  cargarfirma2();
}



/* Cargar linea y maquinas de acuerdo con la seleccion */

/* $(".select-Linea").change(function () {
  cargarEquipos();
}) */

/* Calcular peso minimo, maximo y promedio */

/* Identificar densidad */

function identificarDensidad(batch) {

  let densidadAprobada = 0;
  $.ajax({
    type: "POST",
    url: "../../html/php/controlProceso.php",
    data: { modulo: 4, idBatch },

    success: function (response) {

      if (response == 0)
        return false;
      else {
        let espec = JSON.parse(response);
        for (let i = 0; i < espec.data.length; i++) {
          densidadAprobada = densidadAprobada + espec.data[i].densidad;
        }
        densidadAprobada = densidadAprobada / espec.data.length;
        calcularPeso(densidadAprobada);

      }
    }
  });
}

function calcularPeso(densidadAprobada) {

  var peso_min = batch.presentacion * densidadAprobada;
  var peso_minimo = formatoCO(peso_min);

  var peso_max = peso_min * (1 + 0.03);
  var peso_maximo = formatoCO(peso_max);

  var prom = (parseInt(peso_min) + peso_max) / 2;
  var promedio = formatoCO(prom);

  $(`.minimo`).val(peso_minimo);
  $(`.maximo`).val(peso_maximo);
  $(`.medio`).val(promedio);
}

/* Validar que el valor del lote corresponda */

function validarLote() {

  const lote = $(`#validarLote${id_multi}`).val();

  if (lote == '') {
    alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese el número del lote");
    $("#validarLote").val('').css('border-color', 'red');
    return 0;
  }
}


function revisarLote() {

  let data = $(`#validarLote${id_multi}`).val();
  let lote = $('#in_numero_lote').val();

  if (lote != data) {
    alertify.set("notifier", "position", "top-right"); alertify.error("Lote digitado no corresponde al procesado. Valide nuevamente!");
    $(`#validarLote${id_multi}`).val('').css('border-color', 'red');
    return false;
  }
  $(`#validarLote${id_multi}`).css('border-color', '#67757c');
};

/* Carga tabla de envase del producto */

function cargarTablaEnvase(j, referencia, cantidad) {

  $.ajax({
    url: '../../html/php/envase.php',
    type: 'POST',
    data: { referencia },

  }).done((data, status, xhr) => {

    var info = JSON.parse(data);
    empaqueEnvasado = Math.round(cantidad / info.data[0].unidad_empaque);
    unidades = formatoCO(cantidad);

    $(`.envase${j}`).html(info.data[0].id_envase);
    $(`.descripcion_envase${j}`).html(info.data[0].envase);

    $(`.tapa${j}`).html(info.data[0].id_tapa);
    $(`.descripcion_tapa${j}`).html(info.data[0].tapa);

    $(`.etiqueta${j}`).html(info.data[0].id_etiqueta);
    $(`.descripcion_etiqueta${j}`).html(info.data[0].etiqueta);

    /* $(`.empaque${j}`).html(info.data[0].id_empaque);
    $(`.descripcion_empaque${j}`).html(info.data[0].empaque);

    $(`.otros${j}`).html(info.data[0].id_otros);
    $(`.descripcion_otros${j}`).html(info.data[0].otros); */

    $(`.unidades${j}`).html(unidades);
    $(`.unidades${j}e`).html(empaqueEnvasado);

  });
}

/* Calculo de la devolucion de material */

function devolucionMaterialEnvasada(valor) {

  let unidades_envasadas = formatoCO(parseInt(valor));

  if (isNaN(unidades_envasadas)) {
    unidades_envasadas = 0;
  }

  //si la cantidad de envasado es diferente a los recibido envie una notificacion, la orden de produccion, diferencia entre recibida y envasada y presentacion
  $(`.envasada${id_multi}`).html(unidades_envasadas);

  recalcular_valores();

}

//recalcular valores en la tabla de devolucion de materiales envase
function recalcular_valores() {

  if (id_multi == 1) {
    envasada = $(`.txtEnvasada1`).val();
    min = 1; max = 4;
  }
  if (id_multi == 2) {
    envasada = $(`.txtEnvasada2`).val();
    min = 4; max = 7;
  }
  if (id_multi == 3) {
    envasada = $(`.txtEnvasada3`).val();
    min = 7; max = 10;
  }

  for (let i = min; i < max; i++) {
    let averias = $(`#averias${i}`).val();
    let sobrante = $(`#sobrante${i}`).val();
    averias == '' ? averias = 0 : averias;
    sobrante == '' ? sobrante = 0 : sobrante;
    let total = parseInt(envasada) + parseInt(averias) + parseInt(sobrante);
    total = formatoCO(parseInt(total));
    $(`#totalDevolucion${i}`).html(total);
  }

}

/* Validar linea seleccionada */

function validarLinea() {

  const linea = $(`#select-Linea${id_multi}`).val();

  if (linea == null) {
    alertify.set("notifier", "position", "top-right"); alertify.error("Seleccione la linea");
    return 0;
  }
}


/* Almacena la info de tabla devolucion material */

function registrar_material_sobrante(info) {

  let materialsobrante = [];

  for (let i = start; i < end; i++) {
    let datasobrante = {};
    let itemref = $(`.refEmpaque${id_multi}`).html();
    let envasada = formatoGeneral($(`.txtEnvasada${id_multi}`).html());

    if (envasada == '')
      envasada = formatoGeneral($(`.txtEnvasada${id_multi}`).val());

    let averias = $(`#averias${i}`).val();
    let sobrante = $(`#sobrante${i}`).val();

    datasobrante.referencia = itemref;
    datasobrante.envasada = envasada;
    datasobrante.averias = averias;
    datasobrante.sobrante = sobrante;
    materialsobrante.push(datasobrante);
  }

  $.ajax({
    type: "POST",
    url: '../../html/php/c_devolucionMaterial.php',
    data: { materialsobrante, ref_multi, idBatch, modulo, info },

    success: function (response) {
      alertify.set("notifier", "position", "top-right"); alertify.success("Firmado satisfactoriamente");
    }
  });

};


/* carga de maquinas */

function cargarEquipos() {

  linea = $(`#select-Linea${id_multi}`).val();

  $.ajax({
    method: 'POST',
    url: '../../html/php/cargarMaquinas.php',
    data: { linea: linea },

    success: function (response) {
      const info = JSON.parse(response);
      $(`.envasadora${id_multi}`).val('');
      $(`.loteadora${id_multi}`).val('');
      $(`.envasadora${id_multi}`).val(info.data[2].maquina);
      $(`.loteadora${id_multi}`).val(info.data[4].maquina);
    },
    error: function (response) {
      console.log(response);
    }
  })
}

function deshabilitarbtn() {
  //$(`.controlpeso_realizado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
  btn = localStorage.getItem('btn');

  if (btn == 'despeje_realizado')
    for (let i = 1; i < 4; i++)
      $(`.controlpeso_realizado${i}`).prop('disabled', false);

  if (btn == `controlpeso_realizado${id_multi}`) {
    $(`.controlpeso_realizado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    $(`.controlpeso_verificado${id_multi}`).prop('disabled', false);
  }

  if (btn == `devolucion_realizado${id_multi}`) {
    $(`.devolucion_realizado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    $(`.devolucion_realizado${id_multi}`).prop('disabled', false);
  }

}