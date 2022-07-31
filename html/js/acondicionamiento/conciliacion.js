var entregaParcial = false
var entregaTotal = false

$(document).ready(function() {

    rendimiento_producto = () => {

        cantidadparciales = $(`#parcialesUnidadesProducidas${id_multi}`).val();
        cantidadparciales == "" ? cantidadparciales = 0 : cantidadparciales
        cantidadIngresada = $(`#txtUnidadesProducidas${id_multi}`).val();
        cantidadIngresada == "" ? cantidadIngresada = 0 : cantidadIngresada

        cantidad = parseFloat(cantidadparciales) + parseFloat(cantidadIngresada)

        presentacion = parseInt($(`#presentacion${id_multi}`).val());
        densidad = parseFloat($(`#densidad${id_multi}`).val());
        total = $(`#total${id_multi}`).html();
        /* total = $(`#in_tamano_lote`).val(); 
        total = total.replace(".", ""); */

        let rendimiento = (presentacion * cantidad * densidad) / 1000;
        rendimiento = ((rendimiento / total) * 100).toFixed(2) + "%";
        $(`#rendimientoProducto${id_multi}`).val(rendimiento);
    }

    validarTipoEntrega = () => {
        alertify.confirm("Entrega", "¿Entrega parcial?",
            function() {
                entregaParcial = true
                ingresarUsuario()
            },
            function() {
                data = { operacion: 6, entrega_final: 1, idBatch, ref_multi, modulo }
                $.post("../../html/php/conciliacion_rendimiento.php", data,
                    function(data, textStatus, jqXHR) {
                        if (data == 'false') {
                            alertify.set("notifier", "position", "top-right");
                            alertify.error("No se puede hacer el cierre total. Para finalizar la entrega debe completar el módulo de envasado");
                            return false
                        } else {
                            data = { operacion: 7, entrega_final: 1, idBatch, ref_multi, modulo }
                            $.post("../../html/php/conciliacion_rendimiento.php", data,
                                function(data, textStatus, jqXHR) {

                                    if (!data) {
                                        alertify.set("notifier", "position", "top-right");
                                        alertify.error("No se puede hacer el cierre total. Faltan firmas de calidad");
                                        return false
                                    }

                                    entregaTotal = true
                                    ingresarUsuario()

                                })
                        }
                    })
            }).set("labels", { ok: "Si, Parcial", cancel: "No, Total" });
    }

    registrar_conciliacion = (info) => {
        let operacion = 1;
        let unidades = $(`#txtUnidadesProducidas${id_multi}`).val();
        let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
        let mov = $(`#txtNoMovimiento${id_multi}`).val();
        let cajas = $(`#txtTotal-Cajas${id_multi}`).val();
        data = {
            operacion,
            unidades,
            retencion,
            cajas,
            mov,
            modulo,
            idBatch,
            ref_multi,
            realizo: info.id,
        };

        if (entregaParcial == true) {
            $.post("../../../html/php/servicios/parciales.php", data,
                function(data, textStatus, jqXHR) {
                    data = JSON.parse(data);
                    if (textStatus == "success") {
                        if (data.length == 1) imprimirEtiquetasRetencion();

                        alertify.set("notifier", "position", "top-right");
                        alertify.success("Conciliación parcial registrada satisfactoriamente");
                        let suma = 0;
                        data.forEach((element) => {
                            suma = suma + element.unidades;
                        });

                        alertify.alert("Entrega Parcial", `Total Unidades Entregadas: <b>${suma}</b>`);
                        $(`#parcialesUnidadesProducidas${id_multi}`).val(suma);
                        $(`#txtMuestrasRetencion${id_multi}`).prop("readonly", true);
                        $(`#txtUnidadesProducidas${id_multi}`).val("");

                        $(`.devolucion_realizado${id_multi}`).prop("disabled", false)
                        $(`.conciliacion_realizado${id_multi}`).prop("disabled", true)

                        conciliacionRendimiento();
                    }
                })
        } else if (entregaTotal == true) {
            data.entrega_final = 1;
            $.post("../../html/php/conciliacion_rendimiento.php", data,
                function(data, textStatus, jqXHR) {
                    if (data == 'false') {
                        alertify.set("notifier", "position", "top-right");
                        alertify.error("No se puede hacer el cierre total. Para finalizar la entrega debe completar el módulo de envasado");
                        return false
                    }
                    if (textStatus == "success") {
                        imprimirEtiquetasRetencion();
                        alertify.set("notifier", "position", "top-right");
                        alertify.success("Conciliación registrada satisfactoriamente");

                        $(`.conciliacion_realizado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);

                        final = parseFloat($(`#txtUnidadesProducidas${id_multi}`).val());
                        parciales = parseFloat($(`#parcialesUnidadesProducidas${id_multi}`).val());

                        if (isNaN(parciales)) parciales = 0;

                        $(`#txtUnidadesProducidas${id_multi}`).val(final + parciales);
                        $(`#parcialesUnidadesProducidas${id_multi}`).val(final + parciales);
                        $(`#txtMuestrasRetencion${id_multi}`).prop("disable", "true");
                        $(`#alert_entregas${id_multi}`).removeClass("alert-danger");
                        $(`#alert_entregas${id_multi}`).addClass("alert-success");

                        conciliacionRendimiento();
                        firmar(info);
                    }
                });

        }

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