var tabla;
var editar;

/* Mostrar Menu seleccionado */

$(".contenedor-menu .menu a").removeAttr("style");
$(".contenedor-menu .menu ul.menu_productos").show();
$(".contenedor-menu .menu ul.menu_productos ul.menu_instructivos").show();
$("#link_preparaciones").css("background", "coral");
$(".alert_instructivos_base").hide();

//$(".contenedor-menu .menu a").removeAttr("style");
//$("#link_formulas").css("background", "coral");
$(".contenedor-menu .menu ul.menu_instructivos").show();
$("#link_preparaciones").css("background", "coral");

/* Cargue select referencias */
//function cargarSelectorModulo() {

$.ajax({
    method: "POST",
    url: "php/c_instructivo.php",
    data: { operacion: "1" },

    success: function(response) {
        var info = JSON.parse(response);
        let $selectProductos = $("#cmbReferenciaProductos");

        $selectProductos.empty();
        $selectProductos.append(
            "<option disabled selected>" + "Seleccionar" + "</option>"
        );

        $.each(info.data, function(i, value) {
            $selectProductos.append(
                '<option value ="' +
                value.referencia +
                '">' +
                value.referencia +
                "</option>"
            );
        });
    },
    error: function(response) {
        console.log(response);
    },
});
//}

/* Cargar nombre de producto de acuerdo con Seleccion Referencia */

$("#cmbReferenciaProductos").change(function(e) {
    e.preventDefault();
    let referencia = $("select option:selected").val();

    $.ajax({
        type: "POST",
        url: "php/c_instructivo.php",
        data: { operacion: "2", referencia },

        success: function(response) {
            var info = JSON.parse(response);
            $("#txtnombreProducto").val("");
            $("#txtnombreProducto").val(info.data[0].nombre_referencia);

            if (info.data[0].base_instructivo == 0) {
                $(".adicionarInstructivo").slideUp();
                $(".btnadicionarInstructivo").prop("disabled", true);
                $(".alert_instructivos_base").slideDown();
            } else {
                $(".adicionarInstructivo").slideDown();
                $(".btnadicionarInstructivo").prop("disabled", false);
                $(".alert_instructivos_base").slideUp();
            }
        },
    });

    cargarTablaFormulas(referencia);
});

/* Cargue de Parametros de Control en DataTable */

function cargarTablaFormulas(referencia) {
    tabla = $("#tblInstructivo").DataTable({
        destroy: true,
        scrollY: "50vh",
        scrollCollapse: true,
        paging: false,
        language: { url: "admin_componentes/es-ar.json" },

        ajax: {
            method: "POST",
            url: "php/c_instructivo.php",
            data: { operacion: "3", referencia },
            dataSrc: "",
        },

        columns: [{
                data: "id",
                render: function(data) {
                    return `<a href='#' id=${data} <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>`
                }
            },

            { data: "id" },
            { data: "pasos" },
            { data: "tiempo", className: "centrado" },
        ],
        columnDefs: [{ width: "10%", targets: 0 }],
    });
    tabla
        .on("order.dt search.dt", function() {
            tabla
                .column(1, { search: "applied", order: "applied" })
                .nodes()
                .each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
        })
        .draw();
}

/* Ocultar */

$("#adicionarInstructivo").click(function(e) {
    e.preventDefault();

    editar = 0;
    $("#frmadInstructivo").slideToggle();
    $("#txtActividad").val("");
    $("#txtTiempo").val("");
    $("#txtguardarInstructivo").html("Crear");
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar", function(e) {
    e.preventDefault();

    editar = 1;
    const id = this.id;
    const actividad = $(this).parent().parent().children().eq(2).text();
    const tiempo = $(this).parent().parent().children().eq(3).text();

    $("#frmadInstructivo").slideDown();
    $("#txtguardarInstructivo").html("Actualizar");
    $("#txtId").val(id);
    $("#txtActividad").val(actividad);
    $("#txtTiempo").val(tiempo);
});

/* Almacenar Registros */

function guardarInstructivo() {
    let id = $("#txtId").val();
    let referencia = $("#cmbReferenciaProductos").val();
    let actividad = $("#txtActividad").val();
    let tiempo = $("#txtTiempo").val();

    if (referencia === null || actividad == "" || tiempo == "") {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Ingrese todos los datos.");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "php/c_instructivo.php",
        data: { operacion: 4, editar, referencia, id, actividad, tiempo },

        success: function(r) {
            if (r == 1) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Almacenado con éxito.");
                refreshTable();
            } else if (r == 2) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Actividad ya existe.");
            } else if (r == 3) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Registro actualizado.");
                editar = 0;
                $("#txtguardarInstructivo").html("Crear");
                $("txtId").val("");
                $("#txtActividad").val("");
                $("#txtTiempo").val("");
                refreshTable();
            } else {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Error.");
            }
        },
    });
}

/* Borrar registros */

$(document).on("click", ".link-borrar", function(e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().eq(2).text();
    let referencia = $("#cmbReferenciaProductos").val();

    let confirm = alertify
        .confirm(
            "Samara Cosmetics",
            "¿Está seguro de eliminar este registro?",
            null,
            null
        )
        .set("labels", { ok: "Si", cancel: "No" });
    confirm.set("onok", function(r) {
        if (r) {
            $.ajax({
                method: "POST",
                url: "php/c_instructivo.php",
                data: { operacion: 5, id, referencia },
            });
            refreshTable();
            alertify.set("notifier", "position", "top-right");
            alertify.success("Eliminado");
        }
    });
});

/* Actualizar tabla */

function refreshTable(tabla) {
    $("#tblInstructivo").DataTable().clear();
    $("#tblInstructivo").DataTable().ajax.reload();
    $("#txtActividad").val("");
    $("#txtTiempo").val("");
    $("#frmadInstructivo").slideUp();
}