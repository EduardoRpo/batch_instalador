$(document).ready(function() {
    validacionEspecificaciones = (id) => {
        array = ["preparacion_realizado", "aprobacion_realizado"]

        if (array.includes(id)) {
            validar = cargarResultadosEspecificaciones();
            if (validar == 0) return false
            else return true;
        } else
            return true
    }
});