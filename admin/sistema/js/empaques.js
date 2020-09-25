
var tablaBD;
var id_tbl;
var editar;

/* Mostrar Menu seleccionado */
$('.contenedor-menu .menu a').removeAttr('style');
$('.contenedor-menu .menu ul.abrir1').show();
$('#linkEmpaques').css('text-decoration', 'revert')

/* Ocultar tablas Propiedades Generales */

$(document).ready(function () {

    for (i = 1; i < 6; i++) {
        $(`#${i}`).hide();

    }
})

/* Mostrar cada parametro */

function parametros(tabla, id) {

    $(`#${id}`).toggle();

    for (let i = 1; i < 6; i++) {
        if (id != i) {
            $(`#${i}`).slideUp();
        }
    }

    id_tbl = id;
    id = $(`#tbl${id}`);
    tablaBD = tabla;

    cargarTablas(id, tabla);
}

/* Cargue de Tablas envase*/

function cargarTablas(id, tabla) {

    $(id).DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_empaques.php",
            data: { tabla: tabla, operacion: 1 },
        },

        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a>", className: "centrado" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>", className: "centrado" }

        ]
    });
};


/* Mostrar elementos para adicionar registros en las diferentes tablas */

function adicionar(id) {

    editar = 0;
    $(`#frmAdicionar${id}`).slideToggle();
    $('.btnguardar').html('Crear');
    $(`#txt-Id${id}`).val('');
    $(`#codigo${id}`).val('');
    $(`#input${id}`).val('');

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
                'url': 'php/c_empaques.php',
                'data': { operacion: 2, id: id, tabla: tablaBD }
            });
            refreshTable(id_tbl);
            alertify.success('Registro Eliminado');
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    editar = 1;

    let codigo = $(this).parent().parent().children().first().text();
    let nombre = $(this).parent().parent().children().eq(1).text();

    $(`#frmAdicionar${id_tbl}`).slideDown();
    $('.btnguardar').html('Actualizar');

    $(`#txt-Id${id_tbl}`).val(codigo);
    $(`#codigo${id_tbl}`).val(codigo);
    $(`#input${id_tbl}`).val(nombre);
});


/* Almacenar Registros */

function guardarDatosGenerales(nombre, id) {

    let cod = $(`#txt-Id${id}`).val();
    let codigo = $(`#codigo${id}`).val();
    let descripcion = $(`#input${id}`).val();

    if (!codigo || !nombre) {
        alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "php/c_empaques.php",
        data: { operacion: 3, editar: editar, nombre: nombre, id: cod, codigo: codigo, descripcion: descripcion },

        success: function (r) {

            if (r == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                refreshTable(id);
            } else if (r == 2) {
                alertify.set("notifier", "position", "top-right"); alertify.error("Código ya existe.");
            } else if (r == 3) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Registro actualizado.");
                refreshTable(id);
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
            }
        }
    });
}


/* Actualizar tabla */

function refreshTable(id) {
    $(`#tbl${id}`).DataTable().clear();
    $(`#tbl${id}`).DataTable().ajax.reload();
}