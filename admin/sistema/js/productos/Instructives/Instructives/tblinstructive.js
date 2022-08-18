var tabla;
var editar;
let ref;

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
    url: '/api/granel',
    success: function(resp) {
        ref = resp
        let $selectProductos = $("#cmbReferenciaProductos");

        $selectProductos.empty();
        $selectProductos.append("<option disabled selected>Seleccionar</option>");

        $.each(resp, function(i, value) {
            $selectProductos.append(`<option value = '${value.referencia}'>${value.referencia}</option>`);
        });
    },
    error: function(resp) {
        console.log(resp);
    },
});
//}

/* Cargar nombre de producto de acuerdo con Seleccion Referencia */

$("#cmbReferenciaProductos").change(function(e) {
    e.preventDefault();
    let referencia = $("select option:selected").val();

    const resultado = ref.find(refer => refer.referencia === referencia);

    $("#txtnombreProducto").val("");
    $("#txtnombreProducto").val(resultado.nombre_referencia);

    /* if (info.data[0].base_instructivo == 0) {
        $(".adicionarInstructivo").slideUp();
        $(".btnadicionarInstructivo").prop("disabled", true);
        $(".alert_instructivos_base").slideDown();
    } else {
        $(".adicionarInstructivo").slideDown();
        $(".btnadicionarInstructivo").prop("disabled", false);
        $(".alert_instructivos_base").slideUp();
    } */

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
            url: `/api/instructivos/${referencia}`,
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
