$(document).ready(function() {
    /* Cargar tabla Material */

    cargarTablaEnvase = (j, referencia, cantidad) => {
        $.ajax({
            url: "../../html/php/envase.php",
            type: "POST",
            data: { referencia },
        }).done((data, status, xhr) => {
            var info = JSON.parse(data);
            if (info[0].unidad_empaque === 0) empaqueEnvasado = "Sin unidad de Empaque";
            else
                empaqueEnvasado = formatoCO(
                    Math.round(cantidad / info[0].unidad_empaque)
                );
            unidades = formatoCO(cantidad);

            $(`.empaque${j}`).html(info[0].id_empaque);
            $(`.descripcion_empaque${j}`).html(info[0].empaque);

            $(`.otros${j}`).html(info[0].id_otros);
            $(`.descripcion_otros${j}`).html(info[0].otros);

            $(`.unidades${j}`).html(unidades);
            $(`.unidades${j}e`).html(empaqueEnvasado);

            for (let i = 1; i < 4; i++) {
                if (info[0].id_empaque == 50000) {
                    $(`#utilizada_empaque${j}`).val(0).prop("disabled", true);
                    $(`#averias_empaque${j}`).val(0).prop("disabled", true);
                    $(`#sobrante_empaque${j}`).val(0).prop("disabled", true);
                    recalcular_valores();
                }
                if (info[0].id_otros == 50000) {
                    $(`#utilizada_otros${j}`).val(0).prop("disabled", true);
                    $(`#averias_otros${j}`).val(0).prop("disabled", true);
                    $(`#sobrante_otros${j}`).val(0).prop("disabled", true);
                    recalcular_valores();
                }
            }
        });
    }

    //recalcular valores en la tabla de devolucion de materiales envase

    recalcular_valores = () => {
        let utilizada = $(`#utilizada_empaque${id_multi}`).val();
        let averias = $(`#averias_empaque${id_multi}`).val();
        let sobrante = $(`#sobrante_empaque${id_multi}`).val();

        utilizada == "" ? (utilizada = 0) : utilizada;
        averias == "" ? (averias = 0) : averias;
        sobrante == "" ? (sobrante = 0) : sobrante;

        let total = parseInt(utilizada) + parseInt(averias) + parseInt(sobrante);
        total = formatoCO(parseInt(total));
        $(`#totalDevolucion_empaque${id_multi}`).html(total);

        utilizada = $(`#utilizada_otros${id_multi}`).val();
        averias = $(`#averias_otros${id_multi}`).val();
        sobrante = $(`#sobrante_otros${id_multi}`).val();

        utilizada == "" ? (utilizada = 0) : utilizada;
        averias == "" ? (averias = 0) : averias;
        sobrante == "" ? (sobrante = 0) : sobrante;

        total = parseInt(utilizada) + parseInt(averias) + parseInt(sobrante);
        total = formatoCO(parseInt(total));
        $(`#totalDevolucion_otros${id_multi}`).html(total);
    }

    /* Almacena la info de tabla devolucion material */

    registrar_material_sobrante = (realizo) => {
        let materialsobrante = [];
        let datasobrante = {};

        let itemref = $(`#refempaque${id_multi}`).html();
        let envasada = $(`#utilizada_empaque${id_multi}`).val();
        let averias = $(`#averias_empaque${id_multi}`).val();
        let sobrante = $(`#sobrante_empaque${id_multi}`).val();

        datasobrante.referencia = itemref;
        datasobrante.envasada = envasada;
        datasobrante.averias = averias;
        datasobrante.sobrante = sobrante;
        materialsobrante.push(datasobrante);

        datasobrante = {};
        itemref = $(`#refempaque2`).html();
        envasada = $(`#utilizada_otros${id_multi}`).val();
        averias = $(`#averias_otros${id_multi}`).val();
        sobrante = $(`#sobrante_otros${id_multi}`).val();

        datasobrante.referencia = itemref;
        datasobrante.envasada = envasada;
        datasobrante.averias = averias;
        datasobrante.sobrante = sobrante;
        materialsobrante.push(datasobrante);

        $.ajax({
            type: "POST",
            url: "../../html/php/c_devolucionMaterial.php",
            data: { materialsobrante, ref_multi, idBatch, modulo, realizo },

            success: function(response) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Firmado satisfactoriamente");
                habilitarbtn(btn_id);
            },
        });
    }

    let unidad = $("txtUnidadesProducidas").val();

    conciliacionRendimiento = () => {
        $(`#txtNoMovimiento${id_multi}`).val("");
        let unidadEmpaque = $(`#unidad_empaque${id_multi}`).val(); //se debe cargar desde envasado

        if (unidadEmpaque === "0") {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Valide las unidades de empaque del producto con el administrador, presenta valor cero (0)");
            $(`#txtTotal-Cajas${id_multi}`).val("Valide unidades de Empaque");

        }

        let unidadesProducidas = parseInt($(`#txtUnidadesProducidas${id_multi}`).val());
        let parcialesUnidadesProducidas = parseInt($(`#parcialesUnidadesProducidas${id_multi}`).val());

        isNaN(parcialesUnidadesProducidas) ? parcialesUnidadesProducidas = 0 : parcialesUnidadesProducidas

        unidadesProducidas = parseFloat(unidadesProducidas) + parseFloat(parcialesUnidadesProducidas)

        let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
        let unidadesProgramadas = parseInt($(`#unidadesProgramadas${id_multi}`).val());

        if (retencion == undefined || retencion == "") retencion = 0;

        isNaN(unidadesProducidas) ?
            (unidadesProducidas = $(`#parcialesUnidadesProducidas${id_multi}`).val()) :
            unidadesProducidas;

        if (parseInt(retencion) > parseInt(unidadesProducidas)) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Muestras de retención mayor a las Unidades Producidas");
            var totalCajas = "";
            var entregarBodega = "";
        } else {
            totalCajas = Math.ceil((unidadesProducidas - retencion) / unidadEmpaque); //aproximar por encima
            totalCajas == Infinity ? (totalCajas = "No Aplica") : totalCajas;
            entregarBodega = unidadesProducidas - retencion;
        }

        $(`#txtTotal-Cajas${id_multi}`).val(formatoCO(totalCajas));
        $(`#txtEntrega-Bodega${id_multi}`).val(formatoCO(entregarBodega));
        $(`#txtPorcentaje-Unidades${id_multi}`).val(((unidadesProducidas / unidadesProgramadas) * 100).toFixed(2) + "%");

        rendimiento_producto();
    }


});