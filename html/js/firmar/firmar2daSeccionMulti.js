$(document).ready(function() {

    /* firmar 2da sección  */

    firmaControlProcesoEnvasado = (user) => {
        let realizo = user.id;

        //Almacena la firma
        $.ajax({
            type: "POST",
            url: "../../html/php/envasado.php",
            data: { operacion: 1, realizo, modulo, idBatch, ref_multi },

            success: function(response) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Firmado satisfactoriamente");
                habilitarbtn(btn_id);
                firmar(user);
            },
        });
    }

    /* almacenar firma calidad 2da seccion */

    almacenarfirma = async (verifico) => {
        let data = new FormData();
        data.append('idBatch', idBatch);
        data.append('verifico', verifico);
        data.append('modulo', modulo);
        data.append('refref_multi', ref_multi);

        let resp = await sendDataPost('/api/calidad2seccion', data, 2);

        alertify.set("notifier", "position", "top-right");
        if (resp.success == true) {
            alertify.success(resp.message);
            $(`.controlpeso_verificado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
            firmar(info);
        } else if (resp.error == true) alertify.error(resp.message);
        else if (resp.info == true) alertify.notify(resp.message);
        // $.ajax({
        //     type: "POST",
        //     url: "../../html/php/envasado.php",
        //     data: { operacion: 2, verifico, modulo, idBatch, ref_multi },

        //     success: function(response) {
        //         alertify.set("notifier", "position", "top-right");
        //         alertify.success("Firmado satisfactoriamente");
        //         $(`.controlpeso_verificado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        //         firmar(info);
        //     },
        // });
    };

    firmaCalidad = (verifico) => {
        $.ajax({
            type: "POST",
            url: "../../html/php/envasado.php",
            data: { operacion: 5, verifico, modulo, idBatch, ref_multi },

            success: function(response) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Firmado satisfactoriamente");
                $(`.controlpeso_verificado${id_multi}`)
                    .css({ background: "lightgray", border: "gray" })
                    .prop("disabled", true);
                if (modulo === 5 || modulo === 6) {
                    $(`.devolucion_verificado${id_multi}`)
                        .css({ background: "lightgray", border: "gray" })
                        .prop("disabled", true);
                }
            },
        });
    }
});