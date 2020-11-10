
/* firmar pesaje  */

function firmarSeccionPesaje() {

    let tanquesOk = 0;
    debugger;
    /* validar tanque seleccionados */
    for (let i = 1; i <= tanques; i++) {
        if ($(`#chkcontrolTanques${i}`).is(":checked"))
            tanquesOk++;
    }

    /* Validar si todos los tanques estan chequeados */

    $.ajax({
        type: "POST",
        url: "../../html/php/batch_tanques.php",
        data: { operacion: 1, tanques, tanquesOk, modulo, idBatch },

        success: function (response) {
            debugger;
            if (response == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Proceso ejecutado con éxito");
                $(`#chkcontrolTanques${tanquesOk}`).prop('disabled', true);

                if (tanques == tanquesOk)
                    firmarSeccionCierreProceso();
            } else {

                alertify.set("notifier", "position", "top-right"); alertify.error("Error");
            }
        }
    });
}

function firmarSeccionCierreProceso() {
    debugger;

    //confirmacion de incidencias 
    alertify.confirm('Incidencias', 'Durante la fabricación de la orden ' + idBatch + ' XXX cantidad total XXX durante alguno de los tanques hubo incidencias', function () {

        cargarObsIncidencias(data[0].id);
        deshabilitarbtn();

    }, function () {
        alertify.error('No se reportaron Incidencias');
        debugger;
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

function deshabilitarbtn() {
    $('.pesaje_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    $('.pesaje_verificado').prop('disabled', false);
}