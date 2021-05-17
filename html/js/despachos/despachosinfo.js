
/* let presentacion;
let a = 0, b = 0, c = 0; */
let id;
modulo = 7;
/* Carga el modal para la autenticacion */

function autenticacion(obj) {
  id = obj.id;
  unidades = $(`#unidades_recibidas${id_multi}`).val();
  cajas = $(`#cajas${id_multi}`).val();
  mov_acond = $(`#mov_inventario_acond${id_multi}`).val();
  movimiento = $(`#mov_inventario${id_multi}`).val();
  total = unidades * cajas * movimiento;

  if (total == 0) {
    alertify.set("notifier", "position", "top-right"); alertify.error("Complete todos los campos");
    return false
  }

  if (mov_acond != movimiento) {
    alertify.set("notifier", "position", "top-right"); alertify.error("Números de movimiento no son iguales, revise nuevamente");
    return false;
  }

  $('#usuario').val('');
  $('#clave').val('');
  $('#m_firmar').modal('show');

}

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
          $(`#unidad_empaque${j}`).val(batchMulti[i].unidad_empaque);

          $(`#tanque${j}`).html(formatoCO(presentacion));
          $(`#cantidad${j}`).html(formatoCO(cantidad));
          $(`#total${j}`).html(formatoCO(total));

          $(`#fila${j}`).attr("hidden", false);
          $(`#despachos${j}`).attr("hidden", false);
          $(`#despachosMulti${j}`).html(`DESPACHOS PRESENTACIÓN: ${presentacion} REFERENCIA ${referencia}`);

          j++;
        }
      } else {
        batch == undefined ? location.reload() : batch;
        $(`#tanque${j}`).html(formatoCO(batch.presentacion));
        $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
        $(`#total${j}`).html(formatoCO(batch.tamano_lote));
        $(`#despachosMulti${j}`).html(`DESPACHOS PRESENTACIÓN: ${batch.presentacion} REFERENCIA: ${batch.referencia}`);
        $(`#ref${j}`).val(referencia);
        $(`#unidad_empaque${j}`).val(batch.unidad_empaque);

      }
      multi = j + 1;
    },
    error: function (r) {
      alertify.set("notifier", "position", "top-right"); alertify.error("Error al Cargar la multipresentacion.");
    }

  });
};

/* Ocultar presentacion despachos */

function ocultar_presentacion_despachos() {
  for (let i = 2; i < 6; i++) {
    $(`#despachos${i}`).attr("hidden", true);
  }
}

function cargar_despacho() {
  let op = 1;
  $.post("../../html/php/despachos.php", data = { op, idBatch, ref_multi },
    function (data, textStatus, jqXHR) {
      let info = JSON.parse(data);

      if (info == 0)
        return false;
      unidades = $(`#unidad_empaque${id_multi}`).val();
      $(`#unidades_recibidas_acond${id_multi}`).val(info.unidades_producidas);
      $(`#cajas_acond${id_multi}`).val((info.unidades_producidas - info.muestras_retencion) / unidades);
      $(`#mov_inventario_acond${id_multi}`).val(info.mov_inventario);
      $(`#mestras_retencion_acond${id_multi}`).val(info.muestras_retencion);
    },
  );
}

/* Valida el usuario si existe en la base de datos */

function enviar() {

  $('#m_firmar').modal('hide');
  datos = {
    user: $('#usuario').val(),
    password: $('#clave').val(),
  },

    $.ajax({
      type: 'POST',
      url: '../../html/php/firmar.php',
      data: datos,

      success: function (datos) {

        if (datos.length < 1) {
          alertify.set("notifier", "position", "top-right"); alertify.error("usuario y/o contraseña no coinciden.");
          return false;
        } else {
          preparacion(datos);
        }
      }
    });
  return false;
}

function preparacion(data) {
  infof = JSON.parse(data);
  idfirma = infof[0].id;
  let unidades = $(`#unidades_recibidas${id_multi}`).val();
  let cajas = $(`#cajas${id_multi}`).val();
  let retencion = $(`#mestras_retencion_acond${id_multi}`).val();
  let mov = $(`#mov_inventario${id_multi}`).val();
  let operacion = 3;

  $.post("../../html/php/conciliacion_rendimiento.php", data = { operacion, unidades, cajas, mov, modulo, idBatch, ref_multi, idfirma },
    function (info, textStatus, jqXHR) {
      if (textStatus == 'success') {
        alertify.set("notifier", "position", "top-right"); alertify.success("Registro de despacho exitoso");
        $(`.despacho${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
        firmar(infof);
      }
    },
  );
}

function firmar(info) {

  let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
  let parent = $('#' + id).parent();

  $('#' + id).remove();
  id = '';

  let firma = template.replace(':firma:', info[0].urlfirma);
  firma = firma.replace(':id:', 'btn_id');
  parent.append(firma).html
}
