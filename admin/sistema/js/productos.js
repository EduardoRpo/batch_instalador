let editar;

/* Mostrar Menu seleccionado */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_productos").css("background", "coral");
$(".contenedor-menu .menu ul.menu_productos").show();

cargarDatosProductos();

//Cargue de tablas de Productos

$(document).ready(function() {
    $("#tblProductos").DataTable({
        /* scrollY: '45vh', */
        pageLength: 5,
        scrollCollapse: true,
        paging: false,
        language: { url: "admin_componentes/es-ar.json" },

        ajax: {
            method: "POST",
            url: "php/c_productos.php",
            data: { operacion: 1 },
        },

        columns: [{
                defaultContent: "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Editar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
            },
            { data: "referencia" },
            { data: "nombre_referencia" },
            { data: "presentacion_comercial", className: "centrado" },
            { data: "id_nombre_producto", className: "centrado" },
            { data: "id_notificacion_sanitaria", className: "centrado" },
            { data: "id_linea", className: "centrado" },
            { data: "id_marca", className: "centrado" },
            { data: "id_propietario", className: "centrado" },
            { data: "unidad_empaque", className: "centrado" },
            { data: "densidad_producto", className: "centrado" },
            { data: "id_color", className: "centrado" },
            { data: "id_olor", className: "centrado" },
            { data: "id_apariencia", className: "centrado" },
            { data: "id_untuosidad", className: "centrado" },
            { data: "id_poder_espumoso", className: "centrado" },
            { data: "id_recuento_mesofilos", className: "centrado" },
            { data: "id_pseudomona", className: "centrado" },
            { data: "id_escherichia", className: "centrado" },
            { data: "id_staphylococcus", className: "centrado" },
            { data: "id_ph", className: "centrado" },
            { data: "id_viscosidad", className: "centrado" },
            { data: "id_densidad_gravedad", className: "centrado" },
            { data: "id_grado_alcohol", className: "centrado" },
            { data: "id_envase", className: "centrado" },
            { data: "id_tapa", className: "centrado" },
            { data: "id_etiqueta", className: "centrado" },
            { data: "id_empaque", className: "centrado" },
            { data: "id_otros", className: "centrado" },
            { data: "base_instructivo", className: "centrado" },
            { data: "instructivo", className: "centrado" },
        ],

        columnDefs: [{ width: "10%", targets: 1 }],
    });
});

/* Cargar Modal para Crear productos */

function cargarModalProductos() {
    editar = 0;
    $("#m_productos").modal("show");
    $("#m_productos").find("input, select").val("").end();
    $("#btnguardarProductos").html("Crear Producto");
}

/* Cargar selectores y data */

function cargarDatosProductos() {
    let sel = [];
    let j = 0;

    $("select").each(function() {
        let id_sel = $(this).prop("id");
        if (id_sel != "bases_instructivo" && $(this).prop("id") != "instructivo")
            sel.push($(this).prop("id"));
    });

    for (i = 1; i <= sel.length; i++) {
        propiedad = sel[j];
        cargarselectores(propiedad);
        j++;
    }
    /* cargar bases */
    cargar_selector_bases();
}

/* Cargar selectores para adicionar productos */

function cargarselectores(selector) {
    $.ajax({
        method: "POST",
        url: "php/c_productos.php",
        data: { tabla: selector, operacion: 4 },

        success: function(response) {
            var info = JSON.parse(response);

            let $select = $(`#${selector}`);
            $select.empty();

            $select.append(
                "<option disabled selected>" + "Seleccionar" + "</option>"
            );
            $.each(info.data, function(i, value) {
                $select.append(
                    `<option value = ${value.id}> ${value.id} - ${value.nombre} </option>`
                );
            });
        },
        error: function(response) {
            console.log(response);
        },
    });
}

/* cargar selectores bases */

function cargar_selector_bases() {
    $.ajax({
        method: "POST",
        url: "php/c_productos.php",
        data: { operacion: 5 },

        success: function(response) {
            var info = JSON.parse(response);

            let $select = $(`#instructivo`);
            $select.empty();
            $select.append(
                "<option disabled selected>" + "Seleccionar" + "</option>"
            );

            $.each(info.data, function(i, value) {
                $select.append(
                    '<option value ="' +
                    value.id +
                    '">' +
                    value.producto_base +
                    "</option>"
                );
            });
        },
        error: function(response) {
            console.log(response);
        },
    });
}

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar", function(e) {
    editar = 1;
    let j = 1;
    let producto = [];

    //muestra el modal
    $("#m_productos").modal("show");
    $("#btnguardarProductos").html("Actualizar Producto");
    /* $('#id_referencia').val($('#referencia').val()); */
    /* $('#referencia').prop('disabled', true); */

    //carga el array con los datos de la tabla
    for (let i = 1; i < 30; i++) {
        propiedad = $(this).parent().parent().children().eq(i).text();
        producto.push(propiedad);
    }

    //carga todos los campos con la info del array
    for (let i = 0; i <= 30; i++) {
        $(`.n${j}`).val(producto[i]);
        j++;
    }
    /* Ocultar input de bases de acuerdo con el producto */
    $("#bases_instructivo").change();

    //para actualizar guarda la referencia iniciaL
    let referencia = $("#referencia").val();
    $("#id_referencia").val(referencia);
});

/* Eliminar registros */

$(document).on("click", ".link-borrar", function(e) {
    let id = $(this).parent().parent().children().eq(1).text();

    alertify
        .confirm(
            "Eliminar Producto",
            "¿Está seguro de Eliminar este producto?",
            function() {
                $.ajax({
                    type: "POST",
                    url: "php/c_productos.php",
                    data: { operacion: 2, id: id },

                    success: function(response) {
                        if (response == 1) {
                            alertify.set("notifier", "position", "top-right");
                            alertify.success("Registro Eliminado.");
                            refreshTable();
                        } else {
                            alertify.set("notifier", "position", "top-right");
                            alertify.error(
                                "El producto no se puede eliminar se encuentra relacionado con uno a varios Batch Records."
                            );
                        }
                    },
                });
            },
            function() {
                alertify.error("Cancelado");
            }
        )
        .set("labels", { ok: "Si", cancel: "No" });
});

/* Guardar o actualizar data*/

$(document).on("click", "#btnguardarProductos", function(e) {
    e.preventDefault();

    /* Validar el numero de input a solicitar */
    let base = $(".n28").val();

    if (base == 0) limite = 29;
    else limite = 28;

    /* Validar todos los datos del formulario */
    for (let i = 1; i <= limite; i++) {
        let validar = $(`.n${i}`).val();
        if (validar === "" || validar === null) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Ingrese todos los datos.");
            return false;
        }
    }

    /* Construye un FormData para todos los datos */
    const producto = new FormData($("#frmagregarProductos")[0]);
    /* Si el instructivo es personalizado se carga 0 */
    if (producto.get("bases_instructivo") == "1") {
        producto.set("instructivo", 0);
    }
    producto.set("operacion", 3);
    producto.set("editar", editar);

    $.ajax({
        type: "POST",
        url: "php/c_productos.php",
        data: producto,
        processData: false,
        contentType: false,

        success: function(r) {
            if (r == 1) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Almacenado con éxito.");
                refreshTable();
                $("#m_productos").modal("hide");
            } else if (r == 2) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("La Referencia ya existe.");
            } else if (r == 3) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Registro actualizado.");
                refreshTable();
                $("#m_productos").modal("hide");
            } else {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Error.");
            }
        },
        error: function(response) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Error.");
        },
    });
});

/* Seleccionar base a partir del instructivo */
$("#bases_instructivo").change(function(e) {
    e.preventDefault();
    let select = $(".bases_instructivo").val();

    if (select == 1) {
        $(".instructivo").hide();
        $(".instructivo").val("");
    } else $(".instructivo").show();
});

/* Actualizar tabla */

function refreshTable() {
    $("#tblProductos").DataTable().clear();
    $("#tblProductos").DataTable().ajax.reload();
}

$(".imgImportar").hide();

$("#btnCargarImagenes").click(function(e) {
    e.preventDefault();
    $(".imgImportar").toggle(600);
});

/* Cargar imagenes */

$("#uploadForm").on("submit", function(e) {
    e.preventDefault();
    datos = new FormData(this);
    datos.append("operacion", "6");
    $.ajax({
        type: "POST",
        url: "../sistema/php/c_productos.php",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $("#uploadStatus").html(
                '<img src="images/uploading.gif" style="height:100px"/>'
            );
        },
        error: function() {
            $("#uploadStatus").html(
                '<span style="color:#EA4335;">No se cargaron las Imagenes correctamente, trate nuevamente.<span>'
            );
        },
        success: function(data) {
            if (data === "false") {
                $("#uploadStatus").html(
                    '<span style="color:#EA4335;">No existe la referencia asociada a la imagen.<span>'
                );
                return false;
            }
            $("#uploadForm")[0].reset();
            $("#uploadStatus").html(
                '<span style="color:#28A74B;">Imagenes cargadas correctamente.<span>'
            );
            /* $(".gallery").html(data); */
        },
    });
});

// File type validation
$("#fileInput").change(function() {
    var fileLength = this.files.length;
    var match = ["image/jpeg"];
    var i;
    for (i = 0; i < fileLength; i++) {
        var file = this.files[i];
        var imagefile = file.type;
        if (!(
                imagefile == match[0] ||
                imagefile == match[1] ||
                imagefile == match[2] ||
                imagefile == match[3]
            )) {
            alert("Seleccione una imagen valida con formato (jpg).");
            $("#fileInput").val("");
            return false;
        }
    }
});