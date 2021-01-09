let editar;

/* Mostrar Menu seleccionadp */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link_cargos').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_usuarios').show();

/* Cargue de Parametros de Control en DataTable */

$(document).ready(function () {
    $("#tblCargos").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_cargos.php",
            data: { operacion: "1" },
        },

        "columns": [
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>", className: "centrado" },
            { "data": "id" },
            { "data": "cargo" },
        ]
    });
});

/* Ocultar */

$('#adicionarCargo').click(function (e) {
    e.preventDefault();
    editar = 0;
    $("#frmadParametro").slideToggle();
    $('#txtId').val('');
    $('#txtCargo').val('');
    $('#guardarCargo').html('Crear');

});


/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    editar = 1;
    let id = $(this).parent().parent().children().eq(1).text();
    let cargo = $(this).parent().parent().children().eq(2).text();
    
    $('#txtId').val(id);
    $('#txtCargo').val(cargo);
    $('#frmadParametro').slideDown();
    $('#guardarCargo').html('Actualizar');
});


/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().eq(1).text();

    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_cargos.php',
                'data': { operacion: "2", id: id }
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});

/* Almacenar Registros */

$(document).ready(function () {
    $('#guardarCargo').click(function (e) {
        e.preventDefault();

        let id = $('#txtId').val();
        let cargo = $('#txtCargo').val();

        if (cargo == '') {
            alertify.set("notifier", "position", "top-right"); alertify.error("ingrese todos los datos");
            return false();
        }

        $.ajax({
            type: "POST",
            url: "php/c_cargos.php",
            data: { operacion: 3, editar: editar, id: id, cargo: cargo },

            success: function (r) {
                if (r == 1) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                    refreshTable();
                } else if (r == 2) {
                    alertify.set("notifier", "position", "top-right"); alertify.error("El cargo ya existe.");
                } else if (r == 3) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Registro actualizado.");
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
    $('#tblCargos').DataTable().clear();
    $('#tblCargos').DataTable().ajax.reload();
}
