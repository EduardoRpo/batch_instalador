var tabla;
var editar;

/* Mostrar Menu seleccionadp */

$('.contenedor-menu .menu a').removeAttr('style');
$('#linkPreparaciones').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir1').show();

/* Cargue select referencias */

//function cargarSelectorModulo() {

$.ajax({
    method: 'POST',
    url: 'php/c_instructivo.php',
    data: { operacion: "1" },

    success: function (response) {

        var info = JSON.parse(response);
        let $selectProductos = $('#cmbReferenciaProductos');

        $selectProductos.empty();
        $selectProductos.append('<option disabled selected>' + "Seleccionar" + '</option>');

        $.each(info.data, function (i, value) {
            $selectProductos.append('<option value ="' + value.referencia + '">' + value.referencia + '</option>');
        });
    },
    error: function (response) {
        console.log(response);
    }
});
//}


/* Cargar nombre de producto de acuerdo con Seleccion Referencia */

$('#cmbReferenciaProductos').change(function (e) {
    e.preventDefault();
    let seleccion = $("select option:selected").val();

    $.ajax({
        type: "POST",
        url: "php/c_instructivo.php",
        data: { operacion: "2", referencia: seleccion },

        success: function (response) {
            var info = JSON.parse(response);
            $('#txtnombreProducto').val('');
            $('#txtnombreProducto').val(info.data[0].nombre_referencia);
        }
    });

    cargarTablaFormulas(seleccion);
});


/* Cargue de Parametros de Control en DataTable */

function cargarTablaFormulas(referencia) {
    tabla = $("#tblInstructivo").DataTable({

        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_instructivo.php",
            data: { operacion: "3", referencia: referencia },
        },

        "columns": [
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" },
            /* { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }, */
            { "data": "id" },
            { "data": "proceso" },
            { "data": "tiempo", className: "centrado", },
        ],
        columnDefs: [
            { width: "10%", "targets": 0 },
        ]
    });
}

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
    const id = $(this).parent().parent().children().eq(1).text();
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
        url: "php/c_instructivo.php",
        data: {
            operacion: 4,
            editar: editar,
            referencia: referencia,
            id: id,
            actividad: actividad,
            tiempo: tiempo
        },

        success: function (r) {
            if (r == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                refreshTable();
            } else if (r == 2) {
                alertify.set("notifier", "position", "top-right"); alertify.error("Actividad ya existe.");
            } else if (r == 3) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Registro actualizado.");
                refreshTable();
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
            }
        }
    });
}

/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();
    debugger;
    let id = $(this).parent().parent().children().eq(1).text();

    let confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_instructivo.php',
                'data': { operacion: 5, id: id }
            });
            refreshTable();
            alertify.set("notifier", "position", "top-right"); alertify.success("Eliminado");
        }
    });
});

/* Actualizar tabla */

function refreshTable(tabla) {
    $('#tblInstructivo').DataTable().clear();
    $('#tblInstructivo').DataTable().ajax.reload();
}