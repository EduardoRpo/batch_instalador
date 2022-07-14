/* Carga tabla de envase del producto */

cargarTablaEnvase = (j, referencia, cantidad) => {
    $.ajax({
        url: "../../html/php/envase.php",
        type: "POST",
        data: { referencia },
    }).done((data, status, xhr) => {
        var info = JSON.parse(data);
        empaqueEnvasado = Math.round(cantidad / info[0].unidad_empaque);
        unidades = formatoCO(cantidad);

        /* Carga datos material referencia */

        $(`.envase${j}`).html(info[0].id_envase);
        $(`.descripcion_envase${j}`).html(info[0].envase);

        $(`.tapa${j}`).html(info[0].id_tapa);
        $(`.descripcion_tapa${j}`).html(info[0].tapa);

        $(`.etiqueta${j}`).html(info[0].id_etiqueta);
        $(`.descripcion_etiqueta${j}`).html(info[0].etiqueta);

        $(`.unidades${j}`).html(unidades);
        $(`.unidades${j}e`).html(empaqueEnvasado);

        /* Carga valores sin referencia mp  */

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
}