$(document).ready(function() {
    /* Registro de Firma */

    firmado = (datos, posicion) => {
        let template =
            '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
        let parent;

        btn_id = $("#idbtn").val();

        if (posicion == 1) {
            parent = $("#microbiologia_realizado").parent();
            $("#microbiologia_realizado").remove();
            $("#microbiologia_realizado")
                .css({ background: "lightgray", border: "gray" })
                .prop("disabled", true);
            $(".microbiologia_verificado").prop("disabled", false);
        } else {
            parent = $("#microbiologia_verificado").parent();
            $("#microbiologia_verificado").remove();
            $("#microbiologia_verificado")
                .css({ background: "lightgray", border: "gray" })
                .prop("disabled", true);
        }

        let firma = template.replace(":firma:", datos[0].urlfirma);
        parent.append(firma).html;
    }
});