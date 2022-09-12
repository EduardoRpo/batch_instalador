/* Adicionar Nombre */

$("#AdicionarCaja").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar4").slideDown();
    $("#GuardarCaja").html("Crear");
    $("#codigo4").val("");
    $("#input4").val("");
    $("#txt-Id4").val("");

});

/* Borrar registros */

$(document).on("click", ".link-borrar4", function(e) {
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
                url: `/api/deleteBox/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar4", function(e) {
    e.preventDefault();

    let ref = $(this).parent().parent().children().eq(0).text();
    let nombre = $(this).parent().parent().children().eq(1).text();

    $("#frmAdicionar4").slideDown();
    $("#GuardarCaja").html("Actualizar");

    $("#codigo4").val(ref);
    $("#input4").val(nombre);

});

/* Almacenar Registros */

$(document).on("click", "#GuardarCaja", function(e) {
    e.preventDefault();
    let ref = $('#codigo4').val();
    let nombre = $("#input4").val();

    $.ajax({
        type: "POST",
        url: '/api/saveBox',
        data: { ref: ref, nombre: nombre },
        success: function(data) {
            $("#frmAdicionar4").slideUp();
            refreshTableBox();
            notificaciones(data);
        },
    });
});

/* Actualizar tabla */

refreshTableBox = () => {
    $("#tblCaja").DataTable().clear();
    $("#tblCaja").DataTable().ajax.reload();
}