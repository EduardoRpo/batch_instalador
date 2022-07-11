let id;
let editar;
let archivo;

cargarselectores("cargos");
cargarselectores("modulo");

/* Mostrar Menu seleccionado */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_menu_usuarios").css("background", "coral");
$(".contenedor-menu .menu ul.menu_usuarios").show();

//Cargue de datos Tabla Usuarios

$(document).ready(function() {
    $("#listaUsuarios").DataTable({
        scrollCollapse: true,
        paging: false,
        language: { url: "admin_componentes/es-ar.json" },

        ajax: {
            method: "POST",
            url: "php/c_usuarios.php",
            data: { operacion: "1" },
        },

        columns: [{
                defaultContent: "<a href='#' <i class='fas fa-users-cog link-inactivar' title='Inactivar/Activar' style='color: lightslategrey;'></i></a><a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Editar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
            },
            { data: "id" },
            { data: "nombre" },
            { data: "apellido" },
            { data: "email" },
            { data: "cargo" },
            { data: "modulo" },
            { data: "user" },
            {
                data: "rol",
                render: (data, type, row) => {
                    "use strict";
                    return data == 1 ?
                        "Superusuario" :
                        data == 2 ?
                        "Administrador" :
                        data == 3 ?
                        "Usuario" :
                        data == 4 ?
                        "Usuario QC" :
                        "Desarrollo";
                },
            },
            {
                data: "estado",
                render: (data, type, row) => {
                    "use strict";
                    return data == 1 ? "Activo" : "Inactivo";
                },
            },
        ],
    });
});

//cargar selects Cargo y Modulos

function cargarselectores(selector) {
    $.ajax({
        url: `/api/getDataSelector/${selector}`,
        success: function(resp) {
            const $select = $(`#${selector}`);

            $select.empty();
            $select.append("<option disabled selected>Seleccionar</option>");

            if (selector == "cargos") {
                $.each(resp, function(i, value) {
                    $select.append(`<option value = ${value.id}>${value.cargo}</option>`);
                });
            } else {
                $.each(resp, function(i, value) {
                    $select.append(`<option value = ${value.id}>${value.modulo}</option>`);
                });
            }
        },
        error: function(response) {
            console.log(response);
        },
    });
}

//Crear usuarios
$("#btnCrearUsuarios").click(function() {
    editar = 0;
    $("#ModalCrearUsuarios").modal("show");
    $("#btnguardarUsuarios").html("Crear");
    $("#nombres").val("");
    $("#apellidos").val("");
    $("#email").val("");
    $("#cargo").val("");
    $("#modulo").val("");
    $("#usuario").val("");
    $("#clave").val("");
});

$("#rol").change(function(e) {
    e.preventDefault();
    let rol = $("#rol").val();
    if (rol == 1 || rol == 2 || rol == 5)
        $("#firma_y_modulo").css("display", "none");
    else $("#firma_y_modulo").css("display", "flex");
});

//Almacenar los usuarios

$(document).ready(function() {
    $("#btnguardarUsuarios").click(function(e) {
        e.preventDefault();

        let nombres = $("#nombres").val();
        let apellidos = $("#apellidos").val();
        let email = $("#email").val();
        let cargo = $("#cargo").val();
        let modulo = $("#modulo").val();
        let user = $("#usuario").val();
        let clave = $("#clave").val();
        let rol = $("#rol").val();

        if (rol == 1 || rol == 2 || rol == 5) {
            modulo = "1";
        }

        let datosIniciales =
            nombres.length *
            apellidos.length *
            cargo.length *
            modulo.length *
            user.length;

        if (editar == 1) {
            if (datosIniciales === 0) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todos los datos.");
                return false;
            }
        } else {
            if (datosIniciales == 0 || clave === "" || rol === null) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todos los datos.");
                return false;
            }
        }

        if (rol != 1 && rol != 2 && editar != 1 && rol != 5) {
            const archivo = $("#firma").val();
            let extensiones = archivo.substring(archivo.lastIndexOf("."));

            if (
                extensiones != ".jpg" &&
                extensiones != ".png" &&
                extensiones != ".JPG" &&
                extensiones != ".PNG"
            ) {
                alertify.set("notifier", "position", "top-right");
                alertify.error(`El archivo de tipo ${extensiones} no es válido`);
                $("#firma").val("");
                return false;
            }
        }

        const usuario = new FormData($("#frmagregarUsuarios")[0]);
        usuario.set("operacion", 3);
        usuario.set("editar", editar);
        usuario.set("id", id);

        if (rol == 1 || rol == 2 || rol == 5) usuario.set("modulo", "1");

        $.ajax({
            type: "POST",
            url: "php/c_usuarios.php",
            data: usuario,
            processData: false,
            contentType: false,

            success: function(r) {
                if (r == 1) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.success("Almacenado con éxito.");
                    $("#ModalCrearUsuarios").modal("hide");
                    refreshTable();
                } else if (r == 2) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("El usuario ya existe.");
                } else if (r == 3) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.success("Usuario actualizado.");
                    $("#ModalCrearUsuarios").modal("hide");
                    refreshTable();
                } else {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Error.");
                }
            },
        });
        return false;
    });
});

/* evento click para actualizar registros */

$(document).on("click", ".link-editar", function(e) {
    e.preventDefault();
    editar = 1;

    id = $(this).parent().parent().children().eq(1).text();
    let nombres = $(this).parent().parent().children().eq(2).text();
    let apellidos = $(this).parent().parent().children().eq(3).text();
    let email = $(this).parent().parent().children().eq(4).text();
    let cargo = $(this).parent().parent().children().eq(5).text();
    let modulo = $(this).parent().parent().children().eq(6).text();
    let usuario = $(this).parent().parent().children().eq(7).text();
    let rol = $(this).parent().parent().children().eq(8).text();

    $("#ModalCrearUsuarios").modal("show");
    $("#btnguardarUsuarios").html("Actualizar");
    $("#nombres").val(nombres);
    $("#apellidos").val(apellidos);
    $("#email").val(email);
    $("#cargo option:contains(" + cargo + ")").attr("selected", true);
    $("#modulo option:contains(" + modulo + ")").attr("selected", true);
    $("#rol option:contains(" + rol + ")").attr("selected", true);
    $("#usuario").val(usuario);
    $(`#firma`).val('');

    rol == "Superusuario" ?
        (id_rol = 1) :
        rol == "Administrador" ?
        (id_rol = 2) :
        rol == "Usuario" ?
        (id_rol = 3) :
        (id_rol = 4);

    $("#rol").val(id_rol);
    $("#rol").change();
});

/* evento click para borrar registros */

$(document).on("click", ".link-borrar", function(e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().eq(1).text();
    let confirm = alertify
        .confirm(
            "Samara Cosmetics",
            "¿Está seguro de eliminar este usuario?",
            null,
            null
        )
        .set("labels", { ok: "Si", cancel: "No" });

    confirm.set("onok", function(r) {
        if (r) {
            $.ajax({
                method: "POST",
                url: "php/c_usuarios.php",
                data: { id: id, operacion: 2 },
            });
            refreshTable();
            alertify.success("Registro Eliminado");
        }
    });
});

/* Inactivar Usuarios */

$(document).on("click", ".link-inactivar", function(e) {
    let idUser = $(this).parent().parent().children().eq(1).text();
    $.ajax({
        url: `/api/user/${idUser}`,
        type: "GET",
    }).done((data, status, xhr) => {
        if (data) {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Usuario Activado.");
        } else {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Usuario Inactivado.");
        }
        refreshTable();
    });
});

/* Actualizar tabla */

function refreshTable() {
    $("#listaUsuarios").DataTable().clear();
    $("#listaUsuarios").DataTable().ajax.reload();
    $("#firma").val("");
}

/* Mostrar el nombre del archivo al seleccionarlo */

$(".custom-file-input").on("change", function(event) {
    var inputFile = event.currentTarget;
    $(inputFile)
        .parent()
        .find(".custom-file-label")
        .html(inputFile.files[0].name);
});

$(".custom-file-label::after").val("Buscar");