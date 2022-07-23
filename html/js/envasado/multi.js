$(document).ready(function() {

    ApiMulti = '/api/multi/'

    busqueda_multi = async() => {
        ocultarEnvasado()
        batchMulti = await buscarDataMulti(`${ApiMulti}${idBatch}`)
        cargarInfoBatchMulti(batchMulti)
        cargarTablaEnvase(batchMulti)
    }

    ocultarEnvasado = () => {
        for (let i = 2; i < 6; i++)
            $(`#envasado${i}`).attr("hidden", true);
    }

    buscarDataMulti = (urlApi) => {
        return searchData(urlApi)
    }

    cargarInfoBatchMulti = (batchMulti) => {
        let j = 1;
        if (batchMulti !== 0) {
            for (let i = 0; i < batchMulti.length; i++) {
                referencia = batchMulti[i].referencia;
                presentacion = batchMulti[i].presentacion;
                cantidad = batchMulti[i].cantidad;
                total = batchMulti[i].total;

                $(`#ref${j}`).val(referencia);

                $(`#tanque${j}`).html(formatoCO(presentacion));
                $(`#cantidad${j}`).html(formatoCO(cantidad));
                $(`#total${j}`).html(formatoCO(total));

                $(`#fila${j}`).prop("hidden", false);
                $(`#envasado${j}`).prop("hidden", false);
                $(`#envasadoMulti${j}`).html(`ENVASADO PRESENTACIÓN: ${presentacion} REFERENCIA ${referencia}`);

                //cargarTablaEnvase(j, referencia, cantidad);
                calcularMuestras(j, cantidad);
                cargarEntregasParciales(j, referencia)
                j++;
            }
        } else {
            $(`#tanque${j}`).html(formatoCO(batch.presentacion));
            $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
            $(`#total${j}`).html(formatoCO(batch.tamano_lote));
            $(`#envasadoMulti${j}`).html(`ENVASADO PRESENTACIÓN: ${batch.presentacion} REFERENCIA: ${batch.referencia}`);
            $(`#ref${j}`).val(referencia);

            cargarTablaEnvase(j, batch.referencia, batch.unidad_lote);
            calcularMuestras(j, batch.unidad_lote);
            cargarEntregasParciales(j, referencia)
        }
        multi = j + 1;
    }


    //Cargar Multipresentacion

    /* busqueda_multi = () => {
        ocultarEnvasado();

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

                        $(`#tanque${j}`).html(formatoCO(presentacion));
                        $(`#cantidad${j}`).html(formatoCO(cantidad));
                        $(`#total${j}`).html(formatoCO(total));

                        $(`#fila${j}`).prop("hidden", false);
                        $(`#envasado${j}`).prop("hidden", false);
                        $(`#envasadoMulti${j}`).html(`ENVASADO PRESENTACIÓN: ${presentacion} REFERENCIA ${referencia}`);

                        cargarTablaEnvase(j, referencia, cantidad);
                        calcularMuestras(j, cantidad);
                        cargarEntregasParciales(j, referencia)
                        j++;
                    }
                } else {
                    $(`#tanque${j}`).html(formatoCO(batch.presentacion));
                    $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
                    $(`#total${j}`).html(formatoCO(batch.tamano_lote));
                    $(`#envasadoMulti${j}`).html(`ENVASADO PRESENTACIÓN: ${batch.presentacion} REFERENCIA: ${batch.referencia}`);
                    $(`#ref${j}`).val(referencia);

                    cargarTablaEnvase(j, batch.referencia, batch.unidad_lote);
                    calcularMuestras(j, batch.unidad_lote);
                    cargarEntregasParciales(j, referencia)
                }
                multi = j + 1;
            },
            error: function(r) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Error al Cargar la multipresentacion.");
            },
        });
    } */
});