
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

                    if (response == '') {
                        if (modulo == 3)
                            cargarLinea();

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
        }
    });
}

/* cargar linea de equipos en el proceso de preparacion  */

function cargarLinea() {

    $.ajax({
        type: "POST",
        url: "../../html/php/cargarLineas.php",
        data: { operacion: 2, modulo, idBatch },

        success: function (response) {
            const data = JSON.parse(response);

            if (data == 'false')
                return false;

            $("#select-Linea").val(data[0].linea);
            cargarEquipos();
            cargarControlProceso();
        }
    });

}


function cargarControlProceso() {
    $.ajax({
        type: "POST",
        url: "../../html/php/controlProceso.php",
        data: { modulo, idBatch },

        success: function (response) {

            let info = JSON.parse(response);
            let index = info.data.length

            $('.color').val(info.data[index - 1].color);
            $('.olor').val(info.data[index - 1].olor);
            $('.apariencia').val(info.data[index - 1].apariencia);
            $('.ph').val(info.data[index - 1].ph);
            $('#in_viscocidad').val(info.data[index - 1].viscosidad);
            $('#in_densidad').val(info.data[index - 1].densidad);
            $('.untuosidad').val(info.data[index - 1].untuosidad);
            $('.espumoso').val(info.data[index - 1].espumoso);
            $('#in_grado_alcohol').val(info.data[index - 1].alcohol);

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
                    data: { operacion: 4, modulo, idBatch },

                    success: function (response) {
                        let data = JSON.parse(response);

                        if (data == 0)
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

    if (posicion == 3) {
        if (modulo == 2) {
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