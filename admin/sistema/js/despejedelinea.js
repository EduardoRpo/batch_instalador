/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#linkDespeje').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir').show();

cargarSelectorProceso();
/* Cargue de Parametros de Control en DataTable */

$(document).ready(function () {
    $("#listarDespeje").DataTable({
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
                "data": "resp", className: "centrado",
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

$('#adicionarParametro').click(function (e) {
    e.preventDefault();
    $("#frmadParametro").slideToggle();
    $('#txtIdPregunta').val('');
    $('#btnguardarProceso').html('Crear');
    cargarSelectorProceso();
});

/* Cargar selector Proceso */

function cargarSelectorProceso() {

    $.ajax({
        method: 'POST',
        url: 'php/c_despejeLinea.php',
        data: { operacion: "2" },

        success: function (response) {
            var info = JSON.parse(response);

            let $select = $('#cmbProceso');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info.data, function (i, value) {
                $select.append('<option value ="' + value.id + '">' + value.modulo + '</option>');
            });
        },
        error: function (response) {
            console.log(response);
        }
    })
}

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    let id = $(this).parent().parent().children().first().text();
    let pregunta = $(this).parent().parent().children().eq(1).text();
    let respuesta = $(this).parent().parent().children().eq(2).text();
    let modulo = $(this).parent().parent().children().eq(3).text();

    $('#frmadParametro').slideDown();
    $('#txtIdPregunta').val(id);
    $('#txtPregunta').val(pregunta);
    $('#txtRespuesta').val(respuesta);
    $(`#cmbProceso option:contains(${modulo})`).attr('selected', true);


});

/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().first().text();
    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_despejeLinea.php',
                'data': { operacion: "3", id: id }
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});


/* Almacenar Registros */

$('#btnguardarProceso').click(function (e) {
    e.preventDefault();

    let id = $('#txtIdPregunta').val();
    let pregunta = $('#txtIdPregunta').val();
    let respuesta = $('#txtRespuesta').val();
    let modulo = $('#cmbProceso').val();

    $.ajax({
        type: "POST",
        url: "php/c_despejeLinea.php",
        data: { id: id, pregunta: pregunta, respuesta: respuesta, modulo: modulo },
        
        success: function (r) {
            if (r == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Proceso exitoso.");
                refreshTable();
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
            }
        }
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#listarDespeje').DataTable().clear();
    $('#listarDespeje').DataTable().ajax.reload();
}