$(document).ready(function() {
    /* Habilitar Botones */

    habilitarbotones = () => {
        $(".preparacion_realizado").prop("disabled", false);
    }

    deshabilitarbtn = () => {
        $(".preparacion_realizado")
            .css({ background: "lightgray", border: "gray" })
            .prop("disabled", true);
        $(".preparacion_verificado").prop("disabled", false);
    }
});