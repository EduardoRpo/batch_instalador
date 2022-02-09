/* Variables Globales */
flag = 1;

/* Desactivar btn parciales */

for (let i = 1; i < 5; i++)
    $(`btnEntregasParciales${i}`).css("disabled", true);

/* validar y Cargar informacion almacenada en el batch */

function cargarBatch() {
    $.ajax({
        type: "POST",
        url: "../../html/php/despeje.php",
        data: { operacion: 1, modulo, idBatch },

        success: function(response) {
            if (response == "") return false;

            let info = JSON.parse(response);

            /* Carga todas las preguntas y su respuesta almacenada */

            if (info !== "") {
                for (let i = 0; i < info.length; i++) {
                    let question = "question-" + `${info[i].id_pregunta}`;
                    let valor = info[i].solucion;
                    $("input:radio[name=" + question + "][value=" + valor + "]").prop("checked", true);
                }
                cargarDesinfectante();
            } else return false;
        },
    });
}

/* Carga desinfectante y observaciones almacenadas en el batch */

function cargarDesinfectante() {
    $.ajax({
        type: "POST",
        url: "../../html/php/despeje.php",
        data: { operacion: 2, modulo, idBatch },

        success: function(response) {
            if (response == "") return false;

            /* Carga observaciones, desinfectante y firma operador */

            let info = JSON.parse(response);
            desinfectante = info.desinfectante;
            observacion = info.observaciones;
            firma = info.urlfirma;

            $("#sel_producto_desinfeccion").val(desinfectante);
            $("#in_observaciones").val(observacion);

            /* firma  */
            firmado(firma, 1);

            /* habilitar botones para siguiente seccion */

            for (i = 1; i < 5; i++) {
                $(`.controlpeso_realizado${i}`).prop("disabled", false);
            }

            /* Carga firma calidad */
            $.ajax({
                type: "POST",
                url: "../../html/php/despeje.php",
                data: { operacion: 3, modulo, idBatch },

                success: function(response) {
                    if (response !== "") {
                        let info = JSON.parse(response);
                        firma = info.urlfirma;
                        firmado(firma, 2);
                        return false;
                    } else if (typeof id_multi !== "undefined")
                        $(`.controlpeso_realizado${id_multi}`).prop("disabled", false);
                },
            });
        },
    });
}

/* Cargar firma 2 */

function cargarfirma2() {
    if (typeof id_multi == "undefined") return false;
    if (r1 > 1 || r2 > 1 || r3 > 1) return false;

    ref_multi = $(`.ref${id_multi}`).val();

    $.ajax({
        type: "POST",
        url: "../../html/php/envasado.php",
        data: { operacion: 3, modulo, idBatch, ref_multi },

        success: function(response) {
            let info = JSON.parse(response);
            if (info == 3) return false;

            for (i = 1; i <= info.length; i++) {
                $(`#validarLote${id_multi}`).val(batch.numero_lote);
                cargarEquipos();
                promedio();
                firmado(info[0].realizo, 3);
                firmado(info[0].verifico, 4);
            }
            cargardevolucionmaterial();
        },
    });
}

function cargardevolucionmaterial() {
    $.ajax({
        type: "POST",
        url: "../../html/php/envasado.php",
        data: { operacion: 4, modulo, idBatch, ref_multi },

        success: function(response) {
            let info = JSON.parse(response);

            j = 0;

            if (info == 3) return false;

            //validar en que multipresentacion se encuentra
            if (modulo == 5) {
                $(`#envaseEnvasada${id_multi}`).val(info.data[0].envasada);
                $(`#envaseAverias${id_multi}`).val(info.data[0].averias);
                $(`#envaseSobrante${id_multi}`).val(info.data[0].sobrante);
                $(`.envasada${id_multi}`).html(info.data[0].envasada);

                $(`#envaseDevolucion${id_multi}`).html(
                    parseInt($(`#envaseEnvasada${id_multi}`).val()) +
                    parseInt($(`#envaseAverias${id_multi}`).val()) +
                    parseInt($(`#envaseSobrante${id_multi}`).val())
                );

                $(`#tapaEnvasada${id_multi}`).val(info.data[1].envasada);
                $(`#tapaAverias${id_multi}`).val(info.data[1].averias);
                $(`#tapaSobrante${id_multi}`).val(info.data[1].sobrante);

                $(`#tapaDevolucion${id_multi}`).html(
                    parseInt($(`#tapaEnvasada${id_multi}`).val()) +
                    parseInt($(`#tapaAverias${id_multi}`).val()) +
                    parseInt($(`#tapaSobrante${id_multi}`).val())
                );

                $(`#etiquetaEnvasada${id_multi}`).val(info.data[2].envasada);
                $(`#etiquetaAverias${id_multi}`).val(info.data[2].averias);
                $(`#etiquetaSobrante${id_multi}`).val(info.data[2].sobrante);

                $(`#etiquetaDevolucion${id_multi}`).html(
                    parseInt($(`#etiquetaEnvasada${id_multi}`).val()) +
                    parseInt($(`#etiquetaAverias${id_multi}`).val()) +
                    parseInt($(`#etiquetaSobrante${id_multi}`).val())
                );

                firmado(info.data[0].realizo, 5);
                firmado(info.data[0].verifico, 6);
            } else {
                $(`#utilizada_empaque${id_multi}`).val(info.data[0].envasada);
                $(`#averias_empaque${id_multi}`).val(info.data[0].averias);
                $(`#sobrante_empaque${id_multi}`).val(info.data[0].sobrante);
                //recalcular_valores();
                $(`#utilizada_otros${id_multi}`).val(info.data[1].envasada);
                $(`#averias_otros${id_multi}`).val(info.data[1].averias);
                $(`#sobrante_otros${id_multi}`).val(info.data[1].sobrante);
                recalcular_valores();

                firmado(info.data[0].realizo, 5);
                firmado(info.data[0].verifico, 6);
            }
            if (modulo === 6) {
                rendimiento_producto();
                cargar_conciliacion();
            }
        },
    });
}

/* Cargar conciliacion  */
function cargar_conciliacion() {
    let operacion = 2;
    $.post(
        "../../html/php/conciliacion_rendimiento.php",
        (data = { operacion, idBatch, ref_multi, modulo }),
        function(data, textStatus, jqXHR) {
            if (textStatus == "success") {
                let info = JSON.parse(data);
                if (data == 0) return false;
                $(`#parcialUnidadesProducidas${id_multi}`).val(
                    info.unidades_producidas
                );
                $(`#parcialesUnidadesProducidas${id_multi}`).val(
                    info.unidades_producidas
                );
                if (info.muestras_retencion) {
                    $(`#txtMuestrasRetencion${id_multi}`).prop("readonly", true);
                    $(`#txtMuestrasRetencion${id_multi}`).val(info.muestras_retencion);
                }
                $(`#txtNoMovimiento${id_multi}`).val(info.mov_inventario);
                conciliacionRendimiento();
                if (info.urlfirma) {
                    $(`#alert_entregas${id_multi}`).removeClass("alert-danger");
                    $(`#alert_entregas${id_multi}`).addClass("alert-success");
                    firmado(info.urlfirma, 7);
                }
            } else {
                return false;
            }
        }
    );
}

/* Registro de Firma */

function firmado(datos, posicion) {
    if (datos == undefined) return false;

    let template =
        '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent;

    btn_id = $("#idbtn").val();
    debugger
    if (posicion == 1) {
        parent = $("#despeje_realizado").parent();
        $("#despeje_realizado").remove();
        $("#despeje_realizado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        $(".despeje_verificado").prop("disabled", false);
        $("#controlpeso_realizado1").prop("disabled", false);
    }

    if (posicion == 2) {
        parent = $("#despeje_verificado").parent();
        $("#despeje_verificado").remove();
        $(".despeje_verificado").css({ background: "lightgray", border: "gray" }).prop("disabled", true);
    }

    if (posicion == 3) {
        parent = $(`#controlpeso_realizado${id_multi}`).parent();
        $(`#controlpeso_realizado${id_multi}`).remove();
        $(`.controlpeso_realizado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        $(`.controlpeso_verificado${id_multi}`).prop("disabled", false);
        $(`.devolucion_realizado${id_multi}`).prop("disabled", false);

        if (modulo == 5 && flagEntregas == 0)
            $(`.btnEntregasParciales${id_multi}`).prop("disabled", false);

    }

    if (posicion == 4) {
        parent = $(`#controlpeso_verificado${id_multi}`).parent();
        $(`#controlpeso_verificado${id_multi}`).remove();
        $(`.controlpeso_verificado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
    }

    if (posicion == 5) {
        parent = $(`#devolucion_realizado${id_multi}`).parent();
        $(`#devolucion_realizado${id_multi}`).remove();
        $(`.devolucion_realizado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        $(`.btnEntregasParciales${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        $(`.devolucion_verificado${id_multi}`).prop("disabled", false);
        $(`.conciliacion_realizado${id_multi}`).prop("disabled", false);
    }

    if (posicion == 6) {
        parent = $(`#devolucion_verificado${id_multi}`).parent();
        $(`#devolucion_verificado${id_multi}`).remove();
        $(`.devolucion_verificado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
    }

    if (posicion == 7) {
        parent = $(`#conciliacion_realizado${id_multi}`).parent();
        $(`#conciliacion_realizado${id_multi}`).remove();
        $(`.conciliacion_realizado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
    }

    let firma = template.replace(":firma:", datos);
    parent.append(firma).html;
}