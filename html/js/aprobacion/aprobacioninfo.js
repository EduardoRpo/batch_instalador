modulo = 4;

loadBatch = async() => {
    await cargarBatch();
    cargarTanques()
}

loadBatch()

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