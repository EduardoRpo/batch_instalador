$(document).ready(function() {
    let eq1
    let eq2

    validarEquiposSeleccionados = (id) => {
        if (id == `controlpeso_realizado${id_multi}`) {

            /* Validar equipos */

            eq1 = $(`#sel_envasadora${id_multi}`).val();
            eq2 = $(`#sel_loteadora${id_multi}`).val();

            if (eq1 === null || eq2 === null) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Seleccione los equipos a usar.");
                return false;
            } else
                return true

        } else
            return false
    }

    CrearEquiposEnvasado = () => {
        equipos = [];
        const eq3 = {};
        eq3.equipo = eq1;
        eq3.referencia = referencia;
        eq3.modulo = modulo;
        eq3.batch = idBatch;
        equipos.push(eq3);

        const eq4 = {};
        eq4.equipo = eq2;
        eq4.referencia = referencia;
        eq4.modulo = modulo;
        eq4.batch = idBatch;
        equipos.push(eq4);
    }


    obtenerMuestras = () => {
        i = sessionStorage.getItem("totalmuestras");
        cantidad_muestras = $(`#muestras${id_multi}`).val();

        if (i != cantidad_muestras) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Ingrese todas las muestras");
            return false;
        } else
            return true
    }

    validarDevolucionMaterial = () => {
        if (id == `devolucion_realizado${id_multi}`) {
            let cantidadEnvasada = $(`.txtEnvasada${id_multi}`).val();

            if (cantidadEnvasada == "") {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todos los datos");
                return false;
            } else
                return true
        } else
            return 'no_validar'
    }

    validarIdMulti = () => {

        //validar en que multipresentacion se encuentra

        id_multi == 1 ?
            ((start = 1), (end = 4)) :
            id_multi == 2 ?
            ((start = 4), (end = 7)) :
            id_multi == 3 ?
            ((start = 7), (end = 10)) :
            ((start = 10), (end = 12));

    }

    validarData = () => {
        //validar que los datos de toda la tabla se encuentran completos

        for (let i = start; i < end; i++) {
            let averias = $(`.averias${i}`).val();
            let sobrante = $(`.sobrante${i}`).val();

            if (averias == "" || sobrante == "" || averias == undefined || sobrante == undefined) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todos los datos");
                return false;
            } else
                return true
        }
    }

    validarControlPeso = async(id) => {
        if (typeof id_multi !== "undefined") {
            result = await validarEquiposSeleccionados(id)
            if (result) {
                CrearEquiposEnvasado()
                result = await validarLote()
                if (result) {
                    return result = obtenerMuestras()
                } else return false
            } else
                return false
        }
    }

    validarDevolucionMaterialEnvasado = async(id) => {
        if (typeof id_multi !== "undefined") {
            result = await validarDevolucionMaterial()
            if (result != 'no_validar') {
                if (result) {
                    validarIdMulti()
                    return result = validarData()
                } else
                    return false
            } else
                return true
        }
    }
});