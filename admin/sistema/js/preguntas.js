let editar;

/* Mostrar Menu seleccionado */
$('.contenedor-menu .menu a').removeAttr('style');
$('#linkPreguntas').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir').show();


/* Cargue de Preguntas en DataTable */

$(document).ready(function () {
    $("#tblPreguntas").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_preguntas.php",
            data: { operacion: "1" },
        },

        "columns": [
            { "data": "id" },
            { "data": "pregunta" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }

        ]
    });
});

/* Mostrar formulario adicionar preguntas */

$('#adicionarParametro').click(function (e) {
    e.preventDefault();
    editar = 0;
    $("#frmadicionarPregunta").slideToggle();
    $('#txtIdPregunta').val('');
    $('#txtPregunta').val('');
    $('#btnAlmacenarPregunta').html('Crear');
});


/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    editar = 1;
    let id = $(this).parent().parent().children().first().text();
    let pregunta = $(this).parent().parent().children().eq(1).text();

    $('#frmadicionarPregunta').slideDown();
    $('#btnAlmacenarPregunta').html('Actualizar');

    $('#txtIdPregunta').val(id);
    $('#txtPregunta').val(pregunta);
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
                'url': 'php/c_preguntas.php',
                'data': { operacion: "2", id: id }
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});


/* Almacenar Registros */

$('#btnAlmacenarPregunta').click(function (e) {
    e.preventDefault();


    let id = $('#txtIdPregunta').val();
    let pregunta = $('#txtPregunta').val();

    $.ajax({
        type: "POST",
        url: "php/c_preguntas.php",
        data: { operacion: 3, editar: editar, id: id, pregunta: pregunta },

        success: function (r) {

            if (r == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                refreshTable();
            } else if (r == 2) {
                alertify.set("notifier", "position", "top-right"); alertify.error("La pregunta ya existe.");
            } else if (r == 3) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Registro actualizado.");
                refreshTable();
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
            }
        }
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#tblPreguntas').DataTable().clear();
    $('#tblPreguntas').DataTable().ajax.reload();
}