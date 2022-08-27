$(document).ready(function() {
    /* Cargar Multipresentacion */

    busqueda_multi = () => {
        ocultar_acondicionamiento();

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
                        densidad_producto = batchMulti[i].densidad_producto;
                        total = batchMulti[i].total;

                        $(`#ref${j}`).val(referencia);
                        $(`#unidad_empaque${j}`).val(batchMulti[i].unidad_empaque);
                        $(`#presentacion${j}`).val(presentacion);
                        $(`#densidad${j}`).val(densidad_producto);
                        $(`#total${j}`).val(total);

                        $(`#tanque${j}`).html(formatoCO(presentacion));
                        $(`#cantidad${j}`).html(formatoCO(cantidad));
                        $(`#unidadesProgramadas${j}`).val(cantidad);
                        $(`#total${j}`).html(formatoCO(total));

                        $(`#fila${j}`).attr("hidden", false);
                        $(`#acondicionamiento${j}`).attr("hidden", false);
                        $(`#acondicionamientoMulti${j}`).html(`ACONDICIONAMIENTO PRESENTACIÓN: ${presentacion} REFERENCIA ${referencia}`);
                        cargarTablaEnvase(j, referencia, cantidad);
                        calcularMuestras(j, cantidad);

                        //rendimiento = rendimiento_producto(referencia, presentacion, densidad, total);
                        //$(`#rendimientoProducto${j}`).val(rendimiento);
                        j++;
                    }
                } else {
                    batch == undefined ? location.reload() : batch;
                    $(`#tanque${j}`).html(formatoCO(batch.presentacion));
                    $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
                    $(`#unidadesProgramadas${j}`).val(batch.unidad_lote);
                    $(`#total${j}`).html(formatoCO(batch.tamano_lote));
                    $(`#acondicionamientoMulti${j}`).html(`ACONDICIONAMIENTO PRESENTACIÓN: ${batch.presentacion} REFERENCIA: ${batch.referencia}`);

                    $(`#ref${j}`).val(referencia);
                    $(`#unidad_empaque${j}`).val(batch.unidad_empaque);
                    $(`#presentacion${j}`).val(batch.presentacion);
                    $(`#densidad${j}`).val(batch.densidad_producto);
                    // $(`#total${j}`).val(batch.tamano_lote); 

                    cargarTablaEnvase(j, batch.referencia, batch.unidad_lote);
                    calcularMuestras(j, batch.unidad_lote);
                    //rendimiento = rendimiento_producto(referencia, batch.presentacion, batch.unidad_lote, batch.densidad, batch.tamano_lote);
                    //$(`#rendimientoProducto${j}`).val(rendimiento);
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