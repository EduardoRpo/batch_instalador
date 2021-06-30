/* Activar el boton de carga hasta que solo se haya seleccionado un archivo */

$(".datosExcel").change(function (e) {
  e.preventDefault();
  $(`.btnCargarExcel`).prop("disabled", false);
});

/* Comprobar extension del archivo para cargar */

function comprobarExtension(formulario, archivo, tabla, id) {
  let extensiones_permitidas = ".csv";
  let extension = archivo.substring(archivo.lastIndexOf(".")).toLowerCase();

  if (extensiones_permitidas === extension) {
    $("#btnCargarExcel").prop("disabled", false);

    let confirm = alertify
      .confirm(
        "Samara Cosmetics",
        "¿Esta seguro de ejecutar la operación?",
        null,
        null
      )
      .set("labels", { ok: "Si", cancel: "No" });
    confirm.set("onok", function (r) {
      if (r) {
        cargarDataExcel(tabla, id);
      }
    });
  } else {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Valide La extensión del archivo, debe ser '.csv'");
  }
}

/* enviar datos para cargar a la BD */

function cargarDataExcel(tabla, id) {
  const formulario = new FormData($(`#formDataExcel${id}`)[0]);
  formulario.set("tabla", tabla);

  $.ajax({
    url: "php/importarProductos.php",
    type: "POST",
    data: formulario,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $("#spinner").css("display", "block");
    },

    success: function (data) {
      if (data != "") {
        let info = JSON.parse(data);
        const finalArray = Object.values(info);
        $("#validacionProductos").modal("show");

        finalArray.forEach((element, index) => {
          let data = element.split(" ");
          $("#prodnoencontrados").append(
            `<tr><td style="text-align:center;">${index + 1}. El id <b>${
              data[1]
            }</b> no existe en la tabla <b>${data[0]}</b></td></tr>`
          );
        });
        $("#spinner").css("display", "none");

        $(`#datosExcel${id}`).val("");
        //refreshTable(id);
        $(`.btnCargarExcel`).prop("disabled", false);
      } else {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Productos importados exitosamente");
        $("#spinner").css("display", "none");
        $(`#datosExcel${id}`).val("");
        refreshTable(id);
        $(`.btnCargarExcel`).prop("disabled", false);
      }
    },
  });
}
