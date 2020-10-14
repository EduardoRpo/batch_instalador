let id;
let btnOprimido;
let cont = 1;

function cargar(btn, idbtn) {
    $('#idbtn').val(idbtn);

    id = btn.id;
    btnOprimido = id.split('_');

    if (btnOprimido[1] == 'verificado' && cont == 1) {
        alertify.set("notifier", "position", "top-right"); alertify.error("Debe firmar en orden, primero el 'Realizado'.");
        return false;
    } else {
        validarParametrosControl();

        if (completo !== 0) {
            $('#m_firmar').modal('show');
            cont = 0;
        }

    }

}


function enviar() {
    $('#m_firmar').modal('hide');
    btn_id = $('#idbtn').val();
    //VALIDAR PARA LA FIRMA DE VERIFICADO SI TODOS LOS CHECKBOX ESTAN CHEQUEADOS APARECER

    datos = {
        user: $('#usuario').val(),
        password: $('#clave').val(),
    },

        $.ajax({
            type: 'POST',
            url: '../../html/php/firmar.php',
            data: datos,

            success: function (datos) {

                if (datos.length < 1) {
                    alertify.set("notifier", "position", "top-right"); alertify.error("usuario y/o contraseña no coinciden.");
                    return false;
                } else {
                    debugger;
                    if ($("#firma1").length == 0) {
                        firmar(datos);
                    } /* else if ($("#firma2").length == 0) {
                        firmar(datos);
                    } */ else if ($("#firma3").length == 0) {
                        firmar(datos);
                    } else if ($("#firma4").length == 0) {
                        firmar(datos);
                    }
                }
            }
        });
    return false;
}

function firmar(datos) {
    data = JSON.parse(datos);

    let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent = $('#' + id).parent();

    $('#' + id).remove();
    id = '';

    let firma = template.replace(':firma:', data[0].urlfirma);
    firma = firma.replace(':id:', btn_id);
    parent.append(firma).html

    /* $('#imprimirEtiquetas').show(); /* Imprimir etiquetas */

    if (btnOprimido[1] == 'verificado') {
        cont = 1;
    }

    if (btn_id == 'firma1')
        validarPreguntas();
    if (btn_id == 'firma3')
        cargarObsIncidencias();

}

function validarPreguntas() {
    var list = { 'datos': [] };

    $("input:radio:checked").each(function () {
        list.datos.push({
            "pregunta": $(this).attr("id"),
            "solucion": $(this).val(),
            "modulo": modulo,
            "batch": idBatch,
        });
    });

    json = JSON.stringify(list);
    let obj = JSON.parse(json);

    desinfectante = $('#sel_producto_desinfeccion').val();
    observaciones = $('#in_observaciones').val();

    $.ajax({
        type: 'POST',
        url: "../../html/php/despeje.php",
        data: {
            operacion: 3,
            respuestas: obj,
            modulo: modulo,
            batch: idBatch,
            desinfectante: desinfectante,
            observaciones: observaciones,
        },
        success: function (response) {

            if (response > 0) {
                console.log('Almacenado');
            }
        }
    });
}

function cargarObsIncidencias() {
    $('#modalObservaciones').modal('show');
  }


function imprimirPDF() {
    $('#m_firmar').modal('show');
}