/* validar y Cargar informacion almacenada en el batch */

function cargarBatch() {
  cargarDesinfectante();
  $(".aprobacion_verificado").prop("disabled", true);
}

/* Carga desinfectante y observaciones almacenadas en el batch */

function cargarDesinfectante() {
  $.ajax({
    type: "POST",
    url: "../../html/php/despeje.php",
    data: { operacion: 2, modulo, idBatch },

    success: function (r) {
      if (r == "") return false;

      /* Carga observaciones, desinfectante y firma */

      let info = JSON.parse(r);
      desinfectante = info.desinfectante;
      observacion = info.observaciones;
      firma = info.urlfirma;

      $("#sel_producto_desinfeccion").val(desinfectante);
      $("#in_observaciones").val(observacion);
      cargarfirma2daSeccion();
    },
  });
}

/* Cargar Tanques */

function cargarfirma2daSeccion() {
  /* obtener los tanques chequeados */

  $.ajax({
    type: "POST",
    url: "../../html/php/batch_tanques.php",
    data: { modulo, idBatch, operacion: 2 },

    success: function (response) {
      var data = JSON.parse(response);
      T_tanques = data[0].tanques;
      T_tanquesOk = data[0].tanquesOk;

      if (data == "") return false;

      /* Chequea todos los tanques de acuerdo con la BD */

      for (i = 1; i <= data[0].tanquesOk; i++) {
        $(`#chkcontrolTanques${i}`).prop("checked", true);
        $(`#chkcontrolTanques${i}`).prop("disabled", true);
      }
      /* carga formulario */

      cargarControlProceso();

      /* Valida que todos los tanques esten chequeados para proceder a firmar */

      if (T_tanquesOk == T_tanques) {
        firmado(firma, 3);
        $.ajax({
          type: "POST",
          url: "../../html/php/despeje.php",
          data: { operacion: 3, modulo, idBatch },

          success: function (response) {
            if (response == "") return false;
            let data = JSON.parse(response);
            firmado(data.urlfirma, 4);
          },
        });
      }
    },
  });
}

/* Registro de Firma */

function firmado(datos, posicion) {
  let template =
    '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
  let parent;

  btn_id = $("#idbtn").val();

  if (posicion == 3) {
    if (modulo == 4) {
      parent = $("#aprobacion_realizado").parent();
      $("#aprobacion_realizado").remove();
      $("#aprobacion_realizado")
        .css({ background: "lightgray", border: "gray" })
        .prop("disabled", true);
      $(".aprobacion_verificado").prop("disabled", false);
    }
  }

  if (posicion == 4)
    if (modulo == 2) {
      parent = $("#pesaje_verificado").parent();
      $("#pesaje_verificado").remove();
      $(".pesaje_verificado")
        .css({ background: "lightgray", border: "gray" })
        .prop("disabled", true);
    }

  if (posicion == 4) {
    if (modulo == 4) {
      parent = $("#aprobacion_verificado").parent();
      $("#aprobacion_verificado").remove();
      $("#aprobacion_verificado")
        .css({ background: "lightgray", border: "gray" })
        .prop("disabled", true);
      $(".aprobacion_verificado").prop("disabled", true);
    }
  }

  let firma = template.replace(":firma:", datos);
  parent.append(firma).html;
}
