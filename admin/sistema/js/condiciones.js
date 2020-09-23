let editar;

/* Mostrar Menu seleccionado */
$('.contenedor-menu .menu a').removeAttr('style');
$('#linkCondicionesMedio').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir').show();
cargarSelectorModulo();
/* Cargue de Parametros de Condiciones del medio */

$(document).ready(function () {
    $("#listarCondiciones").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_condiciones.php",
            data: { operacion: "1" },
        },

        "columns": [
            { "data": "id" },
            { "data": "modulo" },
            { "data": "t_min", className: "centrado" },
            { "data": "t_max", className: "centrado" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }

        ]
    });
});

//Cargar select modulo
function cargarSelectorModulo() {
    $.ajax({
        method: 'POST',
        url: 'php/c_condiciones.php',
        data: { operacion: 4 },

        success: function (response) {

            info = JSON.parse(response);

            let $select = $('#moduloCondiciones');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info.data, function (i, value) {
                $select.append('<option value ="' + value.id + '">' + value.modulo + '</option>');
            });
        },
        error: function (response) {
            console.log(response);
        }
    })
}


/* Mostrar objetos para adicionar modulo */

$('#adTiempos').click(function (e) {
    e.preventDefault();
    editar = 0;
    cargarSelectorModulo()
    $('#btnguardarCondiciones').html('Crear');
    $("#frmadTiempos").slideToggle();
    $('#t_min').val('');
    $('#t_max').val('');
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
                'url': 'php/c_condiciones.php',
                'data': { operacion: "2", id: id }
            });
            refreshTable();
            alertify.set("notifier", "position", "top-right"); alertify.success("Registro Eliminado.");
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    editar = 1;
    let id = $(this).parent().parent().children().first().text();
    let modulo = $(this).parent().parent().children().eq(1).text();
    let t_min = $(this).parent().parent().children().eq(2).text();
    let t_max = $(this).parent().parent().children().eq(3).text();

    $('#btnguardarCondiciones').html('Actualizar');
    $("#frmadTiempos").slideDown();
    $('input:text[name=txtModulo]').hide();
    $(`#moduloCondiciones option:contains(${modulo})`).attr('selected', true);
    $('#t_min').val(t_min);
    $('#t_max').val(t_max);

});

/* Almacenar Registros */

$(document).ready(function () {
    $('#btnguardarCondiciones').click(function (e) {
        e.preventDefault();

        var modulo = $('#moduloCondiciones').val();
        var t_min = parseInt($('#t_min').val());
        var t_max = parseInt($('#t_max').val());

        if (modulo === null || isNaN(t_min) || isNaN(t_max)) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos.");
            return false;
        } else if (t_min >= t_max) {
            alertify.set("notifier", "position", "top-right"); alertify.error("El tiempo Máximo debe ser mayor al tiempo Mínimo.");
            return false;
        }
        console.log(editar);
        debugger;
        $.ajax({
            type: "POST",
            url: "php/c_condiciones.php",
            data: { operacion: "3", editar: editar,id: modulo, t_min: t_min, t_max: t_max },

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
    $('#listarCondiciones').DataTable().clear();
    $('#listarCondiciones').DataTable().ajax.reload();
}