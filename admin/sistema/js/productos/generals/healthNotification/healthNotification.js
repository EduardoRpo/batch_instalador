

/* Adicionar Nombre */

$("#adicionarNotificacion").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar2").slideDown();
    $("#txt-Id2").val("");
    $("#nombreproducto").html("Crear");
    $("#input2").val("");
    $("#input21").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar2", function(e) {
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
                url: `/api/deleteHealthNotifications/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar2", function(e) {
    e.preventDefault();

    let id = this.id
    let nombre = $(this).parent().parent().children().eq(1).text();
    let vencimiento = $(this).parent().parent().children().eq(2).text();
    //editar = 1;

    $("#frmAdicionar2").slideDown();
    $("#btnguardarModulos").html("Actualizar");

    $("#txt-Id2").val(id);
    $("#input2").val(nombre);
    $("#input21").val(vencimiento);

});

/* Almacenar Registros */

    $(document).on("click", "#btnnotificacion_sanitaria", function(e) {
        e.preventDefault();
        let id = $("#NotificacionInput1").val();
        let nombre = $("#NotificacionInput2").val();
        let vencimiento = $("#NotificacionInput3").val();
        $.ajax({
            type: "POST",
            url: '/api/saveHealthNotifications',
            data: { id: id, nombre: nombre, vencimiento : vencimiento },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable() {
    $(".notificacionSanitariatbl").DataTable().clear();
    $(".notificacionSanitariatbl").DataTable().ajax.reload();
}