/* Adicionar Equipos */

$('#adEquipos').click(function(e) {
    e.preventDefault();
    $("#frmadParametro").slideToggle();
    $('#btnguardarEquipos').html('Crear');
    $('#txtEquipo').val('');
});

const cargarSelectorLinea = () => {

    $.ajax({
        url: '/api/findEquipmentsByType',
        success: function(info) {
            let $select = $("#cmbTipo");
            $select.empty();

            $select.append('<option disabled selected>Seleccionar</option>');

            for (let i = 0; i < info.length; i++)
                $select.append(`<option>${info[i].tipo}</option>`);
        },
        error: function(response) {
            console.log(response);
        }
    })
}

cargarSelectorLinea();

/* Borrar registros */

$(document).on('click', '.link-borrar', function(e) {
    e.preventDefault();

    let id = this.id;

    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function(r) {
        if (r) {
            $.ajax({
                'url': `/api/deleteEquipments/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function(e) {
    e.preventDefault();
    let id = this.id
    let equipo = $(this).parent().parent().children().eq(1).text();
    let tipo = $(this).parent().parent().children().eq(2).text();

    $('#frmadParametro').slideDown();
    $('#btnguardarEquipos').html('Actualizar');

    $('#txtid_Equipo').val(id);
    $('#txtEquipo').val(equipo);
    $(`#cmbTipo option:contains(${tipo})`).prop('selected', true);
});


/* Almacenar Registros */

$(document).ready(function() {
    $('#btnguardarEquipos').click(function(e) {
        e.preventDefault();

        let id = $('#txtid_Equipo').val();
        let equipo = $('#txtEquipo').val();
        let tipo = $('#cmbTipo').val();

        if (equipo == '' || tipo == null) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Ingrese todos los datos");
            return false();
        }

        $.ajax({
            type: "POST",
            url: "/api/saveEquipment",
            data: { id: id, equipo: equipo, tipo: tipo },

            success: function(data) {
                notificaciones(data)
            }
        });
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#listarEquipos').DataTable().clear();
    $('#listarEquipos').DataTable().ajax.reload();
}