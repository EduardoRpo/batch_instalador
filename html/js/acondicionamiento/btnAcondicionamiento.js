$(document).ready(function() {
    /* deshabilitar botones */
    function deshabilitarbotones() {
        for (let i = 1; i < 5; i++) {
            $(`.controlpeso_realizado${i}`).prop("disabled", true);
            $(`.controlpeso_verificado${i}`).prop("disabled", true);
            $(`.devolucion_realizado${i}`).prop("disabled", true);
            $(`.devolucion_verificado${i}`).prop("disabled", true);
            $(`.conciliacion_realizado${i}`).prop("disabled", true);
        }
    }
});