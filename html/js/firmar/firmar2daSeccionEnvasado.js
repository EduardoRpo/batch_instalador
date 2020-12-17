

/* firmar 2da sección  */

function firmar2daSeccion(firma) {
    debugger;
    if (presentacion == undefined) {
        alertify.set("notifier", "position", "top-right"); alertify.error("Valide que todas las muestras se encuentran completas");
        return false;
    }

    let muestras = JSON.parse(localStorage.getItem(presentacion))

    if (i == cantidad_muestras) {
        $.ajax({
            method: 'POST',
            url: '../../html/php/muestras.php',
            data: { id: idBatch, muestras, referencia },

            success: function (response) {
                
                if (response == 0) {
                    alertify.set("notifier", "position", "top-right"); alertify.error("Error al almacenar las muestras, valide nuevamente");
                    return false;
                }

                let linea = $('#select-Linea1').val();
                let id_firma = firma[0].id

                $.ajax({
                    type: "POST",
                    url: '../../html/php/envasado.php',
                    data: { operacion: 1, linea, id_firma, modulo, idBatch },

                    success: function (response) {
                        alertify.set("notifier", "position", "top-right"); alertify.success("Firmado satisfactoriamente");
                        firmar(firma);
                        $('#controlpeso_realizado1').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
                    }
                });
            },
            error: function (response) {
                console.log(response);
            }
        })
    }
}

/* almacenar firma calidad 2da seccion */

function almacenarfirma(id_firma) {

    $.ajax({
        type: "POST",
        url: '../../html/php/envasado.php',
        data: { operacion: 2, id_firma, modulo, idBatch },

        success: function (response) {
            alertify.set("notifier", "position", "top-right"); alertify.success("Firmado satisfactoriamente");
            $('#controlpeso_verificado1').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
        }
    });
}

function firmarSeccionCierreProceso(firma) {

    let orden = localStorage.getItem("orden");
    let tamano_lote = localStorage.getItem("tamano_lote");

    //confirmación de incidencias 

    var confirm = alertify.confirm('Incidencias y Observaciones', `¿Durante la fabricación de la orden de producción ` + orden + ` con cantidad total de ` + tamano_lote + ` kg, se presentó alguna incidencia u observación al desarrollar el proceso?`,
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



function deshabilitarbtn() {
    $('.pesaje_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    $('.pesaje_verificado').prop('disabled', false);

    $('.preparacion_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    $('.preparacion_verificado').prop('disabled', false);
}