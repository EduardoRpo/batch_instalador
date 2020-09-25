let editar;

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

    editar = 0;

    $("#frmadParametro").slideToggle();
    $('#txtid_Proceso').val('');
    $('#btnguardarModulos').html('Crear');
    $('#txtProceso').val('');

});


/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();

    const id = $(this).parent().parent().children().first().text();
    let confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_modulos.php',
                'data': { operacion: 2, id: id },

                success: function (data) {

                    if (data == 1) {
                        alertify.set("notifier", "position", "top-right"); alertify.success("Operación exitosa");
                        refreshTable();
                    } else {
                        alertify.set("notifier", "position", "top-right"); alertify.error("El proceso se encuentra relacionado con uno o más procesos y no es posible eliminarlo");
                    }
                }
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().first().text();
    let proceso = $(this).parent().parent().children().eq(1).text();
    editar = 1;

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
            data: { operacion: 3, id: id, proceso: proceso, editar: editar },

            success: function (r) {
                if (r == 1) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Agregado con éxito.");
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
    $('#tblModulos').DataTable().clear();
    $('#tblModulos').DataTable().ajax.reload();
}