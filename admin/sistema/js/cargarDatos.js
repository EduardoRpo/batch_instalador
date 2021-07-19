let tbl;

/* Activar el boton de carga hasta que solo se haya seleccionado un archivo */

$("#datosExcel").change(function () {
  $("#btnCargarExcel").prop("disabled", false);
});

function comprobarExtension(formulario, archivo, id) {
  let confirm = alertify
    .confirm(
      "Samara Cosmetics",
      "¿Está seguro de ejecutar la operación?",
      null,
      null
    )
    .set("labels", { ok: "Si", cancel: "No" });
  confirm.set("onok", function (r) {
    if (r) {
      let extension_permitida = ".csv";
      let extension = archivo.substring(archivo.lastIndexOf(".")).toLowerCase();

      if (extension_permitida === extension) {
        cargarDataExcel(id);
      } else {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Tipo de archivo no permitido, debe ser '.csv'");
      }
    }
  });
}

/* enviar datos para cargar a la BD */

function cargarDataExcel(id) {
  const formulario = new FormData($("#formDataExcel")[0]);
  formulario.set("operacion", id);

  if (id == 8) {
    if ($("input[name='mp']").is(":checked")) {
      tbl = $("input:radio[name=mp]:checked").val();
      formulario.set("tbl", tbl);
    } else {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Seleccione donde desea que se importe la materia prima");
      return false;
    }
  }

  $.ajax({
    url: "php/importar.php",
    type: "POST",
    data: formulario,
    processData: false,
    contentType: false,

    success: function (data) {
      alertify.set("notifier", "position", "top-right");
      alertify.success("Operación exitosa");
      if (data !== "multi") refreshTable();

      $("#datosExcel").val("");
      $(`.btnCargarExcel`).prop("disabled", true);
    },
  });
}
