
/* validar y Cargar informacion almacenada en el batch */

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

            $.ajax({
                type: "POST",
                url: "../../html/php/despeje.php",
                data: { operacion: 3, module: modulo, idbatch: idBatch },

                success: function (response) {
                    debugger;
                    if (response !== '') {
                        let info = JSON.parse(response);
                        firma = info.urlfirma;
                        firmado(firma, 2);
                        cargarfirma2();
                        return false;
                    } else
                        $('.controlpeso_realizado1').prop('disabled', false);
                        cargarfirma2();
                }
            });
        }
    });
}

/* Cargar firma 2 */

function cargarfirma2() {

    $.ajax({
        type: "POST",
        url: "../../html/php/envasado.php",
        data: { operacion: 3, modulo, idBatch },

        success: function (response) {
            let info = JSON.parse(response);
            debugger;
            if (info == 3) {
                return false;
            }

            $("#select-Linea1").val(info.data[0].linea);
            $(".validarLote").val(batch.numero_lote);
            cargarEquipos();
            firmado(info.data[0].urlfirma, 3)

        }
    });
}


/* Registro de Firma */

function firmado(datos, posicion) {

    let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent;

    btn_id = $('#idbtn').val();

    if (posicion == 1) {
        parent = $('#despeje_realizado').parent();
        $('#despeje_realizado').remove();
        $('#despeje_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);

        $('.despeje_verificado').prop('disabled', false);
        $('.pesaje_realizado').prop('disabled', false);

        $('.preparacion_realizado').prop('disabled', false);
        $('.preparacion_verificado').prop('disabled', true);

        $('#controlpeso_realizado1').prop('disabled', false);
    }

    if (posicion == 2) {
        parent = $('#despeje_verificado').parent();
        $('#despeje_verificado').remove();
        $('.despeje_verificado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    }

    if (posicion == 3) {
        /* if (modulo == 2) {
            parent = $('#pesaje_realizado').parent();
            $('#pesaje_realizado').remove();
            $('.pesaje_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
            $('.pesaje_verificado').prop('disabled', false);
        }
        if (modulo == 3) {
            parent = $('#preparacion_realizado').parent();
            $('#preparacion_realizado').remove();
            $('.preparacion_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
            $('.preparacion_verificado').prop('disabled', false);

        } */
        if (modulo == 5) {
            parent = $('#controlpeso_realizado1').parent();
            $('#controlpeso_realizado1').remove();
            $('#controlpeso_realizado1').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
            $('#controlpeso_verificado1').prop('disabled', false);

        }
    }


    if (posicion == 4)
        if (modulo == 2) {
            parent = $('#pesaje_verificado').parent();
            $('#pesaje_verificado').remove();
            $('.pesaje_verificado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);

        } /* else if (modulo == 3) {
            parent = $('#preparacion_realizado').parent();
            $('#preparacion_realizado').remove();
            $('.preparacion_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
            $('.preparacion_verificado').prop('disabled', false);

        } */


    let firma = template.replace(':firma:', datos);
    parent.append(firma).html
}