

/* Adicionar Nombre */

$("#adicionarNombre").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar1").slideDown();
    $("#txt-Id1").val("");
    $("#btnnotificacion_sanitaria").html("Crear");
    $("#input1").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar1", function(e) {
    e.preventDefault();
    const id = this.id

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
                url: `/api/deleteNameProducts/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar1", function(e) {
    e.preventDefault();

    let id = this.id
    let nombre = $(this).parent().parent().children().eq(1).text();
    //editar = 1;

    $("#frmAdicionar1").slideDown();
    $("#btnguardarModulos").html("Actualizar");
    $("#txt-Id1").val(id);
    $("#input1").val(nombre);

});

/* Almacenar Registros */

$(document).on("click", "#btnnombreProducto", function(e) {
    e.preventDefault();
    let id = $("#txt-Id1").val();
    let nombre = $("#input1").val();
    console.log(id);
    $.ajax({
        type: "POST",
        url: '/api/saveNameProducts',
        data: { id: id, nombre: nombre },
        success: function(data) {
            notificaciones(data);
        },
    });
});

/* Actualizar tabla */

refreshTable = () => {
    $("#tblnombreProductos").DataTable().clear();
    $("#tblnombreProductos").DataTable().ajax.reload();
}