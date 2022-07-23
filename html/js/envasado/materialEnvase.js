$(document).ready(function() {

    ApiEnvase = '/api/envase/'

    // Carga tabla de envase del producto

    cargarTablaEnvase = async(batchMulti) => {
        for (let i = 0; i < batchMulti.length; i++) {
            InsumosMulti = await buscarDataMulti(`${ApiEnvase}${batchMulti[i]['referencia']}`)
            empaqueEnvasado = Math.round(cantidad / InsumosMulti.unidad_empaque);
            unidades = formatoCO(cantidad);

            // Carga datos material referencia 

            $(`.envase${i + 1}`).html(InsumosMulti[i].id_envase);
            $(`.descripcion_envase${i + 1}`).html(InsumosMulti[i].envase);

            $(`.tapa${i + 1}`).html(InsumosMulti[i].id_tapa);
            $(`.descripcion_tapa${i + 1}`).html(InsumosMulti[i].tapa);

            $(`.etiqueta${i + 1}`).html(InsumosMulti[i].id_etiqueta);
            $(`.descripcion_etiqueta${i + 1}`).html(InsumosMulti[i].etiqueta);

            $(`.unidades${i + 1}`).html(unidades);
            $(`.unidades${i + 1}e`).html(empaqueEnvasado);

            // Carga valores sin referencia mp

            if (InsumosMulti[i].id_envase == 50000) {
                $(`#envaseEnvasada${j}`).val(0).prop("disabled", true);
                $(`#envaseAverias${j}`).val(0).prop("disabled", true);
                $(`#envaseSobrante${j}`).val(0).prop("disabled", true);
                $(`#envaseDevolucion${j}`).html(0);
            }

            if (InsumosMulti[i].id_tapa == 50000) {
                $(`#tapaEnvasada${j}`).val(0).prop("disabled", true);
                $(`#tapaAverias${j}`).val(0).prop("disabled", true);
                $(`#tapaSobrante${j}`).val(0).prop("disabled", true);
                $(`#tapaDevolucion${j}`).html(0);
            }

            if (InsumosMulti[i].id_etiqueta == 50000) {
                $(`#etiquetaEnvasada${j}`).val(0).prop("disabled", true);
                $(`#etiquetaAverias${j}`).val(0).prop("disabled", true);
                $(`#etiquetaSobrante${j}`).val(0).prop("disabled", true);
                $(`#etiquetaDevolucion${j}`).html(0);
            }
        }

    }

    /* cargarTablaEnvase = (j, referencia, cantidad) => {
        $.ajax({
            url: "../../html/php/envase.php",
            type: "POST",
            data: { referencia },
        }).done((data, status, xhr) => {
            var info = JSON.parse(data);
            empaqueEnvasado = Math.round(cantidad / info[0].unidad_empaque);
            unidades = formatoCO(cantidad);

            // Carga datos material referencia 

    $(`.envase${j}`).html(info[0].id_envase);
    $(`.descripcion_envase${j}`).html(info[0].envase);

    $(`.tapa${j}`).html(info[0].id_tapa);
    $(`.descripcion_tapa${j}`).html(info[0].tapa);

    $(`.etiqueta${j}`).html(info[0].id_etiqueta);
    $(`.descripcion_etiqueta${j}`).html(info[0].etiqueta);

    $(`.unidades${j}`).html(unidades);
    $(`.unidades${j}e`).html(empaqueEnvasado);

    // Carga valores sin referencia mp

    id_multi = j;
    if (info[0].id_envase == 50000) {
        $(`#envaseEnvasada${j}`).val(0).prop("disabled", true);
        $(`#envaseAverias${j}`).val(0).prop("disabled", true);
        $(`#envaseSobrante${j}`).val(0).prop("disabled", true);
        $(`#envaseDevolucion${j}`).html(0);
    }

    if (info[0].id_tapa == 50000) {
        $(`#tapaEnvasada${j}`).val(0).prop("disabled", true);
        $(`#tapaAverias${j}`).val(0).prop("disabled", true);
        $(`#tapaSobrante${j}`).val(0).prop("disabled", true);
        $(`#tapaDevolucion${j}`).html(0);
    }

    if (info[0].id_etiqueta == 50000) {
        $(`#etiquetaEnvasada${j}`).val(0).prop("disabled", true);
        $(`#etiquetaAverias${j}`).val(0).prop("disabled", true);
        $(`#etiquetaSobrante${j}`).val(0).prop("disabled", true);
        $(`#etiquetaDevolucion${j}`).html(0);
    }
});
} * /

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