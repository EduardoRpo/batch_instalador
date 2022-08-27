

/* Mostrar Menu seleccionado */
$('.contenedor-menu .menu a').removeAttr('style');
$('#link_despeje').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_generales').show();

cargarSelectorProceso();
cargarSelectorPreguntas();
/* Cargue de Parametros de Control en DataTable */

$(document).ready(function() {
    $("#tblDespeje").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_despejeLinea.php",
            data: { operacion: "1" },
        },

        "columns": [
            { "data": "id" },
            { "data": "pregunta" },
            {
                "data": "resp",
                className: "centrado",
                render: (data, type, row) => {
                    'use strict';
                    return data == 1 ? 'Si' : 'No';
                }
            },
            { "data": "modulo" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }
        ]
    });
});

/* Mostrar formulario adicionar preguntas */

$('#adicionarParametro').click(function(e) {
    e.preventDefault();

    editar = 0;
    $("#frmadicionarPreguntaModulo").slideToggle();

    $('#btnguardarProceso').html('Crear');
    cargarSelectorProceso();
    cargarSelectorPreguntas();
});

/* Cargar selector Proceso */

function cargarSelectorProceso() {

    $.ajax({
        method: 'POST',
        url: 'php/c_despejeLinea.php',
        data: { operacion: "2" },

        success: function(response) {
            var info = JSON.parse(response);

            let $select = $('#cmbProceso');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info.data, function(i, value) {
                $select.append('<option value ="' + value.id + '">' + value.modulo + '</option>');
            });
        },
        error: function(response) {
            console.log(response);
        }
    })
}

/* Cargar selector Preguntas */

function cargarSelectorPreguntas() {

    $.ajax({
        method: 'POST',
        url: 'php/c_despejeLinea.php',
        data: { operacion: "3" },

        success: function(response) {
            var info = JSON.parse(response);

            let $select = $('#cmbPregunta');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info.data, function(i, value) {
                $select.append('<option value ="' + value.id + '">' + value.pregunta + '</option>');
            });
        },
        error: function(response) {
            console.log(response);
        }
    })
}

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function(e) {
    e.preventDefault();

    editar = 1;
    let id = $(this).parent().parent().children().first().text();
    let pregunta = $(this).parent().parent().children().eq(1).text();
    let respuesta = $(this).parent().parent().children().eq(2).text();
    let modulo = $(this).parent().parent().children().eq(3).text();

    $("#frmadicionarPreguntaModulo").slideDown();

    $(`#cmbPregunta option:contains(${pregunta})`).attr('selected', true);
    $(`#cmbRespuesta option:contains(${respuesta})`).attr('selected', true);
    $(`#cmbProceso option:contains(${modulo})`).attr('selected', true);


});

/* Borrar registros */

$(document).on('click', '.link-borrar', function(e) {
    e.preventDefault();

    const id = $(this).parent().parent().children().first().text();
    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function(r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_despejeLinea.php',
                'data': { operacion: "4", id }
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});


/* Almacenar Registros */

$('#btnguardarDespeje').click(function(e) {
    e.preventDefault();

    let pregunta = $('#cmbPregunta').val();
    let respuesta = $('#cmbRespuesta').val();
    let modulo = $('#cmbProceso').val();

    if (pregunta === null || respuesta === null || modulo === null) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Ingrese todos los datos.");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "php/c_despejeLinea.php",
        data: { operacion: "5", editar: editar, pregunta: pregunta, respuesta: respuesta, modulo: modulo },

        success: function(r) {
            if (r == 1) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Almacenado con éxito.");
                refreshTable();
            } else if (r == 2) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Configuración ya existe.");
            } else if (r == 3) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Registro actualizado.");
                refreshTable();
            } else {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Error.");
            }
        }
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#tblDespeje').DataTable().clear();
    $('#tblDespeje').DataTable().ajax.reload();
}