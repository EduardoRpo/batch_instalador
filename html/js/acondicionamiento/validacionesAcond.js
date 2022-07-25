$(document).ready(function() {

    crearEquipos = () => {
        equipos = [];
        for (i = 1; i < 4; i++) {
            const equipo = {};

            if (i === 1) equipo.equipo = eq1;
            if (i === 2) equipo.equipo = eq2;
            if (i === 3) equipo.equipo = eq3;

            equipo.batch = idBatch;
            equipo.modulo = modulo;
            equipo.referencia = ref_multi;
            equipos.push(equipo);
        }
    }

    validarDevolucionMaterialAcondicionamiento = () => {
        if (id == `devolucion_realizado${id_multi}`) {
            let utilizada = $(`#utilizada_empaque${id_multi}`).val();
            let averias = $(`#averias_empaque${id_multi}`).val();
            let sobrante = $(`#sobrante_empaque${id_multi}`).val();

            if (utilizada == "" || averias == "" || sobrante == "") {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todos los datos");
                return false;
            }

            utilizada = $(`#utilizada_otros${id_multi}`).val();
            averias = $(`#averias_otros${id_multi}`).val();
            sobrante = $(`#sobrante_otros${id_multi}`).val();

            if (utilizada == "" || averias == "" || sobrante == "") {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todos los datos");
                return false;
            } else
                return true
        } else
            return 'no_validar'
    }

    /* validarControlProceso = (id) => {
        if (id != "despeje_realizado" && id != "despeje_verificado") {
            let banda = $(`#sel_banda${id_multi}`).val();
            let etiquetadora = $(`#sel_etiquetadora${id_multi}`).val();
            let tunel = $(`#sel_tunel${id_multi}`).val();

            if (!banda || !etiquetadora || !tunel) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Seleccione los equipos de la linea de producción.");
                return false;
            } else {
                crearEquiposAcondicionamiento()
            }
        }
    } */






});