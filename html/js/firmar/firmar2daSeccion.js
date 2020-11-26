
/* firmar 2da sección  */

function firmar2daSeccion(firma) {
    let tanquesOk = 0;

    /* validar tanque seleccionados */
    for (let i = 1; i <= tanques; i++) {
        if ($(`#chkcontrolTanques${i}`).is(":checked"))
            tanquesOk++;
    }

    /* carga data de acuerdo con el modulo */

    if (modulo == 2) {
        linea = '0';
        data = { operacion: 1, linea, tanques, tanquesOk, modulo, idBatch };
    }

    if (modulo == 3) {
 
        let linea = $('#select-Linea').val();
        data = { operacion: 1, linea, tanques, tanquesOk, modulo, idBatch, controlProducto };
    }

    if (modulo == 4) {
        linea = '0';
        let desinfectante = $('#sel_producto_desinfeccion').val();
        data = { operacion: 1, linea, tanques, tanquesOk, modulo, idBatch, desinfectante, firma: firma[0].id, controlProducto };
    }


    $.ajax({
        type: "POST",
        url: "../../html/php/batch_tanques.php",
        data: data,

        success: function (response) {
            let info = JSON.parse(response)

            if (info >= 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success(`Tanque No. ${tanquesOk} ejecutado con éxito`);
                $(`#chkcontrolTanques${tanquesOk}`).prop('disabled', true);

                if (modulo == 3 || modulo == 4) {
                    //para el modulo de preparacion imprimir la etiqueta tanque, lote, orden de produccion, fecha. tamaño lote.
                    $(`.especificacion`).val('0')
                    $(`.especificacionInput`).val('');
                }

                if (tanques == tanquesOk)
                    firmarSeccionCierreProceso(firma);
            } else {

                alertify.set("notifier", "position", "top-right"); alertify.error("Error");
            }
        }
    });
}

function firmarSeccionCierreProceso(firma) {

    let orden = localStorage.getItem("orden");
    let tamano_lote = localStorage.getItem("tamano_lote");

    //confirmación de incidencias 

    var confirm = alertify.confirm('Incidencias y Observaciones', `¿Durante la fabricación de la orden de producción `+ orden +` con cantidad total de `+tamano_lote+` kg, se presentó alguna incidencia u observación al desarrollar el proceso?`,
        null, null).set('labels', { ok: 'Si', cancel: 'No' });

    /* confirm.set({ transition: 'slide' }); */

    confirm.set('onok', function () { //callbak al pulsar Si
        cargarObsIncidencias(firma);
        deshabilitarbtn();
    });

    confirm.set('oncancel', function () { //callbak al pulsar No
        alertify.error('No reporto Incidencias');
        /* Almacenar firma 2da seccion */
        $.ajax({
            method: 'POST',
            url: '../../html/php/incidencias.php',
            data: {
                operacion: 3,
                firma: firma[0].id,
                modulo: modulo,
                batch: idBatch,

            },

            success: function (response) {
                $('#modalObservaciones').modal('hide');
                firmar(firma);
                deshabilitarbtn();
            }
        });
    });
}

/* almacenar firma calidad 2da seccion */

function almacenarfirma(id) {

    $.ajax({
        type: "POST",
        url: "../../html/php/incidencias.php",
        data: {
            operacion: 4,
            modulo: modulo,
            batch: idBatch,
            firma: id,
        },

        success: function (response) {
            alertify.set("notifier", "position", "top-right"); alertify.success("Firmado satisfactoriamente");
            $('.pesaje_verificado').prop('disabled', true);
            /* $('.aprobacion_realizado').prop('disabled', true); */
        }
    });
}


function deshabilitarbtn() {
    $('.pesaje_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    $('.pesaje_verificado').prop('disabled', false);

    $('.preparacion_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    $('.preparacion_verificado').prop('disabled', false);
}