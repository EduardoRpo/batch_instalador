/* Cargar Multipresentacion */

$(document).ready(function () {
  //let cantidad = 0;
  ocultarEnvasado();
  ocultarfilasTanques(5);

  $.ajax({

    'method': 'POST',
    'url': '../../html/php/busqueda_multipresentacion.php',
    'data': { id: idBatch },

    success: function (data) {
      var info = JSON.parse(data);
      let j = 1;
      for (let i = 0; i < info.length; i++) {
        $(`#tanque${j}`).html(formatoCO(info[i].presentacion));
        $(`#cantidad${j}`).html(formatoCO(info[i].cantidad));
        $(`#total${j}`).html(formatoCO(info[i].cantidad));

        $(`#fila${j}`).attr("hidden", false);
        $(`#envasado${j}`).attr("hidden", false);
        $(`#envasadoMulti${j}`).html('ENVASADO PRESENTACION: ' + info[i].presentacion);
        j++;

        //cantidad = cantidad + parseInt(info[i].cantidad);
      }
      //ocultarfilasTanques(info.length);

      /* if (proceso === "Pesaje" || proceso === "Preparación") {
        controlProceso(cantidad);
      } else if (proceso === "Aprobación") {
        cargaTanquesControl(cantidad);
      } */


    },
    error: function (r) {
      alertify.set("notifier", "position", "top-right"); alertify.error("Error al Cargar la multipresentacion.");
    }

  });
});

/* Ocultar Envasado */

function ocultarEnvasado() {
  for (let i = 2; i < 6; i++) {
    $(`#envasado${i}`).attr("hidden", true);
  }
}

/* Cargar linea y maquinas de acuerdo con la seleccion */

$("#select-Linea").change(function () {
  cargarMaquinas();
})

/* Calcular peso minimo, maximo y promedio */

function calcularPeso(batch) {
  var peso_min = batch.lote_presentacion * batch.densidad; // DENSIDAD DEBE TRAERSE DE LA GUARDADO EN APROBACION POR CALIDAD
  var peso_minimo = formatoCO(peso_min);

  var peso_max = peso_min * (1 + 0.03);
  var peso_maximo = formatoCO(peso_max);

  var prom = (parseInt(peso_min) + peso_max) / 2;
  var promedio = formatoCO(prom);

  $('#Minimo').val(peso_minimo);
  $('#Maximo').val(peso_maximo);
  $('#Medio').val(promedio);
}


/* Cargar el numero de muestras de acuerdo con las unidades a producir*/

function calcularMuestras(batch) {
  let muestras = batch.unidad_lote;

  if (muestras < 2001) {
    $('#Muestras').val(20);
  } else if (muestras > 2000 && muestras < 4001) {
    $('#Muestras').val(40);
  } else {
    $('#Muestras').val(60);
  }
}


/* Cargar el numero de muestras */

function muestrasEnvase() {

  let muestras = $('#Muestras').val();

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

  for (i = 1; i <= cantidad_muestras; i++) {
    if ($(`#txtMuestra${i}`).val() === '') {
      alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todas las muestras");
      return false;
    }
  }

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


/* Carga tabla de propiedades del producto */
function cargarTablaEnvase(batch) {

  $.ajax({
    url: '../../html/php/envase.php',
    type: 'POST',
    data: { id: batch.referencia },

  }).done((data, status, xhr) => {

    var info = JSON.parse(data);
    unidades = formatoCO(batch.unidad_lote);

    $('#tapa').html(info[0].referencia);
    $('#descripcion_tapa').html(info[0].descripcion);

    $('#envase').html(info[1].referencia);
    $('#descripcion_envase').html(info[1].descripcion);

    $('#otro').html(info[2].referencia);
    $('#descripcion_otro').html(info[2].descripcion);

    $('#tapa1').html(info[0].referencia);
    $('#descripcion_tapa1').html(info[0].descripcion);

    $('#envase1').html(info[1].referencia);
    $('#descripcion_envase1').html(info[1].descripcion);

    $('#otro1').html(info[2].referencia);
    $('#descripcion_otro1').html(info[2].descripcion);

    for (let i = 1; i < 7; i++) {
      $('#unidades' + i).html(unidades);
    }

  });
}

/* Calculo de la devolucion de material */

function devolucionMaterialEnvasada(valor) {

  let unidades_envasadas = formatoCO(parseInt(valor));

  if (isNaN(unidades_envasadas)) {
    unidades_envasadas = 0;
  }
  $('#txtEnvasada2').html(unidades_envasadas);
  $('#txtEnvasada3').html(unidades_envasadas);
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

function validarLote(data) {
  let lote = $('#in_numero_lote').val();

  if(lote != data){
    alertify.set("notifier", "position", "top-right"); alertify.error("Lote digitado no corresponde al procesado");
    return false;
  }

}