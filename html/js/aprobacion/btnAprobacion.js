$(document).ready(function() {
    deshabilitarbtn = () => {
        $(".aprobacion_realizado")
            .css({ background: "lightgray", border: "gray" })
            .prop("disabled", true);
        $(".aprobacion_verificado").prop("disabled", false);
    }
});