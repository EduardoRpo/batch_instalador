/* Adicionar Nombre */

$("#AdicionarTapa").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar1").slideDown();
    $("#GuardarTapa").html("Crear");
    $("#codigo1").val("");
    $("#input1").val("");
    $("#txt-Id1").val("");

});

/* Borrar registros */

$(document).on("click", ".link-borrar1", function(e) {
    e.preventDefault();
    const id = $(this).parent().parent().children().eq(0).text();

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
                url: `/api/deleteLid/${id}`,
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

    let ref = $(this).parent().parent().children().eq(0).text();
    let nombre = $(this).parent().parent().children().eq(1).text();

    $("#frmAdicionar1").slideDown();
    $("#GuardarTapa").html("Actualizar");

    $("#codigo1").val(ref);
    $("#input1").val(nombre);
});

/* Almacenar Registros */

$(document).on("click", "#GuardarTapa", function(e) {
    e.preventDefault();
    let ref = $('#codigo1').val();
    let nombre = $("#input1").val();

    $.ajax({
        type: "POST",
        url: '/api/saveLid',
        data: { ref: ref, nombre: nombre },
        success: function(data) {
            $("#frmAdicionar1").slideUp();
            refreshTableLid()
            notificaciones(data);
        },
    });
});

/* Actualizar tabla */

refreshTableLid = () => {
    $("#tblTapa").DataTable().clear();
    $("#tblTapa").DataTable().ajax.reload();
}