/* Mostrar Menu seleccionadp */

$('.contenedor-menu .menu a').removeAttr('style');
$('#linkMateriaPrima').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir1').show();

/* Cargue de Parametros de Control en DataTable */

/* function cargarTablaFormulas(referencia) { */
$("#tblMateriaPrima").DataTable({
    destroy: true,
    scrollY: '50vh',
    scrollCollapse: true,
    paging: false,
    language: { url: 'admin_componentes/es-ar.json' },

    "ajax": {
        method: "POST",
        url: "php/c_materiaprima.php",
        data: { operacion: "1" },
    },

    "columns": [
        { "data": "referencia" },
        { "data": "nombre" },
        { "data": "alias" },
        { "defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
        { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }
    ]
});
/* } */

/* Ocultar */

$('#btnadicionarMateriaPrima').click(function (e) {
    e.preventDefault();

    $("#frmAdicionarMateriaPrima").slideToggle();
    $('#txtId').val('');
    $('#txtCodigo').val('');
    $('#txtMP').val('');
    $('#txtAlias').val('');
    $('#btnguardarMateriaPrima').html('Crear');
});


/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();
    debugger;
    let id = $(this).parent().parent().children().first().text();
    let confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_materiaprima.php',
                'data': { operacion: "2", id: id }
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    let referencia = $(this).parent().parent().children().first().text();
    let materiaprima = $(this).parent().parent().children().eq(1).text();
    let alias = $(this).parent().parent().children().eq(2).text();

    $('#frmAdicionarMateriaPrima').slideDown();
    $('#txtId').val(referencia);
    $('#txtCodigo').val(referencia);
    $('#txtMP').val(materiaprima);
    $('#txtAlias').val(alias);
    $('#btnguardarMateriaPrima').html('Actualizar');
});


/* Almacenar Registros */


$('#btnguardarMateriaPrima').click(function (e) {
    e.preventDefault();

    let ref = $('#txtCodigo').val();
    let materiaprima = $('#txtMP').val();
    let alias = $('#txtAlias').val();

    if (ref == '' || materiaprima == '' || alias == '') {
        alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos.");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "php/c_materiaprima.php",
         data: { operacion: 3, referencia: ref, materiaprima: materiaprima, alias: alias },

        success: function (r) {
            if (r == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Operación Exitosa.");
                refreshTable();
            } else if (r == 2) {
                alertify.set("notifier", "position", "top-right"); alertify.error("El número de referencia ya existe.");
            }
            else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
            }
        }
    })
});

/* Actualizar tabla */

function refreshTable(tabla) {
    $('#tblMateriaPrima').DataTable().clear();
    $('#tblMateriaPrima').DataTable().ajax.reload();
}
