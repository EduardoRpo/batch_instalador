
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

                    if (response == '') {
                        cargarfirma2daSeccion();
                        return false;
                    }

                    /* Carga segunda firma */

                    let info = JSON.parse(response);
                    firma = info.urlfirma;
                    firmado(firma, 2);
                    cargarfirma2daSeccion();
                }
            });

            /* $.ajax({
                type: "POST",
                url: "../../html/php/proceso.php",
                data: { operacion: 1, modulo: modulo, batch: idBatch },

                success: function (response) {

                    if (response == '') {
                        $('.preparacion_realizado').prop('disabled', false);
                        $('.preparacion_verificado').prop('disabled', true);
                        return false;
                    }

                    let info = JSON.parse(response);
                    firma = info.data[0].urlfirma;
                    firmado(firma, 3);
                }
            }); */

        }
    });
}



/* Cargar Tanques */

function cargarfirma2daSeccion() {

    /* obtener los tanques chequeados */

    $.ajax({
        type: "POST",
        url: "../../html/php/batch_tanques.php",
        data: { modulo, idBatch, operacion: 2 },

        success: function (response) {

            var data = JSON.parse(response);
            T_tanques = data[0].tanques;
            T_tanquesOk = data[0].tanquesOk;

            if (data == '')
                return false;

            /* Chequea todos los tanques de acuerdo con la BD */

            for (i = 1; i <= data[0].tanquesOk; i++) {
                $(`#chkcontrolTanques${i}`).prop('checked', true);
                $(`#chkcontrolTanques${i}`).prop('disabled', true);
            }

            /* Valida que todos los tanques esten chequeados para proceder a firmar */

            if (T_tanquesOk == T_tanques) {

                $.ajax({
                    type: "POST",
                    url: "../../html/php/batch_tanques.php",
                    data: { modulo, idBatch, operacion: 4 },

                    success: function (response) {
                        let data = JSON.parse(response);

                        if (data == '')
                            return false;

                        let firma = data.realizo;
                        let verifico = data.verifico;
                        
                        firmado(firma, 3);
                        
                        if (verifico !== undefined)
                            firmado(verifico, 4);
                    }
                });
            }
        }
    });



}

/* function firmar2daSeccion() {
    debugger;
     if (posicion == 3)
    if (modulo == 2) {
        parent = $('#pesaje_realizado').parent();
        $('#pesaje_realizado').remove();
        $('.pesaje_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
        $('.pesaje_verificado').prop('disabled', false);
    }  else if (modulo == 3) {
            parent = $('#preparacion_realizado').parent();
            $('#preparacion_realizado').remove();
            $('.preparacion_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
            $('.preparacion_verificado').prop('disabled', false);

        }
} */

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
        
    }

    if (posicion == 2) {
        parent = $('#despeje_verificado').parent();
        $('#despeje_verificado').remove();
        $('.despeje_verificado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    }

    if (posicion == 3)
        if (modulo == 2) {
            parent = $('#pesaje_realizado').parent();
            $('#pesaje_realizado').remove();
            $('.pesaje_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
            $('.pesaje_verificado').prop('disabled', false);
        } /* else if (modulo == 3) {
            parent = $('#preparacion_realizado').parent();
            $('#preparacion_realizado').remove();
            $('.preparacion_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
            $('.preparacion_verificado').prop('disabled', false);

        } */


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