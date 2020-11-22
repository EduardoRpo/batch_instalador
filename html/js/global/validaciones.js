
var controlProducto = [];

/* Valida que todos los datos del formulario de control sean cargados */

function validardatosresultadosPreparacion() {

    /* Almacenar los datos del formulario en un array */

    $("#tblControlProcesoPreparacion tr").each(function () {
        let control = ($(this).find("td:eq(2) select option:selected").val());

        if (control != undefined && control != "" && control != '0') {
            controlProducto.push(control);
        } else {
            let valor = $(this).find("td:eq(2) input").val();
            if (valor != undefined && valor != "")
                controlProducto.push(valor);
            else
                controlProducto = [];
        }
    })

    //console.log(controlProducto);

    /* Validar que toda la informacion esta completa */

    if (controlProducto.length < 9) {
        alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los campos para el control del proceso");
        return 0;
    } else
        return 1;
}


/* Limpiar campos en el modulo de preparacion y aprobacion*/

$(document).on('click', '.chkcontrol', function () {

    if ($(this).is(':checked')) {
        pasoEjecutado = 0;
        reiniciarInstructivo();
        $(`.especificacion`).val('0')
        $(`.especificacionInput`).val('');
    }
});

