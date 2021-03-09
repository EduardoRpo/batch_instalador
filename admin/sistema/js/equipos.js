
cargarSelectorLinea();

/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link_equipos').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_generales').show();

/* Cargue de Equipos*/

$(document).ready(function () {
    tabla = $("#listarEquipos").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_maquinaria.php",
            data: { operacion: 1 },
        },

        "columns": [
            { "data": "id", className: "centrado" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" },
            { "data": "descripcion" },
            { "data": "tipo" },
        ]
    });
    /* Enumera los registros en la tabla */

    tabla.on('order.dt search.dt', function () {
        tabla.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
});



/* Adicionar Equipos */

$('#adEquipos').click(function (e) {
    e.preventDefault();
    $("#frmadParametro").slideToggle();
    $('#btnguardarEquipos').html('Crear');
    $('#txtEquipo').val('');
    cargarSelectorLinea();
});

function cargarSelectorLinea() {

    $.ajax({
        method: 'POST',
        url: 'php/c_maquinaria.php',
        data: { operacion: 2 },

        success: function (response) {
            var info = JSON.parse(response);

            let $select = $('#cmbTipo');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info.data, function (i, value) {
                $select.append('<option value ="' + value.tipo + '">' + value.tipo + '</option>');
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

    let id = $(this).parent().parent().children().eq(2).text();

    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_maquinaria.php',
                'data': { operacion: 3, id }
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    let id = $(this).parent().parent().children().eq(2).text();
    let equipo = $(this).parent().parent().children().eq(2).text();
    let tipo = $(this).parent().parent().children().eq(3).text();

    $('#frmadParametro').slideDown();
    $('#btnguardarEquipos').html('Actualizar');

    $('#txtid_Equipo').val(id);
    $('#txtEquipo').val(equipo);
    $(`#cmbTipo option:contains(${tipo})`).prop('selected', true);
});


/* Almacenar Registros */

$(document).ready(function () {
    $('#btnguardarEquipos').click(function (e) {
        e.preventDefault();

        let id = $('#txtid_Equipo').val();
        let equipo = $('#txtEquipo').val();
        let tipo = $('#cmbTipo').val();

        if (equipo == '' || tipo == null) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos");
            return false();
        }

        $.ajax({
            type: "POST",
            url: "php/c_maquinaria.php",
            data: { operacion: 4, id, equipo, tipo },

            success: function (r) {
                if (r == 1) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                    refreshTable();
                } else if (r == 2) {
                    alertify.set("notifier", "position", "top-right"); alertify.error("El Equipo ya existe.");
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
    $('#listarEquipos').DataTable().clear();
    $('#listarEquipos').DataTable().ajax.reload();
}