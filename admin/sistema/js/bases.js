var tabla;
var editar;

/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('.contenedor-menu .menu ul.menu_productos').show();
$('.contenedor-menu .menu ul.menu_productos ul.menu_instructivos').show();
$('#link_bases').css('text-decoration', 'revert')

/* Cargue select referencias */

$.ajax({
    method: 'POST',
    url: 'php/c_bases.php',
    data: { operacion: "1" },

    success: function (response) {

        var info = JSON.parse(response);
        let $selectProductos = $('#cmbReferenciaProductos');

        $selectProductos.empty();
        $selectProductos.append('<option disabled selected>' + "Seleccionar" + '</option>');

        $.each(info.data, function (i, value) {
            $selectProductos.append('<option value ="' + value.id + '">' + value.nombre + '</option>');
        });
    },
    error: function (response) {
        console.log(response);
    }
});

/* Cargue de Parametros de Control en DataTable */

//function cargarTablaFormulas(referencia) {
$('#cmbReferenciaProductos').change(function (e) {
    e.preventDefault();
    let referencia = $("select option:selected").val();

    tabla = $("#tabla_bases_instructivo").DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_bases.php",
            data: { operacion: 2, referencia },
        },

        "columns": [
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" },
            { "data": "id" },
            { "data": "pasos" },
            { "data": "tiempo", className: "centrado", },
        ],

        columnDefs: [{ width: "10%", "targets": 0 },],

    });

    tabla.on('order.dt search.dt', function () {
        tabla.column(1, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
});



/* Ocultar */

$('#adicionarInstructivo').click(function (e) {
    e.preventDefault();

    editar = 0;
    $("#frmadInstructivo").slideToggle();
    $('#txtActividad').val('');
    $('#txtTiempo').val('');
    $('#txtguardarInstructivo').html('Crear');

});


/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();

    editar = 1;
    const id = $(this).parent().parent().children().eq(2).text();
    const actividad = $(this).parent().parent().children().eq(2).text();
    const tiempo = $(this).parent().parent().children().eq(3).text();

    $("#frmadInstructivo").slideDown();
    $('#txtguardarInstructivo').html('Actualizar');
    $('#txtId').val(id);
    $('#txtActividad').val(actividad);
    $('#txtTiempo').val(tiempo);

});


/* Almacenar Registros */

function guardarInstructivo() {
    let id = $('#txtId').val();
    let referencia = $('#cmbReferenciaProductos').val();
    let actividad = $('#txtActividad').val();
    let tiempo = $('#txtTiempo').val();

    if (referencia === null || actividad == '' || tiempo == '') {
        alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos.");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "php/c_bases.php",
        data: { operacion: 4, editar, referencia, actividad, tiempo, id },

        success: function (r) {
            if (r == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                refreshTable();
                limpiar_campos();
            } else if (r == 2) {
                alertify.set("notifier", "position", "top-right"); alertify.error("Actividad ya existe.");
            } else if (r == 3) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Registro actualizado.");
                refreshTable();
                limpiar_campos();
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
            }
        }
    });
}

/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();
    let referencia = $('#cmbReferenciaProductos').val();
    let id = $(this).parent().parent().children().eq(2).text();
             
    let confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_bases.php',
                'data': { operacion: 5, id, referencia }
            });
            refreshTable();
            alertify.set("notifier", "position", "top-right"); alertify.success("Eliminado");
        }
    });
});

/* Actualizar tabla */

function refreshTable(tabla) {
    $('#tabla_bases_instructivo').DataTable().clear();
    $('#tabla_bases_instructivo').DataTable().ajax.reload();
}

function limpiar_campos() {
    $('#txtActividad').val('');
    $('#txtTiempo').val('');
}