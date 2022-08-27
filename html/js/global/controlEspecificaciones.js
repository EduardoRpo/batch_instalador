let controlProducto = [];

$(document).ready(function() {

    /* Valida que todos los datos del formulario de control sean cargados */

    cargarResultadosEspecificaciones = () => {
        /* Almacenar los datos del formulario en un array */

        $("#tblControlEspecificaciones tr").each(function() {
            let control = $(this).find("td:eq(2) select option:selected").val();

            if (control != undefined && control != "" && control != "0") {
                controlProducto.push(control);
            } else {
                let valor = $(this).find("td:eq(2) input").val();
                if (valor != undefined && valor != "") controlProducto.push(valor);
                else controlProducto = [];
            }
        });

        /* Validar que toda la informacion esta completa */

        modulo == 3 ? indice = 9 : modulo == 4 ? indice = 11 : indice = 9

        if (controlProducto.length < indice) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Ingrese todos los campos para el control del proceso");
            return 0;
        } else
            return 1;
    }

    /* Limpiar campos en el modulo de preparacion y aprobacion*/

    $(document).on("click", ".chkcontrol", function() {
        if ($(this).is(":checked")) {
            pasoEjecutado = 0;
            if (modulo == 3) reiniciarInstructivo();
            $(`.especificacion`).val("0");
            $(`.especificacionInput`).val("");
        }
    });

    /* Cargar tabla especificaciones */

    cargarControlProceso = () => {
        $.ajax({
            type: "POST",
            url: "../../html/php/controlProceso.php",
            data: { modulo, idBatch },

            success: function(response) {
                if (response == "" || response == 0) return false;

                let info = JSON.parse(response);
                let index = info.length;

                $(".color").val(info[index - 1].color);
                $(".olor").val(info[index - 1].olor);
                $(".apariencia").val(info[index - 1].apariencia);
                $(".ph").val(info[index - 1].ph);
                $("#in_viscocidad").val(info[index - 1].viscosidad);
                $("#in_densidad").val(info[index - 1].densidad);
                $(".untuosidad").val(info[index - 1].untuosidad);
                $(".espumoso").val(info[index - 1].espumoso);
                $("#in_grado_alcohol").val(info[index - 1].alcohol);
            },
        });
    }
});