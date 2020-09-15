let editar;
cargarselectores('cargo');
cargarselectores('modulo');

/* Mostrar Menu seleccionado */
$('.contenedor-menu .menu a').removeAttr('style');
$('#link16').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir2').show();

//Cargue de datos Tabla Usuarios

$(document).ready(function () {
    $("#listaUsuarios").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_usuarios.php",
            data: { operacion: "1" },
        },

        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "apellido" },
            { "data": "email" },
            { "data": "cargo" },
            { "data": "modulo" },
            /* {"defaultContent": "<a href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a>"}, */
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }
        ]
    });
});

//cargar selects Cargo y Modulos

function cargarselectores(selector) {

    $.ajax({
        method: 'POST',
        url: 'php/c_productos.php',
        data: { tabla: selector, operacion: 4 },

        success: function (response) {
            var info = JSON.parse(response);
            let $select = $(`#${selector}`);

            $select.empty();
            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            if (selector == 'cargo') {
                $.each(info.data, function (i, value) {
                    $select.append('<option value ="' + value.id + '">' + value.cargo + '</option>');
                });
            } else {
                $.each(info.data, function (i, value) {
                    $select.append('<option value ="' + value.id + '">' + value.modulo + '</option>');
                });
            }

        },
        error: function (response) {
            console.log(response);
        }
    });
}


//Crear usuarios
$('#btnCrearUsuarios').click(function () {
    editar = 0;
    $('#ModalCrearUsuarios').modal('show');

    $('#nombres').val('');
    $('#apellidos').val('');
    $('#email').val('');
    $('#cargo').val('');
    $('#modulo').val('');

});


//Almacenar los usuarios

$(document).ready(function () {
    $('#btnguardarUsuarios').click(function (e) {
        e.preventDefault();

        const usuario = new FormData($('#frmagregarUsuarios')[0]);
        usuario.set('operacion', 3);
        usuario.set('editar', editar);

        $.ajax({
            type: "POST",
            url: "php/c_usuarios.php",
            data: usuario,
            processData: false,
            contentType: false,

            success: function (r) {
                if (r == 1) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Almacenado con éxito.");
                    refreshTable();
                } else if (r == 2) {
                    alertify.set("notifier", "position", "top-right"); alertify.error("El usuario ya existe.");
                } else if (r == 3) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Usuario actualizado.");
                    refreshTable();
                } else {
                    alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
                }
                $('#ModalCrearUsuarios').modal('hide');
            }
        });
        return false;
    });
});


/* evento click para actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    editar = 1;
    let id = $(this).parent().parent().children().first().text();
    let nombres = $(this).parent().parent().children().eq(1).text();
    let apellidos = $(this).parent().parent().children().eq(2).text();
    let email = $(this).parent().parent().children().eq(3).text();
    let cargo = $(this).parent().parent().children().eq(4).text();
    let modulo = $(this).parent().parent().children().eq(5).text();

    $('#ModalCrearUsuarios').modal('show');
    $('#nombres').val(nombres);
    $('#apellidos').val(apellidos);
    $('#email').val(email);
    $('#cargo').val(cargo);
    $('#modulo').val(modulo);

});


/* evento click para borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().first().text();

    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este usuario?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_usuarios.php',
                'data': 'id',
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});

/* Actualizar tabla */

function refreshTable() {
    $('#listaUsuarios').DataTable().clear();
    $('#listaUsuarios').DataTable().ajax.reload();
}