$(document).ready(function() {
    /* Cargar el tiempo del proceso */

    procesoTiempo = (event) => {
        pasoEjecutado = pasoEjecutado + 1;
        validar = controlTanques();
        if (validar == 0) {
            pasoEjecutado = 0
            return false;
        }

        let tiempo = $(event.target).attr("attr-tiempo");
        let id = $(event.target).attr("attr-id");
        let proceso = pasos[queeProcess];

        /* marcar el check del tanque siguiente y validar */

        if (proceso.id == id) {
            $("#tiempo_instructivo").val(tiempo);
        } else {
            $.alert({
                theme: "white",
                icon: "fa fa-warning",
                title: "Samara Cosmetics",
                content: "Siga el orden del instructivo",
                confirmButtonClass: "btn-info",
                type: "warning",
            });
        }
    }
});