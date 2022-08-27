/* Adicionar Tanques */

$('#adTanques').click(function(e) {
    e.preventDefault();
    $("#frmadParametro").slideToggle();
    $('#txtid_tanques').val('');
    $('#btnguardarTanques').html('Crear');
});


/* Borrar registros */

$(document).on('click', '.link-borrar', function(e) {
    e.preventDefault();

    let id = this.id;
    let confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function(r) {
        if (r) {
            $.ajax({
                'url': `/api/deletetanks/${id}`,
                success: function(data) {
                    notificaciones(data);
                }
            });
        }

    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function(e) {
    e.preventDefault();

    let id = this.id;
    let capacidad = $(this).parent().parent().children().eq(1).text();

    $('#btnguardarTanques').html('Actualizar');
    $('#frmadParametro').slideDown();
    $('#txtid_tanques').val(id).hide;
    $('#txtCapacidad').val(capacidad);
});


/* Almacenar Registros */

$(document).ready(function() {
    $('#btnguardarTanques').click(function(e) {
        e.preventDefault();

        let id = $('#txtid_tanques').val();
        let capacidad = $('#txtCapacidad').val();

        $.ajax({
            type: "POST",
            url: "/api/savetanks",
            data: { id: id, capacidad: capacidad },

            success: function(data) {
                notificaciones(data)
            }
        });
        //return false;
    });
});


/* Actualizar tabla */

refreshTable = () => {
    $('#listarTanques').DataTable().clear();
    $('#listarTanques').DataTable().ajax.reload();
}