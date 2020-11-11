let id;
let btnOprimido;
let cont = 1;
let contadorchecks;


function cargar(btn, idbtn) {

    $('#idbtn').val(idbtn);
    id = btn.id;

    //Validacion de control de tanques en pesaje
    if (id == "pesaje_realizado") {
        if ($("#chkcontrolTanques1").is(':not(:checked)')) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Chequee el 1er Tanque");
            return false;
        }
    }

    validarParametrosControl();

    if (completo !== 0) {
        /* limpia campos del formulario */
        $('#usuario').val('');
        $('#clave').val('');
        /* Cargamos el modal */
        $('#m_firmar').modal('show');
        cont = 0;
    }
}

/* Valida el usuario si existe en la base de datos */
function enviar() {
    $('#m_firmar').modal('hide');
    btn_id = $('#idbtn').val();
    
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

/* Si el usuario existe, ejeucta la opcion de acuerdo con el boton oprimido */

function preparar(datos) {
    data = JSON.parse(datos);

    if (btn_id == 'firma1') {
        validarPreguntas(data[0].id);
        firmar(data);
    }

    if (btn_id == 'firma2') {
        firmarVerficadoDespeje(data[0].id);
        firmar(data);
    }

    if (btn_id == 'firma3') {
        if (modulo == 2) {
            firmarSeccionPesaje();
        }

        if (modulo == 3) {
            var exito = guardarControlProcesoPreparacion();
            if (exito == 0)
                return false;
            else
                cargarObsIncidencias(data[0].id);
        }

    }

    if (btn_id == 'firma4') {
        
        almacenarfirma(data[0].id);
        firmar(data);
    }
}

/* Almacenar datos */

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
                $('.pesaje_realizado').prop('disabled', false);
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

function firmar() {

    let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent = $('#' + id).parent();

    $('#' + id).remove();
    id = '';

    let firma = template.replace(':firma:', data[0].urlfirma);
    firma = firma.replace(':id:', btn_id);
    parent.append(firma).html
}

/* Imprimir pdf */

function imprimirPDF() {
    $('#m_firmar').modal('show');
}