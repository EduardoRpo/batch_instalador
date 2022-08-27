let editar;

/* Mostrar Menu seleccionado */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_productos").css("background", "coral");
$(".contenedor-menu .menu ul.menu_productos").show();

$(document).ready(function() {


    /* Cargar Modal para Crear productos */

    cargarModalProductos = () => {
        editar = 0;
        sessionStorage.removeItem('id_producto');

        $("#m_productos").modal("show");
        $("#m_productos").find("input, select").val("").end();
        $("#btnguardarProductos").html("Crear Producto");
    }

    /* Cargar datos para Actualizar registros */

    $(document).on("click", ".link-editar", function(e) {
        //editar = 1;
        idProducto = this.id;
        sessionStorage.setItem('id_producto', idProducto);

        let j = 1;
        let producto = [];

        //muestra el modal
        $("#m_productos").modal("show");
        $("#btnguardarProductos").html("Actualizar Producto");

        //carga el array con los datos de la tabla
        for (let i = 2; i < 32; i++) {
            propiedad = $(this).parent().parent().children().eq(i).text();
            producto.push(propiedad);
        }

        //carga todos los campos con la info del array
        for (let i = 0; i <= 31; i++) {
            $(`.n${j}`).val(producto[i]);
            j++;
        }
        /* Ocultar input de bases de acuerdo con el producto */
        $("#bases_instructivo").change();

        //para actualizar guarda la referencia iniciaL
        let referencia = $("#referencia").val();
        $("#id_referencia").val(referencia);
    });

    /* Guardar o actualizar data*/

    $(document).on("click", "#btnguardarProductos", function(e) {
        e.preventDefault();

        let idProducto = sessionStorage.getItem('id_producto')

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

        if (!idProducto) {

            $.ajax({
                type: "POST",
                //url: "php/c_productos.php",
                url: "/api/saveProduct",
                data: producto,
                processData: false,
                contentType: false,

                success: function(resp) {
                    message(resp);
                },
                error: function(resp) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Error.");
                },
            });
        } else {
            actualizarProducto(producto)
        }
    });

    /* Actualizar el producto */

    actualizarProducto = (producto) => {
        $.ajax({
            type: "POST",
            url: "/api/updateProduct",
            data: producto,
            processData: false,
            contentType: false,

            success: function(resp) {
                message(resp);
            },
            error: function(resp) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ocurrio un error mientras guardaba. Intente nuevamente, si el error persiste comuniquese con el administrador.");
            },
        });
    }

    /* Eliminar registros */

    $(document).on("click", ".link-borrar", function(e) {
        let id = this.id

        alertify.confirm("Eliminar Producto", "¿Está seguro de Eliminar este producto?", function() {
                $.ajax({
                    url: `/api/deleteProduct/${id}`,
                    success: function(data) {
                        message(data);
                    },
                });
            },
            function() {
                alertify.error("Cancelado");
            }
        ).set("labels", { ok: "Si", cancel: "No" });
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

    /* Mensaje de exito o error */

    message = (data) => {
        if (data.success == true) {
            $('#m_productos').modal('hide');
            $("#m_productos").find("input, select").val("").end();
            refreshTable();
            alertify.set("notifier", "position", "top-right");
            alertify.success(data.message);
            return false;

        } else if (data.error == true) {
            alertify.set("notifier", "position", "top-right");
            alertify.error(data.message);

        } else if (data.info == true) {
            alertify.set("notifier", "position", "top-right");
            alertify.notify(data.message);
        }

    };

    /* Actualizar tabla */

    refreshTable = () => {
        $("#tblProductos").DataTable().clear();
        $("#tblProductos").DataTable().ajax.reload();
    }
});