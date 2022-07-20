$(document).ready(function() {

    validacionInstructivo = (id) => {
        if (id == "preparacion_realizado") {
            ordenpasos = sessionStorage.getItem("ordenpasos");

            if (pasoEjecutado !== 0 || pasoEjecutado == 0)
                if (pasoEjecutado < ordenpasos) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Para continuar. Complete todo el instructivo");
                    return false;
                } else
                    return true
        } else
            return true
    }

    validacionEspecificaciones = (id) => {
        if (id == "preparacion_realizado") {
            validar = cargarResultadosEspecificaciones();
            if (validar == 0) return false
            else return true;
        } else
            return true
    }

});