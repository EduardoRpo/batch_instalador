/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#linkCondicionesMedio').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir').show();

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
            { "data": "min", className: "centrado" },
            { "data": "max", className: "centrado"  },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }

        ]
    });
});

/* Ocultar */

$('#adTiempos').click(function (e) {
    e.preventDefault();
    $("#frmadTiempos").slideToggle();

    $('input:text[name=txtModulo]').hide();
    $('input:text[name=txtModulo]').css('grid-row-start', '3');

    $('#moduloCondiciones').show();
    $('#moduloCondiciones').css('grid-row-start', '2');

    $('#t_min').val('');
    $('#t_max').val('');
    cargarSelectorModulo();
});

function cargarSelectorModulo() {

    $.ajax({
        method: 'POST',
        url: 'php/c_condiciones.php',
        data: { operacion: "4" },

        success: function (response) {
            var info = JSON.parse(response);

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

/* Almacenar Registros */

$(document).ready(function () {
    $('#btnguardarCondiciones').click(function (e) {
        e.preventDefault();

        var modulo = $('#moduloCondiciones').val();
        var t_min = parseInt($('#t_min').val());
        var t_max = parseInt($('#t_max').val());
        var id = $('input:text[name=txtModulo]').attr('id');

        debugger;

        if (id == undefined) {
            if (modulo === null || isNaN(t_min) || isNaN(t_max)) {
                alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos.");
                return false;
            }

        } else if (t_min >= t_max) {
            alertify.set("notifier", "position", "top-right"); alertify.error("El tiempo Máximo debe ser mayor al tiempo Mínimo.");
            return false;
        } else {
            modulo = id;
        }

        $.ajax({
            type: "POST",
            url: "php/c_condiciones.php",
            data: { operacion: "3", modulo: modulo, t_min: t_min, t_max: t_max },

            success: function (r) {
                debugger;
                if (r === '1') {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                    refreshTable();
                } else {
                    alertify.set("notifier", "position", "top-right"); alertify.error("No Almacenado.");
                }
            }
        });
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    let id = $(this).parent().parent().children().first().text();

    $.ajax({
        method: 'POST',
        url: 'php/c_condiciones.php',
        data: { operacion: "5", id: id },

        success: function (response) {

            var info = JSON.parse(response);

            $("#frmadTiempos").show();
            $('#btnguardarCondiciones').html('Actualizar');

            $('input:text[name=txtModulo]').show();
            $('input:text[name=txtModulo]').css('grid-row-start', '2');

            $('#moduloCondiciones').hide();
            $('#moduloCondiciones').css('grid-row-start', '3');

            $('input:text[name=txtModulo]').attr('id', info.data[0].id_modulo);
            $('input:text[name=txtModulo]').val(info.data[0].modulo);
            $('#t_min').val(info.data[0].min);
            $('#t_max').val(info.data[0].max);

        },
        error: function (response) {
            console.log(response);
        }
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#listarCondiciones').DataTable().clear();
    $('#listarCondiciones').DataTable().ajax.reload();
}