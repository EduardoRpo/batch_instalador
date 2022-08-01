$(document).ready(function() {
    $(document).on('click', '.entregaParcial', function(e) {
        e.preventDefault();
        $(`.devolucion_realizado${id_multi}`).prop("disabled", true)
        $(`.conciliacion_realizado${id_multi}`).prop("disabled", false)
    });
});