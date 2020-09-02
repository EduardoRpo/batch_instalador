
/* Activar el boton de carga hasta que solo se haya seleccionado un archivo */

$("#datosExcel").change(function () {
    $("#btnCargarExcel").prop("disabled", this.files.length == 0);
});

function comprobarExtension(formulario, archivo, id) {

    let extensiones_permitidas = ".csv";
    let extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();

    if (extensiones_permitidas === extension) {
        cargarDataExcel(id);
    } else {
        alertify.set("notifier", "position", "top-right"); alertify.error("Valide La extensión del archivo, debe ser '.csv'");
    }
}


/* enviar datos para cargar a la BD */

function cargarDataExcel(id) {

    const formulario = new FormData($('#formDataExcel')[0]);
    formulario.set('operacion', id);

    $.ajax({

        url: "php/importar.php",
        type: "POST",
        data: formulario,
        processData: false,
        contentType: false,

        success: function (data) {

            /* if (!data) {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error");
            } else { */
                alertify.set("notifier", "position", "top-right"); alertify.success("Operación exitosa");
                refreshTable();
            /* } */

        }
    });
}