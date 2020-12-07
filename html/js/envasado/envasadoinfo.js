
//Carga el proceso despues de cargar la data  del Batch

$(document).ready(function () {
  setTimeout(() => {
    if (proceso == 5) {
      busqueda_multi(batch);
      identificarDensidad(batch);
    }
  }, 500);
});


/* Cargar Multipresentacion */

function busqueda_multi(batch) {
  //let cantidad = 0;
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
      debugger;
      if (response == 3)
        console.log('');
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
  debugger;
  /* densidadAprobada = identificarDensidad(); */

  var peso_min = batch.presentacion * densidadAprobada; // DENSIDAD DEBE TRAERSE DE LA GUARDADO EN APROBACION POR CALIDAD
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

$(document).ready(function () {
  $(".validarLote").blur(function () {
    let data = $(".validarLote").val();
    let lote = $('#in_numero_lote').val();

    if (lote != data) {
      alertify.set("notifier", "position", "top-right"); alertify.error("Lote digitado no corresponde al procesado. Valide nuevamente!");
      $("#validarLote").val('').css('border-color', 'red');
      return false;
    }
    $("#validarLote").css('border-color', '#67757c');
  });
});

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

function muestrasEnvase(id) {

  let muestras =  $(`#muestras${id}`).val();

  for (let i = 1; i < 61; i++) {
    $(`#txtMuestra${i}`).remove();
  }

  for (let i = 1; i <= muestras; i++) {
    $(".txtMuestras").append(`<input type='number' min='1' class='form-control' id='txtMuestra${i}' placeholder='${i}'>`);
  }


  //$('#m_muestras').show();
}

function guardarMuestras() {

  let cantidad_muestras = $('#Muestras').val();
  let muestras = [];

  /* for (i = 1; i <= cantidad_muestras; i++) {
    if ($(`#txtMuestra${i}`).val() === '') {
      alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todas las muestras");
      return false;
    }
  } */

  for (i = 1; i <= cantidad_muestras; i++) {
    muestras.push($(`#txtMuestra${i}`).val());
  }


  $.ajax({
    method: 'POST',
    url: '../../html/php/muestras.php',
    data: { id: idBatch, muestras: muestras },

    success: function (response) {
      alertify.set("notifier", "position", "top-right"); alertify.error("Muestras almacenadas satisfactoriamente");
      $('#m_muestras').hide();
    },
    error: function (response) {
      console.log(response);
    }
  })

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

    $(`.tapa${j}`).html(info.data[0].id_tapa);
    $(`.descripcion_tapa${j}`).html(info.data[0].tapa);

    $(`.envase${j}`).html(info.data[0].id_envase);
    $(`.descripcion_envase${j}`).html(info.data[0].envase);

    $(`.etiqueta${j}`).html(info.data[0].id_etiqueta);
    $(`.descripcion_etiqueta${j}`).html(info.data[0].etiqueta);

    $(`.empaque${j}`).html(info.data[0].id_empaque);
    $(`.descripcion_empaque${j}`).html(info.data[0].empaque);

    $(`.otros${j}`).html(info.data[0].id_otros);
    $(`.descripcion_otros${j}`).html(info.data[0].otros);
    $(`.unidades${j}`).html(unidades);
    $(`.unidades${j}e`).html(empaqueEnvasado);

  });
}

/* Calculo de la devolucion de material */

function devolucionMaterialEnvasada(valor, id) {

  let unidades_envasadas = formatoCO(parseInt(valor));
  empaqueEnvasado = $(`.unidades${id}e`).html();

  if (isNaN(unidades_envasadas)) {
    unidades_envasadas = 0;
  }
//si la cantidad de envasado es diferente a los recibido envie una notificacion, la orden de produccion, diferencia entre recibida y envasada y presentacion
  $(`.envasada${id}`).html(unidades_envasadas);
  $(`.envasada${id}e`).html(empaqueEnvasado);

}

function devolucionMaterialTotal(valor, id) {

  //let recibida= parseInt(formatoGeneral($(`#unidades${id}`).html()));
  let envasada = parseInt($(`#txtEnvasada${id}`).val());

  if (isNaN(envasada)) {
    envasada = $(`#txtEnvasada${id}`).html();
    envasada = parseInt(formatoGeneral(envasada));
  }

  let averias = parseInt($(`#averias${id}`).val());
  let total = envasada + averias + parseInt(valor);

  total = formatoCO(parseInt(total));
  if (isNaN(total)) {
    total = "";
  }

  //$(`#totalDevolucion${id}`).val(total);
  $(`#totalDevolucion${id}`).html(total);

}