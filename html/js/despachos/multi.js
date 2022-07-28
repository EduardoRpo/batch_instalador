$(document).ready(function() {
    /* Cargar Multipresentacion */

    busqueda_multi = (batch) => {
        ocultar_presentacion_despachos();

        $.ajax({
            method: "POST",
            url: "../../html/php/busqueda_multipresentacion.php",
            data: { idBatch },

            success: function(data) {
                batchMulti = JSON.parse(data);

                let j = 1;
                if (batchMulti !== 0) {
                    for (let i = 0; i < batchMulti.length; i++) {
                        referencia = batchMulti[i].referencia;
                        presentacion = batchMulti[i].presentacion;
                        cantidad = batchMulti[i].cantidad;
                        total = batchMulti[i].total;

                        $(`#ref${j}`).val(referencia);
                        $(`#unidad_empaque${j}`).val(batchMulti[i].unidad_empaque);

                        $(`#tanque${j}`).html(formatoCO(presentacion));
                        $(`#cantidad${j}`).html(formatoCO(cantidad));
                        $(`#total${j}`).html(formatoCO(total));

                        $(`#fila${j}`).attr("hidden", false);
                        $(`#despachos${j}`).attr("hidden", false);
                        $(`#despachosMulti${j}`).html(`DESPACHOS PRESENTACIÓN: ${presentacion} REFERENCIA ${referencia}`);
                        //fact_muestras(referencia, j);
                        j++;
                    }
                } else {
                    batch == undefined ? location.reload() : batch;
                    $(`#tanque${j}`).html(formatoCO(batch.presentacion));
                    $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
                    $(`#total${j}`).html(formatoCO(batch.tamano_lote));
                    $(`#despachosMulti${j}`).html(`DESPACHOS PRESENTACIÓN: ${batch.presentacion} REFERENCIA: ${batch.referencia}`);
                    $(`#ref${j}`).val(referencia);
                    $(`#unidad_empaque${j}`).val(batch.unidad_empaque);
                    //fact_muestras(referencia, j);
                }
                multi = j + 1;
            },
            error: function(r) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Error al Cargar la multipresentacion.");
            },
        });
    }
});