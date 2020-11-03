let id;
let btnOprimido;
let cont = 1;
let firma_realizado;

function cargar(btn, idbtn) {
    $('#idbtn').val(idbtn);
    id = btn.id;

    //Validacion de control de tanques en pesaje
    if (id == "pesaje_realizado") {
        if ($("#chkcontrolTanques1").is(':not(:checked)')) {
            alertify.set("notifier", "position", "top-right"); alertify.error("No hay tanques chequeados");
            return false;
        }
    }

    validarParametrosControl();

    if (completo !== 0) {
        $('#m_firmar').modal('show');
        cont = 0;
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
                    firmar(datos);
                }
            }
        });
    return false;
}

function firmar(datos) {
    data = JSON.parse(datos);

    if (btn_id == 'firma3')
        cargarObsIncidencias(data[0].id);

    let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent = $('#' + id).parent();

    $('#' + id).remove();
    id = '';

    let firma = template.replace(':firma:', data[0].urlfirma);
    firma = firma.replace(':id:', btn_id);
    parent.append(firma).html
    debugger;
    if (btn_id == 'firma1')
        validarPreguntas(data[0].id);
    if (btn_id == 'firma2')
        firmarVerficadoDespeje(data[0].id);


}
/* Almacenar datos */

function validarPreguntas(idfirma) {
    var list = { 'datos': [] };
debugger;
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
            operacion: 4,
            respuestas: obj,
            modulo: modulo,
            batch: idBatch,
            desinfectante: desinfectante,
            observaciones: observaciones,
            realizo: idfirma,
        },
        success: function (response) {

            if (response > 0) {
                $('.despeje_realizado').prop('disabled', true);
                $('.despeje_verificado').prop('disabled', false);
                $('.pesaje_realizado').prop('disabled', true);
            }
        }
    });
}

/* firma verificado despeje */

function firmarVerficadoDespeje(idfirma) {
    $.ajax({
        type: "POST",
        url: "../../html/php/despeje.php",
        data: {
            operacion: 5,
            verifico: idfirma,
            modulo: modulo,
            batch: idBatch,
        },

        success: function (response) {
            alertify.set("notifier", "position", "top-right"); alertify.success("Firmado satisfactoriamente");
            $('.despeje_verificado').prop('disabled', true);
        }
    });
}

/* Cargar formulario incidencias */

function cargarObsIncidencias(idFirma) {
    firma_realizado = idFirma;
    $('#modalObservaciones').modal('show');
}

/* Imprimir pdf */

function imprimirPDF() {
    $('#m_firmar').modal('show');
}