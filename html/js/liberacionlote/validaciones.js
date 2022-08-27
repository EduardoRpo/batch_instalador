$(document).ready(function() {

    validacionesCheckLiberacion = () => {
        radio = $("input:radio[name=liberacion]:checked").val();
        if (radio == undefined) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione una opción para liberar el producto");
            return false;
        } else
            return true;
    }

    validarDataDespachos = () => {
        let modulo = 7
        $.get(`/api/validacionesCierreProceso/${batch.id_batch}/${modulo}`,
            function(data, textStatus, jqXHR) {
                if (data.error == true) {
                    notificaciones(data)
                }
            });
    }
});