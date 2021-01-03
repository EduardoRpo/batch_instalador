
/* validar y Cargar informacion almacenada en el batch */
flag = 1;

function cargarBatch() {

    $.ajax({
        type: "POST",
        url: "../../html/php/despeje.php",
        data: { operacion: 1, module: modulo, idbatch: idBatch },

        success: function (response) {

            if (response == '')
                return false;

            let info = JSON.parse(response);

            /* Carga todas las preguntas y su respuesta almacenada */

            if (info !== '') {
                for (let i = 0; i < info.data.length; i++) {
                    let question = "question-" + `${info.data[i].id_pregunta}`;
                    let valor = info.data[i].solucion;
                    $("input:radio[name=" + question + "][value=" + valor + "]").prop('checked', true);
                }
                cargarDesinfectante();
            }
            else
                return false;
        }
    });
}

/* Carga desinfectante y observaciones almacenadas en el batch */

function cargarDesinfectante() {
    $.ajax({
        type: "POST",
        url: "../../html/php/despeje.php",
        data: { operacion: 2, module: modulo, idbatch: idBatch },

        success: function (response) {

            /* Carga observaciones, desinfectante y firma */

            let info = JSON.parse(response);
            desinfectante = info.desinfectante;
            observacion = info.observaciones;
            firma = info.urlfirma;

            $('#sel_producto_desinfeccion').val(desinfectante);
            $('#in_observaciones').val(observacion);
            
            firmado(firma, 1);
            $('.controlpeso_realizado1').prop('disabled', false);

            $.ajax({
                type: "POST",
                url: "../../html/php/despeje.php",
                data: { operacion: 3, module: modulo, idbatch: idBatch },

                success: function (response) {

                    if (response !== '') {
                        let info = JSON.parse(response);
                        firma = info.urlfirma;
                        firmado(firma, 2);
                        cargarfirma2();
                        return false;
                    } else
                        $('.controlpeso_realizado1').prop('disabled', false);
                    //cargarfirma2();
                }
            });
        }
    });
}

/* Cargar firma 2 */

function cargarfirma2() {

    if (typeof id_multi == 'undefined')
        return false

    ref_multi = $(`.ref${id_multi}`).val();

    $.ajax({
        type: "POST",
        url: "url",
        data: "data",
        dataType: "dataType",
        success: function (response) {
            
        }
    });


    $.ajax({
        type: "POST",
        url: "../../html/php/envasado.php",
        data: { operacion: 3, modulo, idBatch, ref_multi },

        success: function (response) {
            let info = JSON.parse(response);

            if (info == 3)
                return false;

            for (i = 1; i <= info.data.length; i++) {
                $("#select-Linea1").val(info.data[0].linea);
                $(".validarLote").val(batch.numero_lote);

                cargarEquipos();
                firmado(info.data[0].realizo, 3);
                firmado(info.data[0].verifico, 4);

            }
            cargardevolucionmaterial();
        }
    });
}


function cargardevolucionmaterial() {

    $.ajax({
        type: "POST",
        url: "../../html/php/envasado.php",
        data: { operacion: 4, modulo, idBatch, ref_multi },

        success: function (response) {
            let info = JSON.parse(response);

            j = 1;

            if (info == 3)
                return false;

            $('#txtEnvasada1').val(info.data[0].envasada);
            $('.envasada1').html(info.data[0].envasada);

            for (i = 0; i < 3; i++) {
                $(`#averias${j}`).val(info.data[i].averias);
                $(`#sobrante${j}`).val(info.data[i].sobrante);
                devolucionMaterialTotal(info.data[i].sobrante, j);
                j++;
            }
            
            firmado(info.data[0].realizo, 5);
            firmado(info.data[0].verifico, 6);
        }
    });
}


/* Registro de Firma */

function firmado(datos, posicion) {
   
    if (datos == undefined)
        return false;

    let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent;

    btn_id = $('#idbtn').val();

    if (posicion == 1) {
        parent = $('#despeje_realizado').parent();
        $('#despeje_realizado').remove();
        $('#despeje_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);

        $('.despeje_verificado').prop('disabled', false);
        $('#controlpeso_realizado1').prop('disabled', false);
    }

    if (posicion == 2) {
        parent = $('#despeje_verificado').parent();
        $('#despeje_verificado').remove();
        $('.despeje_verificado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    }

    if (posicion == 3) {
        parent = $(`#controlpeso_realizado${id_multi}`).parent();
        $(`#controlpeso_realizado${id_multi}`).remove();
        $(`.controlpeso_realizado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
        $(`.controlpeso_verificado${id_multi}`).prop('disabled', false);
        $(`.devolucion_realizado${id_multi}`).prop('disabled', false);
    }

    if (posicion == 4) {
        parent = $(`#controlpeso_verificado${id_multi}`).parent();
        $(`#controlpeso_verificado${id_multi}`).remove();
        $(`.controlpeso_verificado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    }

    if (posicion == 5) {
        parent = $(`#devolucion_realizado${id_multi}`).parent();
        $(`#devolucion_realizado${id_multi}`).remove();
        $(`.devolucion_realizado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
        $(`.devolucion_verificado${id_multi}`).prop('disabled', false);
    }

    if (posicion == 6) {
        parent = $(`#devolucion_verificado${id_multi}`).parent();
        $(`#devolucion_verificado${id_multi}`).remove();
        $(`.devolucion_verificado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    }

    let firma = template.replace(':firma:', datos);
    parent.append(firma).html
}