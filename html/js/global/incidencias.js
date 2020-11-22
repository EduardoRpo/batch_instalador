
let firma_realizado;
let infofirma;
/* Cargar formulario incidencias */

function cargarObsIncidencias(firma) {

    firma_realizado = firma[0].id;
    infofirma = firma;
    $('#modalObservaciones').modal('show');
}


//Cargar selectores

function cargarSelectorIncidencias() {

    $.ajax({
        method: 'POST',
        url: '../../html/php/incidencias.php',
        data: { operacion: 1 },

        success: function (response) {

            info = JSON.parse(response);
            let j = 1;
            for (let i = 1; i < 8; i++) {
                let nombre_select = i;
                let $select = $(`#incidencias${i}`);
                $select.empty();

                $select.append('<option disabled selected>' + "Seleccionar" + '</option>');
                $select.append('<option>' + " " + '</option>');

                if (i == j) {
                    $.each(info.data, function (i, value) {
                        if (value.id_incidencias == j) {
                            $select.append('<option value ="' + value.id + '">' + value.nombre + '</option>');
                        }
                    });
                    j++;
                }
            }
        }

    })

}


//Guardar Incidencias

$('#guardarIncidencias').click(function (e) {
    e.preventDefault();

    let incidencias = [];
    let incidencia = [];

    for (let i = 1; i < 8; i++) {
        let motivo = $(`#incidencias${i}`).find(":selected").attr('value');

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
            "incidencia": incidencia[i],
            "motivo": incidencias[i],
            "modulo": modulo,
            "batch": idBatch,
        });
    }

    objeto.datos = datos;
    incidencias = JSON.stringify(objeto)
    let observaciones = $('.txtObservaciones').val();

    $.ajax({
        method: 'POST',
        url: '../../html/php/incidencias.php',
        data: {
            operacion: 2, incidencias,
            firma: firma_realizado,
            modulo: modulo,
            batch: idBatch,
            observaciones: observaciones,
        },

        success: function (response) {
            alertify.set("notifier", "position", "top-right"); alertify.success("Incidencias Reportadas exitosamente!");
            $('#modalObservaciones').modal('hide');
            firmar(infofirma);
        }

    });
});

$('#cerrarIncidencias').click(function (e) {
    e.preventDefault();
    $('#modalObservaciones').modal('hide');
    firmar(infofirma);
});