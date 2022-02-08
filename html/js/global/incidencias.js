let firma_realizado;
let infofirma;

/* Habilitar modal para registrar incidencias si es requerido */

function observaciones_incidencias(firma) {
    let orden = localStorage.getItem("orden");
    let tamano_lote = localStorage.getItem("tamano_lote");

    //confirmación de incidencias

    var confirm = alertify
        .confirm(
            "Incidencias y Observaciones",
            `¿Durante la fabricación de la orden de producción ${orden} con cantidad total de ${tamano_lote} kg, se presentó alguna incidencia u observación al desarrollar el proceso?`,
            null,
            null
        )
        .set("labels", { ok: "Si", cancel: "No" });

    confirm.set({ transition: "slide" });

    confirm.set("onok", function() {
        cargarObsIncidencias(firma);
    });

    confirm.set("oncancel", function() {
        alertify.success("No se reportaron Incidencias");
        $.ajax({
            method: "POST",
            url: "../../html/php/incidencias.php",
            data: {
                operacion: 3,
                firma: firma[0].id,
                modulo: modulo,
                batch: idBatch,
            },

            success: function(response) {
                $("#modalObservaciones").modal("hide");
            },
        });
    });
}

/* Cargar formulario incidencias */

function cargarObsIncidencias(firma) {
    cargarSelectorIncidencias();
    firma_realizado = firma[0].id;
    infofirma = firma;
    $("#modalObservaciones").modal({
        show: true,
        backdrop: "static",
        keyboard: false,
    });
}

//Cargar selectores

function cargarSelectorIncidencias() {
    $.ajax({
        method: "POST",
        url: "../../html/php/incidencias.php",
        data: { operacion: 1 },

        success: function(response) {
            info = JSON.parse(response);
            let j = 1;
            for (let i = 1; i < 8; i++) {
                let nombre_select = i;
                let $select = $(`#incidencias${i}`);
                $select.empty();

                $select.append(
                    "<option disabled selected>" + "Seleccionar" + "</option>"
                );
                $select.append("<option>" + " " + "</option>");

                if (i == j) {
                    $.each(info.data, function(i, value) {
                        if (value.id_incidencias == j) {
                            $select.append(
                                '<option value ="' +
                                value.id +
                                '">' +
                                value.nombre +
                                "</option>"
                            );
                        }
                    });
                    j++;
                }
            }
        },
    });
}

//Guardar Incidencias

$("#guardarIncidencias").click(function(e) {
    e.preventDefault();
    let incidencias = [];
    let incidencia = [];

    for (let i = 1; i < 8; i++) {
        let motivo = $(`#incidencias${i}`).find(":selected").attr("value");

        if (motivo !== undefined) {
            incidencias.push(motivo);
            incidencia.push(i);
        }
    }

    var datos = [];
    var objeto = {};

    for (var i = 0; i < incidencias.length; i++) {
        var nombre = incidencias[i];

        datos.push({
            incidencia: incidencia[i],
            motivo: incidencias[i],
            modulo: modulo,
            batch: idBatch,
        });
    }

    objeto.datos = datos;
    incidencias = JSON.stringify(objeto);
    let observaciones = $(".txtObservaciones").val();

    $.ajax({
        method: "POST",
        url: "../../html/php/incidencias.php",
        data: {
            operacion: 2,
            incidencias,
            realizo: firma_realizado,
            modulo,
            idBatch,
            observaciones,
        },

        success: function(response) {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Incidencias Reportadas exitosamente!");
            $("#modalObservaciones").modal("hide");
            firmar(infofirma);
        },
    });
});

$("#cerrarIncidencias").click(function(e) {
    e.preventDefault();
    $("#modalObservaciones").modal("hide");
    alertify.warning("No reportó Incidencias, ni observaciones");
    realizo = JSON.parse(sessionStorage.getItem("firm"));
    realizo = realizo[0].id;
    $.ajax({
        method: "POST",
        url: "../../html/php/incidencias.php",
        data: { operacion: 3, realizo, modulo, idBatch },

        success: function(response) {
            $("#modalObservaciones").modal("hide");
            firmar(infofirma);
        },
    });
});