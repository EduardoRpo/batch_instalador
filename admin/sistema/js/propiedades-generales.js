
var tablaBD;
var id_tbl;
var editar;

/* Mostrar Menu seleccionado */
$('.contenedor-menu .menu a').removeAttr('style');
$('.contenedor-menu .menu ul.abrir1').show();
$('#linkGenerales').css('text-decoration', 'revert')

/* Ocultar tablas Propiedades Generales */

$(document).ready(function () {

    for (i = 1; i < 10; i++) {
        $(`#${i}`).hide();

    }
})

/* Mostrar cada parametro */

function parametros(tabla, id) {
    $(`#${id}`).toggle();

    for (let i = 1; i < 10; i++) {
        if (id != i) {
            $(`#${i}`).slideUp();
        }
    }

    id_tbl = id;
    id = $(`#tbl${id}`);
    tablaBD = tabla;

    cargarTablas(id, tabla);
}



/* Cargue de Nombre Productos*/

function cargarTablas(id, tabla) {
    $(id).DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_propiedades-generales.php",
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
    $(`#frmAdicionar${id}`).slideToggle();
    $(`#txt${id}`).val('');
    $(`#input${id}`).val('');
    editar = false;
}

/* Almacenar Registros */

function guardarDatosGenerales(nombre, id) {
    let datos = $(`#input${id}`).val();
    debugger;
    if (editar) {
        id_registro = $(`#txt${id_tbl}`).val();
        data = { datos: datos, id: id_registro, tabla: nombre, operacion: 2 };
    } else
        data = { datos: datos, tabla: nombre, operacion: 2 };


    $.ajax({
        type: "POST",
        url: "php/c_propiedades-generales.php",
        data: data,

        success: function (r) {
            if (r == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                refreshTable(id);
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("No Almacenado");
            }
        }
    });
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
                'url': 'php/c_propiedades-generales.php',
                'data': { operacion: "4", id: id, tabla: tablaBD }
            });
            refreshTable(id_tbl);
            alertify.success('Registro Eliminado');
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    editar = true;
    let id = $(this).parent().parent().children().first().text();

    $.ajax({
        method: 'POST',
        url: 'php/c_propiedades-generales.php',
        data: { operacion: "3", id: id, tabla: tablaBD },

        success: function (response) {
            var info = JSON.parse(response);

            $(`#frmAdicionar${id_tbl}`).slideDown();
            $(`#input${id_tbl}`).val(info.data[0].nombre);
            $(`#txt${id_tbl}`).val(info.data[0].id);

        },
        error: function (response) {
            console.log(response);
        }
    });
});


/* Actualizar tabla */

function refreshTable(id) {
    $(`#tbl${id}`).DataTable().clear();
    $(`#tbl${id}`).DataTable().ajax.reload();
}