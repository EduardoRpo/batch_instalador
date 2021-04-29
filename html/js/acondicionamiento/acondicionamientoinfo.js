/*let presentacion;
 let r1 = 0,
  r2 = 0,
  r3 = 0;
let id_multi = 1; */
const equipos = [];

//Carga el proceso despues de cargar la data  del Batch

$(document).ready(function () {
  setTimeout(() => {
    busqueda_multi();
    deshabilitarbotones();
  }, 500);
});

/* Cargar Multipresentacion */

function busqueda_multi() {
  ocultar_acondicionamiento();
  /* ocultarfilasTanques(5); */

  $.ajax({
    method: "POST",
    url: "../../html/php/busqueda_multipresentacion.php",
    data: { idBatch },

    success: function (data) {
      batchMulti = JSON.parse(data);

      let j = 1;
      if (batchMulti !== 0) {
        for (let i = 0; i < batchMulti.length; i++) {
          referencia = batchMulti[i].referencia;
          presentacion = batchMulti[i].presentacion;
          cantidad = batchMulti[i].cantidad;
          densidad = batchMulti[i].densidad;
          total = batchMulti[i].total;

          $(`#ref${j}`).val(referencia);
          $(`#unidad_empaque${j}`).val(batchMulti[i].unidad_empaque);
          $(`#presentacion${j}`).val(presentacion);
          $(`#densidad${j}`).val(densidad);
          $(`#total${j}`).val(total);

          $(`#tanque${j}`).html(formatoCO(presentacion));
          $(`#cantidad${j}`).html(formatoCO(cantidad));
          $(`#unidadesProgramadas${j}`).val(cantidad);
          $(`#total${j}`).html(formatoCO(total));

          $(`#fila${j}`).attr("hidden", false);
          $(`#acondicionamiento${j}`).attr("hidden", false);
          $(`#acondicionamientoMulti${j}`).html(
            `ACONDICIONAMIENTO PRESENTACIÓN: ${presentacion} REFERENCIA ${referencia}`
          );
          cargarTablaEnvase(j, referencia, cantidad);
          calcularMuestras(j, cantidad);

          //rendimiento = rendimiento_producto(referencia, presentacion, densidad, total);
          //$(`#rendimientoProducto${j}`).val(rendimiento);
          j++;
        }
      } else {
        batch == undefined ? location.reload() : batch;
        $(`#tanque${j}`).html(formatoCO(batch.presentacion));
        $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
        $(`#unidadesProgramadas${j}`).val(batch.unidad_lote);
        $(`#total${j}`).html(formatoCO(batch.tamano_lote));
        $(`#acondicionamientoMulti${j}`).html(
          `ACONDICIONAMIENTO PRESENTACIÓN: ${batch.presentacion} REFERENCIA: ${batch.referencia}`
        );

        $(`#ref${j}`).val(referencia);
        $(`#unidad_empaque${j}`).val(batch.unidad_empaque);
        $(`#presentacion${j}`).val(batch.presentacion);
        $(`#densidad${j}`).val(batch.densidad);
        /* $(`#total${j}`).val(batch.tamano_lote); */

        cargarTablaEnvase(j, batch.referencia, batch.unidad_lote);
        calcularMuestras(j, batch.unidad_lote);
        //rendimiento = rendimiento_producto(referencia, batch.presentacion, batch.unidad_lote, batch.densidad, batch.tamano_lote);
        //$(`#rendimientoProducto${j}`).val(rendimiento);
      }
      multi = j + 1;
    },
    error: function (r) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Error al Cargar la multipresentacion.");
    },
  });
}

/* deshabilitar botones */

function deshabilitarbotones() {
  for (let i = 1; i < 4; i++) {
    $(`.controlpeso_realizado${i}`).prop("disabled", true);
    $(`.controlpeso_verificado${i}`).prop("disabled", true);
    $(`.devolucion_realizado${i}`).prop("disabled", true);
    $(`.devolucion_verificado${i}`).prop("disabled", true);
    $(`.conciliacion_realizado${i}`).prop("disabled", true);
  }
}

function habilitarbotones() {
  btn_id = localStorage.getItem("idbtn");

  if (btn_id == "firma1")
    $(`.controlpeso_realizado${id_multi}`).prop("disabled", false);
}

/* Ocultar Envasado */

function ocultar_acondicionamiento() {
  for (let i = 2; i < 6; i++) {
    $(`#acondicionamiento${i}`).attr("hidden", true);
  }
}

/* Cargar tabla Material */

function cargarTablaEnvase(j, referencia, cantidad) {
  $.ajax({
    url: "../../html/php/envase.php",
    type: "POST",
    data: { referencia },
  }).done((data, status, xhr) => {
    var info = JSON.parse(data);
    empaqueEnvasado = formatoCO(Math.round(cantidad / info[0].unidad_empaque));
    unidades = formatoCO(cantidad);

    $(`.empaque${j}`).html(info[0].id_empaque);
    $(`.descripcion_empaque${j}`).html(info[0].empaque);

    $(`.otros${j}`).html(info[0].id_otros);
    $(`.descripcion_otros${j}`).html(info[0].otros);

    $(`.unidades${j}`).html(unidades);
    $(`.unidades${j}e`).html(empaqueEnvasado);
  });
}

function cargar(btn, idbtn) {
  localStorage.setItem("idbtn", idbtn);
  localStorage.setItem("btn", btn.id);
  id = btn.id;

  /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */
  let seleccion = $(".in_desinfeccion").val();

  if (seleccion == "Seleccione") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione el producto para desinfección.");
    return false;
  }

  /* Valida el proceso para la segunda seccion */
  if (id != "despeje_realizado") {
    let banda = $(`#sel_banda${id_multi}`).val();
    let etiquetadora = $(`#sel_etiquetadora${id_multi}`).val();
    let tunel = $(`#sel_tunel${id_multi}`).val();

    if (!banda || !etiquetadora || !tunel) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Seleccione los equipos de la linea de producción.");
      return false;
    } else {
      for (i = 1; i < 4; i++) {
        const equipo = {};
        if (i === 1) equipo.equipo = banda;
        if (i === 2) equipo.equipo = etiquetadora;
        if (i === 3) equipo.equipo = tunel;
        equipo.batch = idBatch;
        equipo.modulo = modulo;
        equipos.push(equipo);
      }
    }
  }
  /* validar que todas las muestras se registraron */
  if (id == `controlpeso_realizado${id_multi}`) {
    i = localStorage.getItem(`totalmuestras${id_multi}`);
    cantidad_muestras = $(`#muestras${id_multi}`).val() * 5;

    if (i != cantidad_muestras) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Ingrese todas las muestras");
      return false;
    }
  }

  if (id == `devolucion_realizado${id_multi}`) {
    let utilizada = $(`#utilizada_empaque${id_multi}`).val();
    let averias = $(`#averias_empaque${id_multi}`).val();
    let sobrante = $(`#sobrante_empaque${id_multi}`).val();

    if (utilizada == "" || averias == "" || sobrante == "") {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Ingrese todos los datos");
      return false;
    }

    utilizada = $(`#utilizada_otros${id_multi}`).val();
    averias = $(`#averias_otros${id_multi}`).val();
    sobrante = $(`#sobrante_otros${id_multi}`).val();

    if (utilizada == "" || averias == "" || sobrante == "") {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Ingrese todos los datos");
      return false;
    }
  }

  if (id == `conciliacion_realizado${id_multi}`) {
    let unidades = $(`#txtUnidadesProducidas${id_multi}`).val();
    let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
    let mov = $(`#txtNoMovimiento${id_multi}`).val();

    let conciliacion = unidades * retencion * mov;

    if (conciliacion == 0) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Ingrese todos los datos");
      return false;
    }
  }
  /* Carga el modal para la autenticacion */

  $("#usuario").val("");
  $("#clave").val("");
  $("#m_firmar").modal("show");
}

//recalcular valores en la tabla de devolucion de materiales envase
function recalcular_valores() {
  let utilizada = $(`#utilizada_empaque${id_multi}`).val();
  let averias = $(`#averias_empaque${id_multi}`).val();
  let sobrante = $(`#sobrante_empaque${id_multi}`).val();

  utilizada == "" ? (utilizada = 0) : utilizada;
  averias == "" ? (averias = 0) : averias;
  sobrante == "" ? (sobrante = 0) : sobrante;

  let total = parseInt(utilizada) + parseInt(averias) + parseInt(sobrante);
  total = formatoCO(parseInt(total));
  $(`#totalDevolucion_empaque${id_multi}`).html(total);

  utilizada = $(`#utilizada_otros${id_multi}`).val();
  averias = $(`#averias_otros${id_multi}`).val();
  sobrante = $(`#sobrante_otros${id_multi}`).val();

  utilizada == "" ? (utilizada = 0) : utilizada;
  averias == "" ? (averias = 0) : averias;
  sobrante == "" ? (sobrante = 0) : sobrante;

  total = parseInt(utilizada) + parseInt(averias) + parseInt(sobrante);
  total = formatoCO(parseInt(total));
  $(`#totalDevolucion_otros${id_multi}`).html(total);
}

function deshabilitarbtn() {
  btn = localStorage.getItem("btn");

  if (btn == "despeje_realizado")
    for (let i = 1; i < 4; i++)
      $(`.controlpeso_realizado${i}`).prop("disabled", false);

  if (btn == `controlpeso_realizado${id_multi}`) {
    $(`.controlpeso_realizado${id_multi}`)
      .css({ background: "lightgray", border: "gray" })
      .prop("disabled", true);
    $(`.controlpeso_verificado${id_multi}`).prop("disabled", false);
    $(`.devolucion_realizado${id_multi}`).prop("disabled", false);
  }

  if (btn == `devolucion_realizado${id_multi}`) {
    $(`.devolucion_realizado${id_multi}`)
      .css({ background: "lightgray", border: "gray" })
      .prop("disabled", true);
    $(`.devolucion_realizado${id_multi}`).prop("disabled", false);
  }
}

/* Almacena la info de tabla devolucion material */

function registrar_material_sobrante(info) {
  let materialsobrante = [];
  let datasobrante = {};

  let itemref = $(`#refempaque${id_multi}`).html();
  let envasada = $(`#utilizada_empaque${id_multi}`).val();
  let averias = $(`#averias_empaque${id_multi}`).val();
  let sobrante = $(`#sobrante_empaque${id_multi}`).val();

  datasobrante.referencia = itemref;
  datasobrante.envasada = envasada;
  datasobrante.averias = averias;
  datasobrante.sobrante = sobrante;
  materialsobrante.push(datasobrante);

  datasobrante = {};
  itemref = $(`#refempaque2`).html();
  envasada = $(`#utilizada_otros${id_multi}`).val();
  averias = $(`#averias_otros${id_multi}`).val();
  sobrante = $(`#sobrante_otros${id_multi}`).val();

  datasobrante.referencia = itemref;
  datasobrante.envasada = envasada;
  datasobrante.averias = averias;
  datasobrante.sobrante = sobrante;
  materialsobrante.push(datasobrante);

  $.ajax({
    type: "POST",
    url: "../../html/php/c_devolucionMaterial.php",
    data: { materialsobrante, ref_multi, idBatch, modulo, info },

    success: function (response) {
      if ((modulo = 6))
        $(`.conciliacion_realizado${id_multi}`).prop("disabled", false);
      alertify.set("notifier", "position", "top-right");
      alertify.success("Firmado satisfactoriamente");
    },
  });
}

let unidad = $("txtUnidadesProducidas").val();
/* validar unidades producidads vs la envasada - 
Enviar notificacion -- 
Texto (Existe una diferencia entre las unidades envasadas y las 
    acondicionadas de la orden de produccion XXX referencia XXXX)
 */

function conciliacionRendimiento() {
  let unidadEmpaque = $(`#unidad_empaque${id_multi}`).val(); //se debe cargar desde envasado
  let unidadesProducidas = parseInt(
    $(`#txtUnidadesProducidas${id_multi}`).val()
  );
  let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
  let unidadesProgramadas = parseInt(
    $(`#unidadesProgramadas${id_multi}`).val()
  );

  if (retencion == undefined || retencion == "") retencion = 0;

  isNaN(unidadesProducidas) ? (unidadesProducidas = 0) : unidadesProducidas;

  if (parseInt(retencion) > parseInt(unidadesProducidas)) {
    alertify.set("notifier", "position", "top-right");
    alertify.error(
      "La cantidad de muestras de retención no debe ser superior a la cantidad de Unidades Producidas"
    );
    var totalCajas = "";
    var entregarBodega = "";
  } else {
    totalCajas = Math.floor((unidadesProducidas - retencion) / unidadEmpaque);
    entregarBodega = unidadesProducidas - retencion;
  }

  $(`#txtTotal-Cajas${id_multi}`).val(formatoCO(totalCajas));
  $(`#txtEntrega-Bodega${id_multi}`).val(formatoCO(entregarBodega));
  $(`#txtPorcentaje-Unidades${id_multi}`).val(
    ((unidadesProducidas / unidadesProgramadas) * 100).toFixed(2) + "%"
  );

  rendimiento_producto();
}

function rendimiento_producto() {
  cantidad = $(`#txtUnidadesProducidas${id_multi}`).val();
  presentacion = $(`#presentacion${id_multi}`).val();
  densidad = $(`#densidad${id_multi}`).val();
  total = $(`#in_tamano_lote`).val(); //total de la presentacion
  total = total.replace(".", "");

  let rendimiento = (presentacion * cantidad * densidad) / 1000;
  rendimiento = ((rendimiento / total) * 100).toFixed(2) + "%";
  $(`#rendimientoProducto${id_multi}`).val(rendimiento);
}

function registrar_conciliacion(idfirma) {
  let unidades = $(`#txtUnidadesProducidas${id_multi}`).val();
  let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
  let mov = $(`#txtNoMovimiento${id_multi}`).val();
  let operacion = 1;

  $.post(
    "../../html/php/conciliacion_rendimiento.php",
    (data = {
      operacion,
      unidades,
      retencion,
      mov,
      modulo,
      idBatch,
      ref_multi,
      idfirma,
    }),
    function (data, textStatus, jqXHR) {
      if (textStatus == "success") {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Conciliación registrada satisfactoriamente");
        $(`.conciliacion_realizado${id_multi}`)
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);
      }
    }
  );
}
