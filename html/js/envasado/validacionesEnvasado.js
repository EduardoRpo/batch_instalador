$(document).ready(function() {

    crearEquipos = () => {
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

    validarData = () => {
        //validar que los datos de toda la tabla se encuentran completos

        let envaseAverias = $(`.envaseAverias${id_multi}`).val();
        let tapaAverias = $(`.tapaAverias${id_multi}`).val();
        let etiquetaAverias = $(`.etiquetaAverias${id_multi}`).val();

        let envaseSobrante = $(`.envaseSobrante${id_multi}`).val();
        let tapaSobrante = $(`.tapaSobrante${id_multi}`).val();
        let etiquetaSobrante = $(`.etiquetaSobrante${id_multi}`).val();


        if (envaseAverias == "" ||
            tapaAverias == "" ||
            etiquetaAverias == "" ||
            envaseAverias == undefined ||
            tapaAverias == undefined ||
            etiquetaAverias == undefined ||
            envaseSobrante == "" ||
            tapaSobrante == "" ||
            etiquetaSobrante == "" ||
            envaseSobrante == undefined ||
            tapaSobrante == undefined ||
            etiquetaSobrante == undefined) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Ingrese todos los datos");
            return false;
        } else
            return true

    }

    validarDevolucionMaterialEnvasado = async(id) => {
        if (typeof id_multi !== "undefined") {
            result = await validarDevolucionMaterial()
            if (result != 'no_validar') {
                if (result) {
                    //validarIdMulti()
                    return result = validarData()
                } else
                    return false
            } else
                return true
        }
    }
});