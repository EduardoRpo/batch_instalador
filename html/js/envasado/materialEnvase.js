$(document).ready(function() {

    ApiEnvase = '/api/envase/'

    // Carga tabla de envase del producto

    cargarTablaEnvase = async (batchMulti) => {
        for (let i = 0; i < batchMulti.length; i++) {
            InsumosMulti = await buscarDataMulti(`${ApiEnvase}${batchMulti[i]['referencia']}`);

            if (InsumosMulti.length > 0) {
                empaqueEnvasado = Math.round(batchMulti[i]['cantidad'] / InsumosMulti[0].unidad_empaque);

                !isFinite(empaqueEnvasado) ? empaqueEnvasado = 0 : empaqueEnvasado;

                unidades = formatoCO(batchMulti[i]['cantidad']);

                // Carga datos material referencia 

                $(`.envaseReferencia${i + 1}`).html(InsumosMulti[0].id_envase);
                $(`.envaseDescripcion${i + 1}`).html(InsumosMulti[0].envase);

                $(`.tapaReferencia${i + 1}`).html(InsumosMulti[0].id_tapa);
                $(`.tapaDescripcion${i + 1}`).html(InsumosMulti[0].tapa);

                $(`.etiquetaReferencia${i + 1}`).html(InsumosMulti[0].id_etiqueta);
                $(`.etiquetaDescripcion${i + 1}`).html(InsumosMulti[0].etiqueta);

                $(`.envaseUnidades${i + 1}`).html(unidades);
                $(`.tapaUnidades${i + 1}`).html(unidades);
                $(`.etiquetaUnidades${i + 1}`).html(unidades);

                //$(`.unidades${i + 1}e`).html(empaqueEnvasado);

                // Carga valores sin referencia mp

                if (InsumosMulti[0].id_envase == 50000) {
                    $(`.envaseUnidades${i + 1}`).html(0);
                    $(`#envaseEnvasada${i}`).val(0).prop("disabled", true);
                    $(`#envaseAverias${i}`).val(0).prop("disabled", true);
                    $(`#envaseSobrante${i}`).val(0).prop("disabled", true);
                    $(`#envaseDevolucion${i}`).html(0);
                }

                if (InsumosMulti[0].id_tapa == 50000) {
                    $(`.tapaUnidades${i + 1}`).html(0);
                    $(`#tapaEnvasada${i}`).val(0).prop("disabled", true);
                    $(`#tapaAverias${i}`).val(0).prop("disabled", true);
                    $(`#tapaSobrante${i}`).val(0).prop("disabled", true);
                    $(`#tapaDevolucion${i}`).html(0);
                }

                if (InsumosMulti[0].id_etiqueta == 50000) {
                    $(`.etiquetaUnidades${i + 1}`).html(0);
                    $(`#etiquetaEnvasada${i}`).val(0).prop("disabled", true);
                    $(`#etiquetaAverias${i}`).val(0).prop("disabled", true);
                    $(`#etiquetaSobrante${i}`).val(0).prop("disabled", true);
                    $(`#etiquetaDevolucion${i}`).html(0);
                }
            }
        }

    }


    /* Calculo de la devolucion de material */

    devolucionMaterialEnvasada = (valor) => {
        let unidades_envasadas = formatoCO(parseInt(valor));

        if (isNaN(unidades_envasadas))
            unidades_envasadas = 0;

        $(`.envasada${id_multi}`).html(unidades_envasadas);
        recalcular_valores();
    }

    //recalcular valores en la tabla de devolucion de materiales envase

    recalcular_valores = () => {
        let envasada = $(`#envaseEnvasada${id_multi}`).val();
        let averias = $(`#envaseAverias${id_multi}`).val();
        let sobrante = $(`#envaseSobrante${id_multi}`).val();
        let totalEnvase = parseInt(envasada) + parseInt(averias) + parseInt(sobrante);
        $(`#envaseDevolucion${id_multi}`).html(totalEnvase);

        averias = $(`#tapaAverias${id_multi}`).val();
        sobrante = $(`#tapaSobrante${id_multi}`).val();
        let totalTapa = parseInt(envasada) + parseInt(averias) + parseInt(sobrante);
        $(`#tapaDevolucion${id_multi}`).html(totalTapa);

        averias = $(`#etiquetaAverias${id_multi}`).val();
        sobrante = $(`#etiquetaSobrante${id_multi}`).val();
        let totalEtiqueta =
            parseInt(envasada) + parseInt(averias) + parseInt(sobrante);
        $(`#etiquetaDevolucion${id_multi}`).html(totalEtiqueta);
    }


    /* Almacena la info de tabla devolucion material */

    registrar_material_sobrante = (realizo) => {
        let materialsobrante = [];

        let datasobrante = {};
        let itemref = $(`.envaseReferencia${id_multi}`).html();
        let envasada = $(`.envaseEnvasada${id_multi}`).val();
        let averias = $(`.envaseAverias${id_multi}`).val();
        let sobrante = $(`.envaseSobrante${id_multi}`).val();

        datasobrante.referencia = itemref;
        datasobrante.envasada = envasada;
        datasobrante.averias = averias;
        datasobrante.sobrante = sobrante;
        materialsobrante.push(datasobrante);

        datasobrante = {};
        itemref = $(`.tapaReferencia${id_multi}`).html();
        tapa = $(`.envaseEnvasada${id_multi}`).val();
        averias = $(`.tapaAverias${id_multi}`).val();
        sobrante = $(`.tapaSobrante${id_multi}`).val();

        datasobrante.referencia = itemref;
        datasobrante.envasada = tapa;
        datasobrante.averias = averias;
        datasobrante.sobrante = sobrante;
        materialsobrante.push(datasobrante);

        datasobrante = {};
        itemref = $(`.etiquetaReferencia${id_multi}`).html();
        etiqueta = $(`.envaseEnvasada${id_multi}`).val();
        averias = $(`.etiquetaAverias${id_multi}`).val();
        sobrante = $(`.etiquetaSobrante${id_multi}`).val();

        datasobrante.referencia = itemref;
        datasobrante.envasada = envasada;
        datasobrante.averias = averias;
        datasobrante.sobrante = sobrante;
        materialsobrante.push(datasobrante);


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