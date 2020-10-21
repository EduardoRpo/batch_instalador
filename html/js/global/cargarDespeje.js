
/* validar y Cargar informacion almacenada en el batch */

function cargarBatch() {

    $.ajax({
        type: "POST",
        url: "../../html/php/despeje.php",
        data: { operacion: 1, module: modulo, idbatch: idBatch },

        success: function (response) {

            if (response == '')
                return false;

            let preg = $('#1').val();
            let info = JSON.parse(response);

            if (info !== '') {
                let j = 1;
                for (let i = 0; i < info.data.length; i++) {
                    let question = "question-" + j;
                    let valor = info.data[i].solucion;
                    $("input:radio[name=" + question + "][value=" + valor + "]").prop('checked', true);
                    j++;
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
                    let info = JSON.parse(response);
                    firma = info.urlfirma;
                    firmado(firma, 2);
                }
            });

        }
    });
}


function firmado(datos, posicion) {

    let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent;

    btn_id = $('#idbtn').val();

    if (posicion == 1) {
        parent = $('#despeje_realizado').parent();
        $('#despeje_realizado').remove();
    }

    if (posicion == 2){
        parent = $('#despeje_verificado').parent();
        $('#despeje_verificado').remove();
    }
        

    let firma = template.replace(':firma:', datos);
    //firma = firma.replace(':id:', btn_id);
    parent.append(firma).html

    if (posicion == 1) {
        $('#despeje_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
        $('.despeje_verificado').prop('disabled', false);
    } else if (posicion == 2) {
        $('.despeje_verificado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    }


}