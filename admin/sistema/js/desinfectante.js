let editar;
/* Mostrar Menu seleccionadp */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link_desinfectante').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_generales').show();


/* Cargue de Parametros de Condiciones del medio */

$(document).ready(function () {
    $("#listarDesinfectante").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_desinfectante.php",
            data: { operacion: "1" },
        },

        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "concentracion" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }

        ]
    });
});

/* Ocultar */

$('#adDesinfectante').click(function (e) {
    e.preventDefault();
    editar = 0;
    $('#id_desinfectante').val('');
    $('#desinfectante').val('');
    $('#concentracion').val('');
    $('#btnguardarDesinfectante').html('Crear');
    $("#frmadParametro").slideToggle();

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
                'url': 'php/c_desinfectante.php',
                'data': { operacion: "2", id: id }
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    editar = 1;
    let id = $(this).parent().parent().children().first().text();
    let desinfectante = $(this).parent().parent().children().eq(1).text();
    let concentracion = $(this).parent().parent().children().eq(2).text();

    $('#btnguardarDesinfectante').html('Actualizar');
    $('#frmadParametro').slideDown();
    $('#id_desinfectante').val(id);
    $('#desinfectante').val(desinfectante);
    $('#concentracion').val(concentracion);

});


/* Almacenar Registros */

$(document).ready(function () {
    $('#btnguardarDesinfectante').click(function (e) {
        e.preventDefault();

        let id = $('#id_desinfectante').val();
        let desinfectante = $('#desinfectante').val();
        let concentracion = $('#concentracion').val();

        if (desinfectante == '' || concentracion == '') {
            alertify.set("notifier", "position", "top-right"); alertify.error("ingrese todos los datos");
            return false();
        }

        $.ajax({
            type: "POST",
            url: "php/c_desinfectante.php",
            data: { operacion: 3, editar: editar, id: id, desinfectante: desinfectante, concentracion: concentracion },

            success: function (r) {
                if (r == 1) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                    refreshTable();
                } else if (r == 2) {
                    alertify.set("notifier", "position", "top-right"); alertify.error("Módulo ya existe.");
                } else if (r == 3) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Registros actualizado.");
                    refreshTable();
                } else {
                    alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
                }
            }
        });
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#listarDesinfectante').DataTable().clear();
    $('#listarDesinfectante').DataTable().ajax.reload();
}