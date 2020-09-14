let editar;

/* Mostrar Menu seleccionado */
$('.contenedor-menu .menu a').removeAttr('style');
$('#link8').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir').show();

/* Cargue de Parametros de Condiciones del medio */

$(document).ready(function () {
    $("#listarTanques").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_tanques.php",
            data: { operacion: 1 },
        },

        "columns": [
            { "data": "id" },
            { "data": "capacidad", className: "centrado", render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>", className: "centrado" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>", className: "centrado" }

        ]
    });
});

/* Adicionar Tanques */

$('#adTanques').click(function (e) {
    e.preventDefault();
    editar = 0;
    $("#frmadParametro").slideToggle();
    $('#txtid_tanques').val('');
    $('#btnguardarTanques').html('Crear');
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
                'url': 'php/c_tanques.php',
                'data': { operacion: 2, id: id }
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
    let capacidad = $(this).parent().parent().children().eq(1).text();
    
    $('#btnguardarTanques').html('Actualizar');
    $('#frmadParametro').slideDown();
    $('#txtid_tanques').val(id).hide;
    $('#txtCapacidad').val(capacidad);
});


/* Almacenar Registros */

$(document).ready(function () {
    $('#btnguardarTanques').click(function (e) {
        e.preventDefault();

        let id = $('#txtid_tanques').val();
        let capacidad = $('#txtCapacidad').val();
        debugger;
        $.ajax({
            type: "POST",
            url: "php/c_tanques.php",
            data: { operacion: 3, editar: editar, id: id, capacidad: capacidad },

            success: function (r) {
                if (r == 1) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                    refreshTable();
                } else if (r == 2) {
                    alertify.set("notifier", "position", "top-right"); alertify.error("El Tanque ya existe.");
                } else if (r == 3) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Registro actualizado.");
                    refreshTable();
                } else {
                    alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
                }
            }
        });
        //return false;
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#listarTanques').DataTable().clear();
    $('#listarTanques').DataTable().ajax.reload();
}