function cargarBatch() {
  operacion = 4;
  $.post(
    "../../html/php/conciliacion_rendimiento.php",
    (data = { operacion, idBatch, ref_multi, modulo }),
    function (data, textStatus, jqXHR) {
      info = JSON.parse(data);
      if (info == 0) return false;
      $(`#unidades_recibidas${id_multi}`)
        .val(info.unidades_producidas)
        .prop("readonly", true);
      $(`#cajas${id_multi}`).val(info.cajas).prop("readonly", true);
      $(`#mov_inventario${id_multi}`)
        .val(info.mov_inventario)
        .prop("readonly", true);
      $(`#obs${id_multi}`).val(info.observaciones).prop("readonly", true);
      //firmado(info.urlfirma);
    }
  );
}

/* Registro de Firma */

function firmado(datos) {
  let template =
    '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
  let parent;

  //btn_id = $("#idbtn").val();
  btn_id = `firma${id_multi}`;
  parent = $(`#despacho${id_multi}`).parent();
  $(`#despacho${id_multi}`).remove();
  $(`#despacho${id_multi}`)
    .css({ background: "lightgray", border: "gray" })
    .prop("disabled", true);

  let firma = template.replace(":firma:", datos[0].urlfirma);
  parent.append(firma).html;
}
