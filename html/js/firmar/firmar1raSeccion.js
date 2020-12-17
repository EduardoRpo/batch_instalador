let id;
/* let btnOprimido; */
let cont = 1;
let contadorchecks;
/* let data; */

function cargar(btn, idbtn) {

    /* $('#idbtn').val(idbtn); */
    localStorage.setItem("idbtn", idbtn);
    id = btn.id;

    //Validacion de control de tanques
    if (id == "pesaje_realizado" || id == "preparacion_realizado" || id == "aprobacion_realizado") {
        validar = controlTanques();
        if (validar == 0) {
            return false;
        }
    }

    /* valida que el instructivo se haya ejecutado */

    if (modulo == 3) {
        ordenpasos = localStorage.getItem("ordenpasos");
        if (pasoEjecutado != 0)
            if (pasoEjecutado < ordenpasos) {
                alertify.set("notifier", "position", "top-right"); alertify.error('Para continuar. Complete todo el instructivo');
                return false;
            }
    }

    /* Validacion que el formulario se encuentre completamente lleno */

    if (modulo == 3 && id == 'preparacion_realizado' || modulo == 4 && id == 'aprobacion_realizado') {
        validar = validardatosresultadosPreparacion();
        if (validar == 0)
            return false;
    }


    /* Validacion que todos los datos en linea y el formulario de control en preparacion no esten vacios */
    
    if (modulo == 3 && id == 'preparacion_realizado' || modulo == 5 && id == 'controlpeso_realizado') {
        validar = validarLinea();
        if (validar == 0)
            return false;
    }

    /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */

    if (modulo == 2 || modulo == 4 || modulo == 3 || modulo == 5) {

        let seleccion = $('#sel_producto_desinfeccion').val();
        if (modulo == 3 && seleccion != "Seleccione")
            seleccion = $('#select-Linea').val();

        if (seleccion == "Seleccione") {
            alertify.set("notifier", "position", "top-right"); alertify.error("Seleccione el producto para desinfección.");
            return false;
        }
    }

    if (modulo != 4) {
        validarParametrosControl();
    }

    /* Valida que todas las muestras y el lote se encuentren correctas*/
    debugger;
    if (modulo == 5 && id == 'controlpeso_realizado1') {
        
        validar = validarLote();
        if (validar == 0)
            return false;

        i = localStorage.getItem('totalmuestras')
        cantidad_muestras = $('#muestras1').val();

        if (i != cantidad_muestras) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Para continuar, Ingrese todas las muestras");
            return false;
        }
    }
    /* Carga el modal para la autenticacion */

    if (completo !== 0) {
        $('#usuario').val('');
        $('#clave').val('');
        $('#m_firmar').modal('show');
        cont = 0;
    }
}


/* Valida el usuario si existe en la base de datos */

function enviar() {
    $('#m_firmar').modal('hide');
    /* btn_id = $('#idbtn').val(); */
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
        firmar2daSeccion(info);
        /* firmar(info); */
    }

    if (btn_id == 'firma4') {
        almacenarfirma(info[0].id);
        firmar(info);
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
                debugger;
                $('.despeje_realizado').prop('disabled', true);
                $('.despeje_verificado').prop('disabled', false);

                if (modulo == 2)
                    $('.pesaje_realizado').prop('disabled', false);
                if (modulo == 3)
                    $('.preparacion_realizado').prop('disabled', false);
                if (modulo == 5)
                    $('#controlpeso_realizado1').prop('disabled', false);
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

    let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent = $('#' + id).parent();
    debugger;
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