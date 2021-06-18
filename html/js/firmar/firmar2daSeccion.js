/* firmar 2da sección  */

function firmar2daSeccion(firma) {
  let tanquesOk = 0;

  /* validar tanque seleccionados */
  for (let i = 1; i <= tanques; i++)
    if ($(`#chkcontrolTanques${i}`).is(":checked")) tanquesOk++;

  /* carga data de acuerdo con el modulo */

  if (modulo == 2) data = { operacion: 1, tanques, tanquesOk, modulo, idBatch };

  if (modulo == 3) {
    equipos = [];
    equipos.push($("#sel_agitador").val());
    equipos.push($("#sel_marmita").val());
    data = {
      operacion: 1,
      equipos,
      tanques,
      tanquesOk,
      modulo,
      idBatch,
      controlProducto,
    };
  }

  if (modulo == 4) {
    let desinfectante = $("#sel_producto_desinfeccion").val();
    const obs_desinfectante = $("#in_observaciones").val();
    desinfectante === undefined ? (desinfectante = "") : desinfectante;
    const obs_batch = $("#observacionesAprobacion").val();
    data = {
      operacion: 1,
      tanques,
      tanquesOk,
      modulo,
      idBatch,
      desinfectante,
      obs_desinfectante,
      obs_batch,
      realizo: firma[0].id,
      controlProducto,
    };
  }

  if (modulo == 9) {
    const desinfectante = $("#sel_producto_desinfeccion").val();
    const obs_desinfectante = $("#in_observaciones").val();
    const obs_batch = $("#observacionesLoteRechazado").val();
    data = {
      operacion: 1,
      desinfectante,
      obs_desinfectante,
      obs_batch,
      modulo,
      idBatch,
      realizo: firma[0].id,
      controlProducto,
    };
  }

  $.ajax({
    type: "POST",
    url: "../../html/php/batch_tanques.php",
    data: data,

    success: function (response) {
      let info = JSON.parse(response);

      if (info >= 1) {
        if (modulo != 9) {
          alertify.set("notifier", "position", "top-right");
          alertify.success(`Tanque No. ${tanquesOk} ejecutado con éxito`);
          $(`#chkcontrolTanques${tanquesOk}`).prop("disabled", true);
        }

        if (modulo == 3 || modulo == 4) {
          $(`.especificacion`).val("0");
          $(`.especificacionInput`).val("");
        }

        if (modulo == 3) reiniciarInstructivo();
        if (tanques == tanquesOk) firmarSeccionCierreProceso(firma);
      } else {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Error");
      }
    },
  });
}

function firmarSeccionCierreProceso(firma) {
  let orden = localStorage.getItem("orden");
  let tamano_lote = localStorage.getItem("tamano_lote");
  modulo === 10
    ? (obs_batch = $("#observacionesLoteRechazado").val())
    : (obs_batch = "");

  //confirmación de incidencias

  var confirm = alertify
    .confirm(
      "Incidencias y Observaciones",
      `¿Durante la fabricación de la orden de producción ${orden} con cantidad total de
       ${tamano_lote} kg, se presentó alguna incidencia u observación al desarrollar el proceso?`,
      null,
      null
    )
    .set("labels", { ok: "Si", cancel: "No" });

  confirm.set("onok", function () {
    cargarObsIncidencias(firma);
  });

  confirm.set("oncancel", function () {
    alertify.success("No reportó Incidencias");

    $.ajax({
      method: "POST",
      url: "../../html/php/incidencias.php",
      data: { operacion: 3, realizo: firma[0].id, modulo, idBatch },

      success: function (response) {
        $("#modalObservaciones").modal("hide");
        firmar(firma);
      },
    });
  });
  deshabilitarbtn();
}

/* almacenar firma calidad 2da seccion */

function almacenarfirma(id) {
  $.ajax({
    type: "POST",
    url: "../../html/php/incidencias.php",
    data: { operacion: 4, modulo: modulo, idBatch, verifico: id },

    success: function (response) {
      alertify.set("notifier", "position", "top-right");
      alertify.success("Firmado satisfactoriamente");
      if (modulo == 2)
        $(".pesaje_verificado")
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);

      if (modulo == 3)
        $(".preparacion_verificado")
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);

      if (modulo == 4)
        $(".aprobacion_verificado")
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);
      if (modulo == 8)
        $(".aprobacion_verificado")
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);
      if (modulo == 9)
        $(".fisicoquimica_verificado")
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);
    },
  });
}
