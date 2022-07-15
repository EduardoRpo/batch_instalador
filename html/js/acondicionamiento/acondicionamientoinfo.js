/* variables globales */

modulo = 6;
let id_multi = 1;
let flag = 0;
let equipos = [];

//Carga el proceso despues de cargar la data  del Batch

$(document).ready(function() {
    setTimeout(() => {
        busqueda_multi();
        deshabilitarbotones();
    }, 1000);
});

/* Cargar Multipresentacion */

function busqueda_multi() {
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
                /* $(`#total${j}`).val(batch.tamano_lote); */

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


/* Ocultar Acondicionamiento */

function ocultar_acondicionamiento() {
    for (let i = 2; i < 6; i++) {
        $(`#acondicionamiento${i}`).attr("hidden", true);
    }
}

function cargar(btn, idbtn) {
    let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function(r) {
        sessionStorage.setItem("idbtn", idbtn);
        sessionStorage.setItem("btn", btn.id);
        id = btn.id;

        /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */
        let seleccion = $(".in_desinfeccion").val();

        if (seleccion == "Seleccione") {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione el producto para desinfección.");
            return false;
        }

        /* Valida el proceso para la segunda seccion */
        if (id != "despeje_realizado" && id != "despeje_verificado") {
            let banda = $(`#sel_banda${id_multi}`).val();
            let etiquetadora = $(`#sel_etiquetadora${id_multi}`).val();
            let tunel = $(`#sel_tunel${id_multi}`).val();

            if (!banda || !etiquetadora || !tunel) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Seleccione los equipos de la linea de producción.");
                return false;
            } else {
                equipos = [];
                for (i = 1; i < 4; i++) {
                    const equipo = {};
                    if (i === 1) equipo.equipo = banda;
                    if (i === 2) equipo.equipo = etiquetadora;
                    if (i === 3) equipo.equipo = tunel;
                    equipo.batch = idBatch;
                    equipo.modulo = modulo;
                    equipo.referencia = ref_multi;
                    equipos.push(equipo);
                }
            }
        }
        /* validar que todas las muestras se registraron */
        if (id == `controlpeso_realizado${id_multi}`) {
            i = sessionStorage.getItem(`totalmuestras${id_multi}`);
            cantidad_muestras = $(`#muestras${id_multi}`).val() * 5;

            if (i != cantidad_muestras) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todas las muestras");
                return false;
            }
        }

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
            }
        }

        if (id == `conciliacion_realizado${id_multi}`) {
            let unidades = $(`#txtUnidadesProducidas${id_multi}`).val();
            let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
            let mov = $(`#txtNoMovimiento${id_multi}`).val();

            let conciliacion = unidades * retencion * mov;

            if (conciliacion == 0) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Campos vacios o con valor cero");
                return false;
            }
        }
        /* Carga el modal para la autenticacion */

        $("#usuario").val("");
        $("#clave").val("");
        $("#m_firmar").modal("show");
    });
}