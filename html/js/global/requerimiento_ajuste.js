
/* Validar si existe requerimiento */

buscarRequerimiento = (){
    $.ajax({
        type: "method",
        url: "url",
        data: "data",
        dataType: "dataType",
        success: function (response) {
            
        }
    });
}


/* Enviar requerimiento */

function guardarRequerimientoAjuste() {

    let materiales = $('#req_materiales').val();
    let procedimiento = $('#req_procedimiento').val();

    if (materiales == '' || procedimiento == '') {
        alertify.set("notifier", "position", "top-right"); alertify.error("ingrese todos los datos.");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "../../html/php/requerimiento_ajuste.php",
        data: { materia_prima: materiales, procedimiento: procedimiento, modulo: modulo, batch: idBatch },

        success: function (response) {

            if (response == 1)
                alertify.set("notifier", "position", "top-right"); alertify.success("Requerimiento Enviado.");
            $('#m_req_ajuste').modal('hide');
        }
    });
}