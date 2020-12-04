
/* Activar el boton de carga hasta que solo se haya seleccionado un archivo */

$("#datosExcel").change(function () {
    $("#btnCargarExcel").prop("disabled", false);
});

function comprobarExtension(formulario, archivo, id) {

    let confirm = alertify.confirm('Samara Cosmetics', 'Todos los datos serán eliminados y reemplazados por el nuevo archivo ¿Esta seguro de ejecutar la operación?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function (r) {
        if (r) {

            let extension_permitida = ".csv";
            let extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();

            if (extension_permitida === extension) {
                cargarDataExcel(id);
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Valide la extensión del archivo, debe ser '.csv'");
            }
        }
    });
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
            alertify.set("notifier", "position", "top-right"); alertify.success("Operación exitosa");
            if (data !== 'multi')
                refreshTable();
            $('#datosExcel').val('');
            $("#btnCargarExcel").prop("disabled", true);
        }
    });
}