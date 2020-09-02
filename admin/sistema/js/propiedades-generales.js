
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
    debugger;
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
    $(`.tabla${id}`).html('Crear');
    $(`#txt${id}`).val('');
    $(`#input${id}`).val('');
    $(`#min${id}`).val('');
    $(`#max${id}`).val('');
    editar = false;
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

    editar = true;

    let id = $(this).parent().parent().children().first().text();
    let nombre = $(this).parent().parent().children().eq(1).text();

    $(`#frmAdicionar${id_tbl}`).slideDown();
    $(`.tabla${id_tbl}`).html('Actualizar');
    $(`#txt-Id${id_tbl}`).val(id);

    if (id_tbl === 4 || id_tbl === 5 || id_tbl === 6 || id_tbl === 8) {
        var res = nombre.split(" - ");
        $(`#min${id_tbl}`).val(res[0]);
        $(`#max${id_tbl}`).val(res[1]);

    } else
        $(`#input${id_tbl}`).val(nombre);

});


/* Almacenar Registros */

function guardarDatosGenerales(nombre, id) {
    let datos = $(`#input${id}`).val();

    if (!datos) {
        alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos");
        return false;
    }

    if (editar) {
        id_registro = $(`#txt-id${id_tbl}`).val();
        data = { datos: datos, id_registro: id_registro, tabla: nombre, operacion: 3 };
    } else
        data = { datos: datos, tabla: nombre, operacion: 3 };

    $.ajax({
        type: "POST",
        url: "php/c_propiedades-generales.php",
        data: data,

        success: function (r) {

            if (r == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Operación exitosa.");
                refreshTable(id);
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error");
            }
        }
    });
}

/* Almacenar Registros */

function guardarDatosGeneralesMinMax(nombre, id) {

    let min = parseInt($(`#min${id}`).val());
    let max = parseInt($(`#max${id}`).val());

    if (max < min) {
        alertify.set("notifier", "position", "top-right"); alertify.error("El valor mínimo no puede ser mayor al valor máximo");
        return false;
    } else if (isNaN(min) || isNaN(max)) {
        alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos");
        return false;
    }

    if (editar) {
        id_registro = $(`#txt-id${id_tbl}`).val();
        data = { min: min, max: max, id_registro: id_registro, tabla: nombre, operacion: 4 };
    } else
        data = { min: min, max: max, tabla: nombre, operacion: 4 };

    $.ajax({
        type: "POST",
        url: "php/c_propiedades-generales.php",
        data: data,

        success: function (r) {

            if (r == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Operación exitosa.");
                refreshTable(id);
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error");
            }
        }
    });
}


/* Actualizar tabla */

function refreshTable(id) {
    $(`#tbl${id}`).DataTable().clear();
    $(`#tbl${id}`).DataTable().ajax.reload();
}