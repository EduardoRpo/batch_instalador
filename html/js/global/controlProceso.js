$(document).ready(function() {
    almacenarControlProceso = async(user) => {
        modulo == 6 ? (operacion = 3) : (operacion = 1);
        let muestras = JSON.parse(sessionStorage.getItem(presentacion + ref_multi + modulo));
        result = await muestrasRecolectadas(muestras)
        if (result == true)
            result = await almacenarEquipos()
        if (result == true)
            firmaControlProcesoEnvasado(user)
    }
});