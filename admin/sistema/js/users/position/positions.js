let editar;

/* Mostrar Menu seleccionadp */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link_cargos').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_usuarios').show();

/* Cargue de Parametros de Control en DataTable */


/* Ocultar */

$('#adicionarCargo').click(function(e) {
    e.preventDefault();
    $("#frmadParametro").slideToggle();
    $('#txtId').val('');
    $('#txtCargo').val('');
    $('#guardarCargo').html('Crear');

});


/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function(e) {
    e.preventDefault();
    let id = $(this).parent().parent().children().eq(1).text();
    let cargo = $(this).parent().parent().children().eq(2).text();

    $('#txtId').val(id);
    $('#txtCargo').val(cargo);
    $('#frmadParametro').slideDown();
    $('#guardarCargo').html('Actualizar');
});


/* Borrar registros */

$(document).on('click', '.link-borrar', function(e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().eq(1).text();

    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function(r) {
        if (r) {
            $.ajax({
                url: `/api/deletePosition/${id}`,
                success: function(data) {
                    notificaciones(data)
                }
            });
        }
    });
});


/* Almacenar Registros */

$(document).ready(function() {
    $('#guardarCargo').click(function(e) {
        e.preventDefault();

        let id = $('#txtId').val();
        let cargo = $('#txtCargo').val();

        if (cargo == '') {
            alertify.set("notifier", "position", "top-right");
            alertify.error("ingrese todos los datos");
            return false();
        }

        $.ajax({
            type: "POST",
            url: '/api/savePosition',
            data: { id: id, cargo: cargo },

            success: function(data) {
                notificaciones(data)
            }
        });
    });
});


/* Actualizar tabla */

refreshTable = () => {
    $('#tblCargos').DataTable().clear();
    $('#tblCargos').DataTable().ajax.reload();
}