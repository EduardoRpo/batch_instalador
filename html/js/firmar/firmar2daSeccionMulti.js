

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