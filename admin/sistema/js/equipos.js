let editar;
cargarSelectorLinea();

/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link_equipos').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.menu_generales').show();

/* Cargue de Equipos*/

$(document).ready(function () {
    $("#listarEquipos").DataTable({
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
            { "data": "id" },
            { "data": "maquina" },
            { "data": "nombre" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }
        ]
    });
});

/* Adicionar Equipos */

$('#adEquipos').click(function (e) {
    e.preventDefault();
    editar = 0;
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

            let $select = $('#cmbLinea');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info.data, function (i, value) {
                $select.append('<option value ="' + value.id + '">' + value.linea + '</option>');
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
                'url': 'php/c_maquinaria.php',
                'data': { operacion: 3, id: id }
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
    let nombre = $(this).parent().parent().children().eq(1).text();
    let linea = $(this).parent().parent().children().eq(2).text();

    $('#frmadParametro').slideDown();
    $('#btnguardarEquipos').html('Actualizar');

    $('#txtid_Equipo').val(id);
    $('#txtEquipo').val(nombre);
    $(`#cmbLinea option:contains(${linea})`).prop('selected', true);
});


/* Almacenar Registros */

$(document).ready(function () {
    $('#btnguardarEquipos').click(function (e) {
        e.preventDefault();

        let id = $('#txtid_Equipo').val();
        let equipo = $('#txtEquipo').val();
        let linea = $('#cmbLinea').val();

        if (equipo == '' || linea == null) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos");
            return false();
        }

        $.ajax({
            type: "POST",
            url: "php/c_maquinaria.php",
            data: { operacion: 4, editar: editar, id: id, equipo: equipo, linea: linea },

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