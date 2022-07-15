$(document).ready(function() {
    /* deshabilitar botones */

    deshabilitarbotones = () => {
        for (let i = 1; i < 5; i++) {
            $(`.controlpeso_realizado${i}`).prop("disabled", true);
            $(`.controlpeso_verificado${i}`).prop("disabled", true);
            $(`.devolucion_realizado${i}`).prop("disabled", true);
            $(`.devolucion_verificado${i}`).prop("disabled", true);
            $(`.btnEntregasParciales${i}`).prop("disabled", true);
        }
    }
});