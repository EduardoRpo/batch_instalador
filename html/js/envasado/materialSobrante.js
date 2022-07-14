$(document).ready(function() {
    /* Almacena la info de tabla devolucion material */

    registrar_material_sobrante = (realizo) => {
        let materialsobrante = [];
        id_multi == 1 ? ((start = 1), (end = 4)) :
            id_multi == 2 ? ((start = 4), (end = 7)) :
            id_multi == 3 ? ((start = 7), (end = 10)) :
            ((start = 10), (end = 12));

        for (let i = start; i < end; i++) {
            let datasobrante = {};
            let itemref = $(`.refEmpaque${i}`).html();
            let envasada = $(`.envasada${i}`).val();

            envasada == "" || envasada == undefined ?
                (envasada = $(`.envasada${start}`).val()) :
                envasada;

            let averias = $(`.averias${i}`).val();
            let sobrante = $(`.sobrante${i}`).val();

            datasobrante.referencia = itemref;
            datasobrante.envasada = envasada;
            datasobrante.averias = averias;
            datasobrante.sobrante = sobrante;
            materialsobrante.push(datasobrante);
        }

        $.ajax({
            type: "POST",
            url: "../../html/php/c_devolucionMaterial.php",
            data: { materialsobrante, ref_multi, idBatch, modulo, realizo },

            success: function(r) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Firmado satisfactoriamente");
                habilitarbtn(btn_id);
            },
        });
    }
});