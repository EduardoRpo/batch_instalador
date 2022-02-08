modulo = 4;
batch_record();

//valida que todos los campos esten diligenciados para el proceso y la firma

function cargar(btn, idbtn) {
    let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function(r) {
        sessionStorage.setItem("idbtn", idbtn);
        id = btn.id;

        /* Valida que se ha seleccionado el producto de desinfeccion para el proceso*/

        let seleccion = $("#sel_producto_desinfeccion").val();
        if (modulo == 3 && seleccion != "Seleccione")
            seleccion = $("#select-Linea").val();

        if (seleccion == "Seleccione") {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione el producto para desinfección.");
            return false;
        }

        //Validacion de control de tanques
        if (id == "aprobacion_realizado") {
            validar = controlTanques();
            if (validar == 0) {
                return false;
            }
        }

        /* Almacenar la data en un array */

        if (id == "aprobacion_realizado") {
            validar = cargarResultadosEspecificaciones();
            if (validar == 0) return false;
        }

        //validar que todos los campso se encuentres completos en el formularios

        validarParametrosControl();

        /* Carga el modal para la autenticacion */

        $("#usuario").val("");
        $("#clave").val("");
        $("#m_firmar").modal("show");
    });
}

/* Cargue control de Tanques */

function cargaTanquesControl(cantidad) {
    if (cantidad > 10) {
        cantidad = 10;
    }

    for (var i = 1; i <= cantidad; i++) {
        $(".checkbox-aprobacion").append(
            `<input type="checkbox" id="chkcontrolTanques${i}" onclick="validar_condicionesMedio();" class="chkcontrol" style="height: 30px; width:30px;">`
        );
    }
    tanques = i - 1;
}

function deshabilitarbtn() {
    $(".aprobacion_realizado")
        .css({ background: "lightgray", border: "gray" })
        .prop("disabled", true);
    $(".aprobacion_verificado").prop("disabled", false);
}

promedioDensidad = () => {
    $.ajax({
        type: "POST",
        url: "../../html/php/promedioDensidad.php",
        data: { batch: idBatch },
        success: function(response) {
            data = JSON.parse(response);
            $("#in_densidad").val(data[0].densidad.toFixed(2));
        },
    });
};
//promedioDensidad();