$(document).ready(function() {

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
});