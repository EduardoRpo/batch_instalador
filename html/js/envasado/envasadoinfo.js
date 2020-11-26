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
      var info = JSON.parse(data);
      
      let j = 1;
      if (info !== "") {
        //validar las presentacion para una sola referencia y validar en el servidor que se esta repitiendo las presentaciones

        for (let i = 0; i < info.length; i++) {
          $(`#tanque${j}`).html(formatoCO(info[i].presentacion));
          $(`#cantidad${j}`).html(formatoCO(info[i].cantidad));
          $(`#total${j}`).html(formatoCO(info[i].total));

          $(`#fila${j}`).attr("hidden", false);
          $(`#envasado${j}`).attr("hidden", false);
          $(`#envasadoMulti${j}`).html('ENVASADO PRESENTACIÓN: ' + info[i].presentacion);
          j++;
        }
      } else {
        
        //batch = localStorage.getItem('batch');
        
        $(`#tanque${j}`).html(formatoCO(batch.presentacion));
        $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
        $(`#total${j}`).html(formatoCO(batch.tamano_lote));
      }
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

$("#select-Linea").change(function () {
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
      //validar densidad para una sola presentacion
      if (response == 3)
        console.log('nada');
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

  /* densidadAprobada = identificarDensidad(); */

  var peso_min = batch.presentacion * densidadAprobada; // DENSIDAD DEBE TRAERSE DE LA GUARDADO EN APROBACION POR CALIDAD
  var peso_minimo = formatoCO(peso_min);

  var peso_max = peso_min * (1 + 0.03);
  var peso_maximo = formatoCO(peso_max);

  var prom = (parseInt(peso_min) + peso_max) / 2;
  var promedio = formatoCO(prom);

  $('#Minimo').val(peso_minimo);
  $('#Maximo').val(peso_maximo);
  $('#Medio').val(promedio);
}

/* Validar que el lote digitado sea el correcto */

function validarLote(data) {
  let lote = $('#in_numero_lote').val();

  if (lote != data) {
    alertify.set("notifier", "position", "top-right"); alertify.error("Lote digitado no corresponde al procesado");
    return false;
  }

}

/* Cargar el numero de muestras de acuerdo con las unidades a producir*/

function calcularMuestras(batch) {
  let muestras = batch.unidad_lote;

  if (muestras <= 2000) {
    $('#Muestras').val(20);
  } else if (muestras >= 2001 && muestras < 4001) {
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


/* Carga tabla de propiedades del producto */
function cargarTablaEnvase(batch) {

  $.ajax({
    url: '../../html/php/envase.php',
    type: 'POST',
    data: { referencia: batch.referencia },

  }).done((data, status, xhr) => {
    //no debe traer la cantidad total de lote original sino de la cantidad de multipresentacion
    var info = JSON.parse(data);
    empaqueEnvasado = Math.round(info.data[0].id_empaque / batch.unidad_lote);
    unidades = formatoCO(batch.unidad_lote);

    $('#tapa').html(info.data[0].id_tapa);
    $('#descripcion_tapa').html(info.data[0].tapa);

    $('#envase').html(info.data[0].id_envase);
    $('#descripcion_envase').html(info.data[0].envase);

    $('#etiqueta').html(info.data[0].id_etiqueta);
    $('#descripcion_etiqueta').html(info.data[0].etiqueta);

    $('#empaque').html(info.data[0].id_empaque);
    $('#descripcion_empaque').html(info.data[0].empaque);

    $('#otros').html(info.data[0].id_otros);
    $('#descripcion_otros').html(info.data[0].otros);

    for (let i = 1; i < 11; i++) {
      if (i == 4 || i == 9)
        $('#unidades' + i).html(empaqueEnvasado);
      else
        $('#unidades' + i).html(unidades);
    }

    $('#tapa1').html(info.data[0].id_tapa);
    $('#descripcion_tapa1').html(info.data[0].tapa);

    $('#envase1').html(info.data[0].id_envase);
    $('#descripcion_envase1').html(info.data[0].envase);

    $('#etiqueta1').html(info.data[0].id_etiqueta);
    $('#descripcion_etiqueta1').html(info.data[0].etiqueta);

    $('#empaque1').html(info.data[0].id_empaque);
    $('#descripcion_empaque1').html(info.data[0].empaque);

    $('#otros1').html(info.data[0].id_otros);
    $('#descripcion_otros1').html(info.data[0].otros);
  });
}

/* Calculo de la devolucion de material */

function devolucionMaterialEnvasada(valor) {

  let unidades_envasadas = formatoCO(parseInt(valor));

  if (isNaN(unidades_envasadas)) {
    unidades_envasadas = 0;
  }
  debugger;
  for (let i = 1; i < 11; i++) {
    if (i == 4)
      $(`#txtEnvasada${i}`).html(empaqueEnvasado);
    else
      //si la cantidad de envasado es diferente a los recibido envie una notificacion, la orden de produccion, diferencia entre recibida y envasada y presentacion
      $(`#txtEnvasada${i}`).html(unidades_envasadas);
  }
}

function devolucionMaterialTotal(valor, id) {
  debugger;
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