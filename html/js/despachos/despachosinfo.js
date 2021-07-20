modulo = 7;
let flag = 0;

/* Carga el modal para la autenticacion */

cargar = (btn, idbtn) => {
  sessionStorage.setItem("idbtn", idbtn);
  id = btn.id;

  unidades = $(`#unidades_recibidas${id_multi}`).val();
  cajas = $(`#cajas${id_multi}`).val();
  mov_acond = $(`#mov_inventario_acond${id_multi}`).val();
  movimiento = $(`#mov_inventario${id_multi}`).val();
  total = unidades * cajas * movimiento;

  if (total == 0) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Complete todos los campos");
    return false;
  }

  if (mov_acond != movimiento) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Números de movimiento no son iguales, revise nuevamente");
    return false;
  }

  $("#usuario").val("");
  $("#clave").val("");
  $("#m_firmar").modal("show");
};

//Carga el proceso despues de cargar la data  del Batch

$(document).ready(function () {
  setTimeout(() => {
    busqueda_multi(batch);
  }, 500);
});

/* Cargar Multipresentacion */

function busqueda_multi(batch) {
  ocultar_presentacion_despachos();

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
          total = batchMulti[i].total;

          $(`#ref${j}`).val(referencia);
          $(`#unidad_empaque${j}`).val(batchMulti[i].unidad_empaque);

          $(`#tanque${j}`).html(formatoCO(presentacion));
          $(`#cantidad${j}`).html(formatoCO(cantidad));
          $(`#total${j}`).html(formatoCO(total));

          $(`#fila${j}`).attr("hidden", false);
          $(`#despachos${j}`).attr("hidden", false);
          $(`#despachosMulti${j}`).html(
            `DESPACHOS PRESENTACIÓN: ${presentacion} REFERENCIA ${referencia}`
          );

          j++;
        }
      } else {
        batch == undefined ? location.reload() : batch;
        $(`#tanque${j}`).html(formatoCO(batch.presentacion));
        $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
        $(`#total${j}`).html(formatoCO(batch.tamano_lote));
        $(`#despachosMulti${j}`).html(
          `DESPACHOS PRESENTACIÓN: ${batch.presentacion} REFERENCIA: ${batch.referencia}`
        );
        $(`#ref${j}`).val(referencia);
        $(`#unidad_empaque${j}`).val(batch.unidad_empaque);
      }
      multi = j + 1;
    },
    error: function (r) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Error al Cargar la multipresentacion.");
    },
  });
}

/* Ocultar presentacion despachos */

function ocultar_presentacion_despachos() {
  for (let i = 2; i < 6; i++) {
    $(`#despachos${i}`).attr("hidden", true);
  }
}

function cargar_despacho() {
  let op = 1;
  $.post(
    "../../html/php/despachos.php",
    (data = { op, idBatch, ref_multi, modulo }),
    function (data, textStatus, jqXHR) {
      let info = JSON.parse(data);
      if (info == 0) return false;
      unidades_empaque = parseFloat($(`#unidad_empaque${id_multi}`).val());

      let unidades = 0,
        cajas = 0,
        retencion = 0;
      let unidadestotales = "";
      let number, myString;
      let j = 1;

      info.forEach((element) => {
        if (element.modulo == 6) {
          unidades = unidades + element.unidades;
          cajas = cajas + element.cajas;
          retencion = retencion + element.retencion;
        }
      });

      unidades_empaque = parseFloat($(`#unidad_empaque${id_multi}`).val());
      cajs = Math.ceil((unidades - retencion) / unidades_empaque);
      for (let i = 0; i < info.length; i++) {
        if (info[i]["modulo"] == 6) {
          number = info[i]["unidades"];
          cjas = info[i]["cajas"];
          mov = info[i]["movimiento"];
          myString = `Parcial ${j}: (${number.toString()} unidades) (${cjas.toString()} cajas) (Movimiento: ${mov.toString()}).\n`;
          unidadestotales = unidadestotales + " " + myString;
          j++;
        }
      }
      j = info.length - 1;
      $(`#unidades_recibidas_acond${id_multi}`).val(unidades);
      $(`#cajas_acond${id_multi}`).val(cajs);
      $(`#mov_inventario_acond${id_multi}`).val(info[j].movimiento);
      $(`#mestras_retencion_acond${id_multi}`).val(retencion);
      $(`#parciales${id_multi}`).val(unidadestotales);

      /* Despachos */
      unidades = 0;
      cajas = 0;
      for (let i = 0; i < info.length; i++) {
        if (info[i]["modulo"] == 7) {
          unidades = unidades + info[i]["unidades"];
          cajas = cajas + info[i]["cajas"];
          movimiento = info[i]["movimiento"];
        }
      }

      $(`#consolidado_despachos_recibidas${id_multi}`).val(unidades);
      $(`#consolidado_despachos_cajas${id_multi}`).val(cajas);
      $(`#consolidado_despachos_mov_inventario${id_multi}`).val(movimiento);
    }
  );
  $.post(
    "../../html/php/despachos.php",
    (data = { op: 2, idBatch, ref_multi, modulo }),
    function (data, textStatus, jqXHR) {
      if (data == "") return false;
      info = JSON.parse(data);
      firmado(info);
    }
  );
}

function guardar_despacho(info) {
  //infof = JSON.parse(data);
  realizo = info[0].id;
  let unidades = $(`#unidades_recibidas${id_multi}`).val();
  let cajas = $(`#cajas${id_multi}`).val();
  let mov = $(`#mov_inventario${id_multi}`).val();
  let obs = $(`#obs${id_multi}`).val();
  let operacion = 3;
  modulo == 7 ? (operacion = 1) : operacion;

  data = {
    operacion,
    unidades,
    cajas,
    mov,
    obs,
    modulo,
    idBatch,
    ref_multi,
    realizo,
  };

  alertify
    .confirm(
      "Entrega",
      "¿Entrega parcial?",
      function () {
        $.post(
          "../../html/php/servicios/parciales.php",
          data,
          function (info, textStatus, jqXHR) {
            if (textStatus == "success") {
              alertify.set("notifier", "position", "top-right");
              alertify.success("Registro de despacho parcial exitoso");
              $(`#unidades_recibidas${id_multi}`).val("");
              $(`#cajas${id_multi}`).val("");
              $(`#mov_inventario${id_multi}`).val("");
              cargar_despacho();
            }
          }
        );
      },
      function () {
        $.post(
          "../../html/php/conciliacion_rendimiento.php",
          data,
          function (info, textStatus, jqXHR) {
            if (textStatus == "success") {
              alertify.set("notifier", "position", "top-right");
              alertify.success("Registro de despacho exitoso");
              $(`.despacho${id_multi}`)
                .css({ background: "lightgray", border: "gray" })
                .prop("disabled", true);
              cargar_despacho();
              $(`#unidades_recibidas${id_multi}`).val("");
              $(`#cajas${id_multi}`).val("");
              $(`#mov_inventario${id_multi}`).val("");
            }
          }
        );
      }
    )
    .set("labels", {
      ok: "Si, Parcial",
      cancel: "No, Total",
    });
}
