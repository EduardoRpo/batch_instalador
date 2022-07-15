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
        alertify
            .confirm(
                "Entrega",
                "¿Entrega parcial?",
                function() {
                    data.entrega_final = 0;
                    $.post(
                        "../../../html/php/servicios/parciales.php",
                        data,
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
                                conciliacionRendimiento();
                            }
                        }
                    );
                },
                function() {
                    data.entrega_final = 1;

                    $.post(
                        "../../html/php/conciliacion_rendimiento.php",
                        data,
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
                        }
                    );
                }
            )
            .set("labels", {
                ok: "Si, Parcial",
                cancel: "No, Total",
            });
    }
});