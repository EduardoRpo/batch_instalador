

/* firmar 2da sección  */

function almacenar_muestras(firma) {

    modulo == 6 ? operacion = 3 : operacion = 1;
    let muestras = JSON.parse(localStorage.getItem(presentacion + ref_multi + modulo))

    //Almacena las muestras
    $.ajax({
        method: 'POST',
        url: '../../html/php/muestras.php',
        data: { operacion, idBatch, muestras, modulo, ref_multi },

        success: function (response) {

            if (response == 0) {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error al almacenar las muestras, valide nuevamente");
                return false;
            }

            let linea = $(`#select-Linea${id_multi}`).val();
            let id_firma = firma[0].id
            //Almacena la firma 
            $.ajax({
                type: "POST",
                url: '../../html/php/envasado.php',
                data: { operacion: 1, linea, id_firma, modulo, idBatch, ref_multi },

                success: function (response) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Firmado satisfactoriamente");
                    deshabilitarbtn();
                }
            });
        },
        error: function (response) {
            console.log(response);
        }
    })
}

/* almacenar firma calidad 2da seccion */

function almacenarfirma(id_firma) {

    $.ajax({
        type: "POST",
        url: '../../html/php/envasado.php',
        data: { operacion: 2, id_firma, modulo, idBatch, ref_multi },

        success: function (response) {
            alertify.set("notifier", "position", "top-right"); alertify.success("Firmado satisfactoriamente");
            $(`.controlpeso_verificado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
        }
    });
}

function firmaCalidad(id_firma) {
    $.ajax({
        type: "POST",
        url: '../../html/php/envasado.php',
        data: { operacion: 5, id_firma, modulo, idBatch, ref_multi },

        success: function (response) {
            if (response == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Firmado satisfactoriamente");
                $(`.controlpeso_verificado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
            }
        }
    });
}

function observaciones_incidencias() {

    let orden = localStorage.getItem("orden");
    let tamano_lote = localStorage.getItem("tamano_lote");

    //confirmación de incidencias 

    var confirm = alertify.confirm('Incidencias y Observaciones', `¿Durante la fabricación de la orden de producción ` + orden + ` con cantidad total de ` + tamano_lote + ` kg, se presentó alguna incidencia u observación al desarrollar el proceso?`,
        null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set({ transition: 'slide' });

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
                $(`.devolucion_realizado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
                $(`.devolucion_verificado${id_multi}`).prop('disabled', false);
            }
        });
    });
}