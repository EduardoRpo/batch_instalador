let id;
let cont = 1;
let contadorchecks;

$(document).ready(function() {

    /* firma verificado despeje */

    firmarVerficadoDespeje = async(idfirma) => { 
        // $.ajax({
        //     type: "POST",
        //     url: "../../html/php/despeje.php",
        //     data: { operacion: 5, verifico: idfirma, modulo, idBatch },

        //     success: function (response) {
        //         alertify.set('notifier', 'position', 'top-right');

                
        //         alertify.set("notifier", "position", "top-right");
        //         alertify.success("Firmado satisfactoriamente");
        //     },
        // });
        
        let data = new FormData();
        data.append('idBatch', idBatch);
        data.append('modulo', modulo);

        let resp = await sendDataPost('/api/despeje', data, 2);

        if (resp.success == true) {
            alertify.success(resp.message);
            $(".despeje_verificado")
                .css({ background: "lightgray", border: "gray" })
                .prop("disabled", true);
        } else if (resp.error == true) alertify.error(resp.message);
        else if (resp.info == true) alertify.notify(resp.message);
    }

    firmar = (firm) => {
        let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
        let parent = $("#" + id).parent();

        $("#" + id).remove();
        id = "";

        let firma = template.replace(":firma:", firm.urlfirma);
        firma = firma.replace(":id:", btn_id);
        parent.append(firma).html;
    }

    /* Imprimir pdf */

    imprimirPDF = () => {
        $("#m_firmar").modal("show");
    }
});