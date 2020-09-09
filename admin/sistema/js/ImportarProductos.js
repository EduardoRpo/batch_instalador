
/* Activar el boton de carga hasta que solo se haya seleccionado un archivo */

$("#datosExcel1").change(function (e) {
    e.preventDefault();
    debugger;
    activarBoton(1);
});

$("#datosExcel2").change(function (e) {
    e.preventDefault();
    activarBoton(2);
});
$("#datosExcel3").change(function (e) {
    e.preventDefault();
    activarBoton(3);
});
$("#datosExcel4").change(function (e) {
    e.preventDefault();
    activarBoton(4);
});
$("#datosExcel5").change(function (e) {
    e.preventDefault();
    activarBoton(5);
});
$("#datosExcel6").change(function (e) {
    e.preventDefault();
    activarBoton(6);
});

function activarBoton(id) {
    $(`#btnCargarExcel${id}`).prop("disabled", false);
}


function comprobarExtension(formulario, archivo, tabla, id) {

    let extensiones_permitidas = ".csv";
    let extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();

    if (extensiones_permitidas === extension) {
        
        $("#btnCargarExcel").prop("disabled", false);
        
        let confirm = alertify.confirm('Samara Cosmetics', 'Todos los datos serán eliminados y reemplazados por el nuevo archivo ¿Esta seguro de ejecutar la operación?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
        confirm.set('onok', function (r) {
            if (r) {
                cargarDataExcel(tabla, id);
            }
        });

    } else {
        alertify.set("notifier", "position", "top-right"); alertify.error("Valide La extensión del archivo, debe ser '.csv'");
    }
}


/* enviar datos para cargar a la BD */

function cargarDataExcel(tabla, id) {

    const formulario = new FormData($(`#formDataExcel${id}`)[0]);
    formulario.set('tabla', tabla);

    $.ajax({

        url: "php/importarProductos.php",
        type: "POST",
        data: formulario,
        processData: false,
        contentType: false,

        success: function (data) {

            /* if (!data) {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error");
            } else { */
            alertify.set("notifier", "position", "top-right"); alertify.success("Operación exitosa");
            refreshTable(id);
            /* } */

        }
    });
}