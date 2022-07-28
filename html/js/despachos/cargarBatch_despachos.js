$(document).ready(function() {

    cargarBatch = () => {
        operacion = 4;
        $.post("/html/php/conciliacion_rendimiento.php",
            (data = { operacion, idBatch, ref_multi, modulo }),
            function(data, textStatus, jqXHR) {
                info = JSON.parse(data);
                if (info == 0) return false;
                $(`#unidades_recibidas${id_multi}`)
                    .val(info.unidades_producidas)
                    .prop("readonly", true);
                $(`#cajas${id_multi}`).val(info.cajas).prop("readonly", true);
                $(`#mov_inventario${id_multi}`)
                    .val(info.mov_inventario)
                    .prop("readonly", true);
                $(`#obs${id_multi}`).val(info.observaciones).prop("readonly", true);
                //firmado(info.urlfirma);
            }
        );
    }

    cargar_despacho = () => {
        let op = 1;
        let cont = 0;
        $.post("../../html/php/despachos.php", (data = { op, idBatch, ref_multi, modulo }),
            function(data, textStatus, jqXHR) {
                let info = JSON.parse(data);
                if (info == 0) return false;

                //notificacion unidades finalizadas
                for (let i = 0; i < info.length; i++)
                    cont = cont + info[i]["entrega_final"];
                if (cont) $(`.notif_unidades${id_multi}`).show();

                //Inicializacion
                unidades_empaque = parseFloat($(`#unidad_empaque${id_multi}`).val());

                let unidades = 0,
                    cajas = 0,
                    retencion = 0;
                let unidadestotales = "";
                let number, myString;
                let j = 1;

                info.forEach((element) => {
                    if (element.modulo == 6) {
                        unidades = unidades + element.unidades;
                        cajas = cajas + element.cajas;
                        retencion = retencion + element.retencion;
                    }
                });

                if (!unidades && !retencion) {
                    if (info[0]["modulo"] == 6) {
                        unidades = info[0]["unidades_producidas"];
                        retencion = info[0]["muestras_retencion"];
                        movimiento = info[0]["mov_inventario"];
                        unidades_empaque = parseFloat($(`#unidad_empaque${id_multi}`).val());
                        cajs = Math.ceil((unidades - retencion) / unidades_empaque);
                        fact_muestras(referencia, id_multi);
                    }
                } else {
                    unidades_empaque = parseFloat($(`#unidad_empaque${id_multi}`).val());
                    cajs = Math.ceil((unidades - retencion) / unidades_empaque);

                    for (let i = 0; i < info.length; i++) {
                        if (info[i]["modulo"] == 6) {
                            number = info[i]["unidades"];
                            cjas = info[i]["cajas"];
                            mov = info[i]["movimiento"];
                            myString = `Parcial ${j}: (${number.toString()} unidades) (${cjas.toString()} cajas) (Movimiento: ${mov.toString()}).\n`;
                            unidadestotales = unidadestotales + " " + myString;
                            j++;
                        }
                    }
                }

                j = info.length - 1;
                $(`#unidades_recibidas_acond${id_multi}`).val(unidades);
                isFinite(cajs) ? cajs : (cajs = 0);
                $(`#cajas_acond${id_multi}`).val(cajs);

                if (info[j].movimiento)
                    $(`#mov_inventario_acond${id_multi}`).val(info[j].movimiento);
                else $(`#mov_inventario_acond${id_multi}`).val(movimiento);

                $(`#muestras_retencion_acond${id_multi}`).val(retencion);
                $(`#parciales${id_multi}`).val(unidadestotales);

                /* Despachos */
                unidades = 0;
                cajas = 0;
                movimiento = 0;
                for (let i = 0; i < info.length; i++) {
                    if (info[i]["modulo"] == 7) {
                        unidades = unidades + info[i]["unidades"];
                        cajas = cajas + info[i]["cajas"];
                        movimiento = info[i]["movimiento"];
                    }
                }

                $(`#consolidado_despachos_recibidas${id_multi}`).val(unidades);
                $(`#consolidado_despachos_cajas${id_multi}`).val(cajas);
                $(`#consolidado_despachos_mov_inventario${id_multi}`).val(movimiento);
            }
        );
        $.post("../../html/php/despachos.php", (data = { op: 2, idBatch, ref_multi, modulo }),
            function(data, textStatus, jqXHR) {
                if (data == "") return false;
                info = JSON.parse(data);
                firmado(info);
            }
        );
    }


    /* Registro de Firma */

    firmado = (datos) => {
        if (datos.length == 0) return false;
        let template =
            '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
        let parent;

        //btn_id = $("#idbtn").val();
        btn_id = `firma${id_multi}`;
        parent = $(`#despacho${id_multi}`).parent();
        $(`#despacho${id_multi}`).remove();
        $(`#despacho${id_multi}`)
            .css({ background: "lightgray", border: "gray" })
            .prop("disabled", true);

        let firma = template.replace(":firma:", datos[0].urlfirma);
        parent.append(firma).html;
    }
});