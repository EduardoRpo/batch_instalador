let pres;
let envase;
let presentacion;

//validacion de campos y botones

function cargar(btn, idbtn) {

  localStorage.setItem("idbtn", idbtn);
  //btn = btn;
  id = btn;

  if (typeof id_multi !== 'undefined') {
    /* Validacion que todos los datos en linea y el formulario de control en preparacion no esten vacios */

    if (btn == `controlpeso_realizado${id_multi}`) {
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

    /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */

    let seleccion = $('#sel_producto_desinfeccion').val();

    if (seleccion == "Seleccione") {
      alertify.set("notifier", "position", "top-right"); alertify.error("Seleccione el producto para desinfección.");
      return false;
    }

    if (btn == `devolucion_realizado${id_multi}`) {

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

  setTimeout(() => {
    if (proceso == 5) {

      busqueda_multi(batch);
      identificarDensidad(batch);
      deshabilitarbotones();
    }
  }, 500);
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

function habilitarbotones() {

  btn_id = localStorage.getItem("idbtn");

  if (btn_id == 'firma1')
    $(`.controlpeso_realizado${id_multi}`).prop('disabled', false);
}

/* Cargar Multipresentacion */

function busqueda_multi(batch) {

  ocultarEnvasado();
  /* ocultarfilasTanques(5); */

  $.ajax({

    'method': 'POST',
    'url': '../../html/php/busqueda_multipresentacion.php',
    'data': { id: idBatch },

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
  presentacion_multi();
});

$('.ref_multi2').click(function (e) {
  e.preventDefault();
  ref_multi = $(`.ref2`).val();
  id_multi = 2;
  presentacion_multi();
});

$('.ref_multi3').click(function (e) {
  e.preventDefault();
  ref_multi = $(`.ref3`).val();
  id_multi = 3;
  presentacion_multi();
});

function presentacion_multi() {
  envase = $(`#envasadoMulti${id_multi}`).html();
  presentacion = envase.slice(23, envase.length);
  cargarfirma2();
}



/* Cargar linea y maquinas de acuerdo con la seleccion */

$(".select-Linea").change(function () {
  cargarEquipos();
})

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

/* Cargar el numero de muestras de acuerdo con las unidades a producir*/

function calcularMuestras(j, unidades) {

  if (unidades <= 2000) {
    $(`#muestras${j}`).val(20);
  } else if (unidades >= 2001 && unidades < 4001) {
    $(`#muestras${j}`).val(40);
  } else {
    $(`#muestras${j}`).val(60);
  }
}


/* Cargar el numero de muestras */

function muestrasEnvase() {

  let muestras = $(`#muestras${id_multi}`).val();
  let recoveredData = localStorage.getItem(presentacion + ref_multi)
  let j = 1;

  /* Elimina los campos para muestras */
  for (let i = 1; i <= 60; i++) {
    $(`#txtMuestra${i}`).remove();
  }

  /* Crea los campos para muestras para la referencia */
  for (let j = 1; j <= muestras; j++) {
    $(".txtMuestras").append(`<input type='number' min='1' class='form-control' id='txtMuestra${j}' placeholder='${j}' style='text-align:center; color:#67757c;'>`);// placeholder='${i}' style="border:0; border-bottom:1px solid #67757c"
  }

  if (recoveredData !== null) {
    let data = JSON.parse(recoveredData)
    for (let i = 0; i <= data.length; i++) {
      $(`#txtMuestra${j}`).val(data[i]);
      j++;
    }
  } else {
    $.ajax({
      type: "POST",
      url: '../../html/php/muestras.php',
      data: { operacion: 2, idBatch, modulo, ref_multi },

      success: function (response) {
        let promedio = 0;
        let info = JSON.parse(response)
        j = 1;

        for (let i = 0; i < info.data.length; i++) {
          $(`#txtMuestra${j}`).val(info.data[i].muestra);
          promedio = promedio + info.data[i].muestra
          j++;
        }
        promedio = promedio / $(`#muestras${id_multi}`).val();
        $(`#promedio${id_multi}`).val(promedio);

      }
    });
  }
}

function guardarMuestras() {

  let cantidad_muestras = $(`#muestras${id_multi}`).val();
  let muestras = [];
  let recoveredData = localStorage.getItem(presentacion + ref_multi)
  let promedio = 0;

  if (recoveredData !== '') {
    localStorage.removeItem(presentacion + ref_multi);
  }

  /* cargar el array con las muestras */

  for (i = 1; i <= cantidad_muestras; i++) {
    muestra = parseInt($(`#txtMuestra${i}`).val());
    if (muestra == '' || isNaN(muestra)) {
      break;
    }
    else {
      muestras.push(muestra);
      promedio = promedio + muestra;
    }
  }

  /* almacena las muestras */

  localStorage.setItem(presentacion + ref_multi, JSON.stringify(muestras));
  i = muestras.length;
  localStorage.setItem('totalmuestras', JSON.stringify(i));

  $('#m_muestras').modal('hide');

  //calcula el promedio de las muestras almacenadas
  promedio = promedio / muestras.length
  promedio = formatoCO(promedio.toFixed(2));

  $(`#promedio${id_multi}`).val(promedio);
}


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
  //empaqueEnvasado = $(`.unidades${id}e`).html();

  if (isNaN(unidades_envasadas)) {
    unidades_envasadas = 0;
  }
  //si la cantidad de envasado es diferente a los recibido envie una notificacion, la orden de produccion, diferencia entre recibida y envasada y presentacion
  $(`.envasada${id_multi}`).html(unidades_envasadas);
  //$(`.envasada${id}e`).html(empaqueEnvasado);

  //devolucionMaterialTotal(unidades_envasadas);
}

function devolucionMaterialTotal(valor, id) {

  let envasada = parseInt($(`.txtEnvasada${id_multi}`).val());

  /* if (isNaN(envasada)) {
    envasada = $(`#txtEnvasada${id}`).html();
    envasada = parseInt(formatoGeneral(envasada));
  } */

  let averias = parseInt($(`#averias${id}`).val());
  let total = envasada + averias + parseInt(valor);

  total = formatoCO(parseInt(total));
  if (isNaN(total)) {
    total = "";
  }

  $(`#totalDevolucion${id}`).html(total);

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

function registrarMaterialSobrante(info) {

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