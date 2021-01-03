let id;
let cont = 1;
let contadorchecks;

/* Valida el usuario si existe en la base de datos */

function enviar() {

    $('#m_firmar').modal('hide');
    btn_id = localStorage.getItem("idbtn");

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
                    preparar(datos);
                }
            }
        });
    return false;
}

/* Si el usuario existe, ejecuta la opcion de acuerdo con el boton oprimido */

function preparar(datos) {
    info = JSON.parse(datos);

    if (btn_id == 'firma1') {
        validarPreguntas(info[0].id);
        firmar(info);
    }

    if (btn_id == 'firma2') {
        firmarVerficadoDespeje(info[0].id);
        firmar(info);
    }

    if (btn_id == 'firma3') {
        almacenar_muestras(info);
        firmar(info);
    }

    if (btn_id == 'firma4') {
        almacenarfirma(info[0].id);
        firmar(info);
    }

    if (btn_id == 'firma5') {
        registrarMaterialSobrante(info[0].id);
        firmar(info);
    }

    if (btn_id == 'firma6') {
        firmaCalidad(info[0].id);
        firmar(info);
    }
}

/* Almacenar datos de preguntas */

function validarPreguntas(idfirma) {
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
                habilitarbotones();
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

function firmar(firm) {
    debugger;
    let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent = $('#' + id).parent();

    $('#' + id).remove();
    id = '';

    let firma = template.replace(':firma:', firm[0].urlfirma);
    firma = firma.replace(':id:', btn_id);
    parent.append(firma).html
}

/* Imprimir pdf */

function imprimirPDF() {
    $('#m_firmar').modal('show');
}