
/* firmar pesaje  */

function firmar2daSeccion() {

    let tanquesOk = 0;

    /* validar tanque seleccionados */
    for (let i = 1; i <= tanques; i++) {
        if ($(`#chkcontrolTanques${i}`).is(":checked"))
            tanquesOk++;
    }

    /* carga data de acuerdo con el modulo */

    if (modulo == 2)
        data = { operacion: 1, tanques, tanquesOk, modulo, idBatch };
    if (modulo == 3)
        data = { operacion: 1, tanques, tanquesOk, modulo, idBatch, controlProducto };

    $.ajax({
        type: "POST",
        url: "../../html/php/batch_tanques.php",
        data: data,

        success: function (response) {

            if (response > 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Proceso ejecutado con éxito");
                $(`#chkcontrolTanques${tanquesOk}`).prop('disabled', true);

                if (modulo == 3) {
                    $(`.especificacion`).val('0')
                    $(`.especificacionInput`).empty();
                }





                if (tanques == tanquesOk)
                    firmarSeccionCierreProceso();
            } else {

                alertify.set("notifier", "position", "top-right"); alertify.error("Error");
            }
        }
    });
}

function firmarSeccionCierreProceso() {

    //confirmación de incidencias 

    var confirm = alertify.confirm('Incidencias y Observaciones', 'Durante la fabricación de la orden ' + idBatch + ' XXX cantidad total XXX durante alguno de los tanques hubo incidencias', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    /* confirm.set({ transition: 'slide' }); */

    confirm.set('onok', function () { //callbak al pulsar botón positivo
        cargarObsIncidencias(data[0].id);
        deshabilitarbtn();
    });

    confirm.set('oncancel', function () { //callbak al pulsar botón negativo
        alertify.error('No reporto Incidencias');

        $.ajax({
            method: 'POST',
            url: '../../html/php/incidencias.php',
            data: {
                operacion: 3,
                firma: data[0].id,
                modulo: modulo,
                batch: idBatch,

            },

            success: function (response) {
                $('#modalObservaciones').modal('hide');
                firmar();
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
            $('.despeje_verificado').prop('disabled', true);
        }
    });
}


function deshabilitarbtn() {
    $('.pesaje_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    $('.pesaje_verificado').prop('disabled', false);

    $('.preparacion_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    $('.preparacion_verificado').prop('disabled', false);
}