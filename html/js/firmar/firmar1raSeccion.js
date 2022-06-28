let id;
let cont = 1;
let contadorchecks;
let btn_id;

/* Valida el usuario si existe en la base de datos */

function enviar() {

    $("#m_firmar").modal("hide");
    btn_id = sessionStorage.getItem("idbtn");

    (datos = {
        user: $("#usuario").val(),
        password: $("#clave").val(),
        btn_id,
    }),
    $.ajax({
        type: "POST",
        //url: "../../html/php/firmar.php",
        url: "/api/auth",
        data: datos,

        success: function(datos) {

            alertify.set("notifier", "position", "top-right");

            if (datos.info == true) {
                alertify.warning(datos.message)
                return false
            }
            if (datos.error == true) {
                alertify.error(datos.message)
                return false
            }

            preparar(datos);
            sessionStorage.setItem("firm", datos.id);
        },
    });
    return false;

}

/* Si el usuario existe, ejecuta la opción de acuerdo con la seleccion */

function preparar(datos) {
    info = datos;
    //info = JSON.parse(datos);
    if (btn_id == "firma1") {
        if (modulo === 7) guardar_despacho(info);
        if (modulo === 8) guardar_microbiologia(info);
        if (modulo === 9) firmar2daSeccion(info);
        if (modulo === 10) guardarLiberacion(info);
        else if (modulo !== 8 && modulo !== 9) guardar_preguntas(info.id);
        if (modulo != 7 && modulo != 8) firmar(info);
    }

    if (btn_id == "firma2") {
        if (modulo === 8)
            guardar_microbiologia_calidad(info);
        if (modulo === 9) {
            almacenarfirma(info);
        }
        if (modulo === 10) guardarLiberacion(info);
        else if (modulo !== 8 && modulo !== 9) {
            firmarVerficadoDespeje(info.id);
            firmar(info);
        }
    }

    if (btn_id == "firma3") {
        if (modulo === 5 || modulo === 6)
            almacenar_muestras(info);
        if (modulo == 10) {
            guardarLiberacion(info);
            /* firmar(info); */
        } else
            firmar2daSeccion(info);
    }

    if (btn_id == "firma4") {
        almacenarfirma(info);
        /* firmar(info) */
    }

    if (btn_id == "firma5") {
        if (modulo != 5 && modulo != 6) {
            info.id;
            firmar(info);
        } else {
            registrar_material_sobrante(info.id);
            observaciones_incidencias(info);
            firmar(info);
        }
    }

    if (btn_id == "firma6") {
        firmaCalidad(info.id);
        firmar(info);
    }

    if (btn_id == "firma7") {
        registrar_conciliacion(info);
        //firmar(info);
    }
}

/* Almacenar datos de preguntas */

function guardar_preguntas(idfirma) {
    var list = { datos: [] };

    $("input:radio:checked").each(function() {
        list.datos.push({
            pregunta: $(this).attr("id"),
            solucion: $(this).val(),
            modulo: modulo,
            batch: idBatch,
        });
    });

    json = JSON.stringify(list);
    let obj = JSON.parse(json);

    desinfectante = $("#sel_producto_desinfeccion").val();
    obs_desinfectante = $("#in_observaciones").val();

    $.ajax({
        type: "POST",
        url: "../../html/php/despeje.php",
        data: {
            operacion: 4,
            respuestas: obj,
            modulo,
            idBatch,
            desinfectante,
            obs_desinfectante,
            realizo: idfirma,
        },
        success: function(response) {
            if (response > 0) {
                $(".despeje_realizado")
                    .css({ background: "lightgray", border: "gray" })
                    .prop("disabled", true);
                $(".despeje_verificado").prop("disabled", false);
                habilitarbotones();
            }
        },
    });
}

/* firma verificado despeje */

function firmarVerficadoDespeje(idfirma) {
    $.ajax({
        type: "POST",
        url: "../../html/php/despeje.php",
        data: { operacion: 5, verifico: idfirma, modulo, idBatch },

        success: function(response) {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Firmado satisfactoriamente");
            $(".despeje_verificado")
                .css({ background: "lightgray", border: "gray" })
                .prop("disabled", true);
        },
    });
}

function firmar(firm) {
    let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent = $("#" + id).parent();

    $("#" + id).remove();
    id = "";

    let firma = template.replace(":firma:", firm.urlfirma);
    firma = firma.replace(":id:", btn_id);
    parent.append(firma).html;
}

/* Imprimir pdf */

function imprimirPDF() {
    $("#m_firmar").modal("show");
}