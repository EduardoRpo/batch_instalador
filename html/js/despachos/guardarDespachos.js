$(document).ready(function() {
    guardar_despacho = (info) => {
        realizo = info.id;
        let unidades = $(`#unidades_recibidas${id_multi}`).val();
        let cajas = $(`#cajas${id_multi}`).val();
        let mov = $(`#mov_inventario${id_multi}`).val();
        let obs = $(`#obs${id_multi}`).val();
        let operacion = 3;

        modulo == 7 ? (operacion = 1) : operacion;

        data = { operacion, unidades, cajas, mov, obs, modulo, idBatch, ref_multi, realizo };

        alertify.confirm("Entrega", "¿Entrega parcial?",
            function() {
                data.entrega_final = 0;
                $.post("/html/php/servicios/parciales.php", data,
                    function(info, textStatus, jqXHR) {
                        if (textStatus == "success") {
                            entregaParcial(info)
                        } else {
                            alertify.set("notifier", "position", "top-right");
                            alertify.success("Mientras guardaba ocurrio un error. Intentelo nuevamente")
                            return false
                        }
                    }
                );
            },
            function() {
                data.entrega_final = 1;
                $.post("/html/php/conciliacion_rendimiento.php", data,
                    function(info, textStatus, jqXHR) {
                        if (textStatus == "success" && info == 'false') {
                            alertify.set("notifier", "position", "top-right");
                            alertify.warning("No se puede hacer el proceso. Acondicionamiento no ha realizado la entrega total")
                            return false
                        } else if (textStatus == "success") {
                            entregaTotal()
                        } else {
                            alertify.set("notifier", "position", "top-right");
                            alertify.success("Mientras guardaba ocurrio un error. Intentelo nuevamente")
                        }
                    }
                );
            }
        ).set("labels", { ok: "Si, Parcial", cancel: "No, Total" });
    }

    entregaParcial = () => {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Registro de despacho parcial exitoso");
        $(`#unidades_recibidas${id_multi}`).val("");
        $(`#cajas${id_multi}`).val("");
        $(`#mov_inventario${id_multi}`).val("");
        cargar_despacho();
    }

    entregaTotal = () => {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Registro de despacho exitoso");
        $(`.despacho${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        cargar_despacho();
        $(`#unidades_recibidas${id_multi}`).val("");
        $(`#cajas${id_multi}`).val("");
        $(`#mov_inventario${id_multi}`).val("");
    }


});