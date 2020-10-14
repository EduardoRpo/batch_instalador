
/* validar y Cargar informacion almacenada en el batch */

function cargarBatch() {

    $.ajax({
        type: "POST",
        url: "../../html/php/despeje.php",
        data: { operacion: 1, module: modulo, idbatch: idBatch },

        success: function (response) {
            if (response=='')
                return false;
                
            let preg = $('#1').val();
            let info = JSON.parse(response);
            
            if (info !== '') {
                for (let i = 0; i < info.data.length; i++) {
                    let question = "question-" + info.data[i].id;
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

function cargarDesinfectante(){
    $.ajax({
        type: "POST",
        url: "../../html/php/despeje.php",
        data: { operacion: 2, module: modulo, idbatch: idBatch },

        success: function (response) {

            let info = JSON.parse(response);
            desinfectante = info.desinfectante;
            observacion = info.observaciones;

            $('#sel_producto_desinfeccion').val(desinfectante);
            $('#in_observaciones').val(observacion);
        }
    });
}