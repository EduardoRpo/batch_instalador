/* Ocultar */

$('#adDesinfectante').click(function (e) {
    e.preventDefault();
    $('#id_desinfectante').val('');
    $('#desinfectante').val('');
    $('#concentracion').val('');
    $('#btnguardarDesinfectante').html('Crear');
    $("#frmadParametro").slideToggle();

});

/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();

    let id = this.id;
    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'url': `/api/deleteDisinfectant/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();

    let id =this.id;
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
            url: "/api/saveDisinfectant",
            data: { id: id, desinfectante: desinfectante, concentracion: concentracion },

            success: function (data) {
                notificaciones(data);
                
            }
        });
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#listarDesinfectante').DataTable().clear();
    $('#listarDesinfectante').DataTable().ajax.reload();
}