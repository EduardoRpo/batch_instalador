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
        $.ajax({
          type: "POST",
          url: "../../html/php/batch_tanques.php",
          data: { operacion: 4, modulo, idBatch },

          success: function (response) {
            let data = JSON.parse(response);

            if (data == 0) return false;

            let firma = data.realizo;
            let verifico = data.verifico;

            firmado(firma, 3);

            if (verifico !== undefined) firmado(verifico, 4);
          },
        });
      }
    },
  });
}

/* Carga formulario */

function cargarControlProceso() {
  $.ajax({
    type: "POST",
    url: "../../html/php/controlProceso.php",
    data: { modulo, idBatch },

    success: function (response) {
      let info = JSON.parse(response);
      let index = info.data.length;

      $(".color").val(info.data[index - 1].color);
      $(".olor").val(info.data[index - 1].olor);
      $(".apariencia").val(info.data[index - 1].apariencia);
      $(".ph").val(info.data[index - 1].ph);
      $("#in_viscocidad").val(info.data[index - 1].viscosidad);
      $("#in_densidad").val(info.data[index - 1].densidad);
      $(".untuosidad").val(info.data[index - 1].untuosidad);
      $(".espumoso").val(info.data[index - 1].espumoso);
      $("#in_grado_alcohol").val(info.data[index - 1].alcohol);
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
    } /* else if (modulo == 3) {
            parent = $('#preparacion_realizado').parent();
            $('#preparacion_realizado').remove();
            $('.preparacion_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
            $('.preparacion_verificado').prop('disabled', false);

        } */

  let firma = template.replace(":firma:", datos);
  parent.append(firma).html;
}
