/* Mostrar Menu seleccionadp */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link6').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir').show();

/* Cargue de Parametros de Control en DataTable */

$(document).ready(function () {
    $("#tblModulos").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_modulos.php",
            data: { operacion: 1 },
        },

        "columns": [
            { "data": "id" },
            { "data": "modulo" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }

        ]
    });
});

/* Adicionar Proceso */

$('#adProceso').click(function (e) {
    e.preventDefault();
    $("#frmadParametro").slideToggle();

    $('#txtid_Proceso').val('');
    $('#btnguardarModulos').html('Crear');
    $('#txtProceso').val('');

});


/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().first().text();
    let confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_modulos.php',
                'data': { operacion: 2, id: id }
            });
            refreshTable();
            alertify.set("notifier", "position", "top-right"); alertify.success("Registro Eliminado");
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().first().text();
    let proceso = $(this).parent().parent().children().eq(1).text();

    $('#frmadParametro').slideDown();
    $('#btnguardarModulos').html('Actualizar');

    $('#txtid_Proceso').val(id);
    $('#txtProceso').val(proceso);

});


/* Almacenar Registros */

$(document).ready(function () {
    $('#btnguardarModulos').click(function (e) {
        e.preventDefault();
        let id = $('#txtid_Proceso').val();
        let proceso = $('#txtProceso').val();

        $.ajax({
            type: "POST",
            url: "php/c_modulos.php",
            data: { operacion: 3, id: id, proceso: proceso },

            success: function (r) {
                if (r == 1) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Agregado con éxito.");
                    refreshTable();
                } else {
                    alertify.set("notifier", "position", "top-right"); alertify.error("Usuario No Registrado.");
                }
            }
        });
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#tblModulos').DataTable().clear();
    $('#tblModulos').DataTable().ajax.reload();
}