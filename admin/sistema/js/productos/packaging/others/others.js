/* Adicionar Nombre */

$("#AdicionarOtros").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar5").slideDown();
    $("#GuardarOtros").html("Crear");
    $("#codigo5").val("");
    $("#input5").val("");
    $("#txt-Id5").val("");

});

/* Borrar registros */

$(document).on("click", ".link-borrar5", function(e) {
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
                url: `/api/deleteOthers/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar5", function(e) {
    e.preventDefault();

    let ref = $(this).parent().parent().children().eq(0).text();
    let nombre = $(this).parent().parent().children().eq(1).text();

    $("#frmAdicionar5").slideDown();
    $("#GuardarOtros").html("Actualizar");

    $("#codigo5").val(ref);
    $("#input5").val(nombre);

});

/* Almacenar Registros */

$(document).on("click", "#GuardarOtros", function(e) {
    e.preventDefault();
    let ref = $('#codigo5').val();
    let nombre = $("#input5").val();

    $.ajax({
        type: "POST",
        url: '/api/saveOthers',
        data: { ref: ref, nombre: nombre },
        success: function(data) {
            $("#frmAdicionar5").slideUp();
            refreshTableOthers();
            notificaciones(data);
        },
    });
});

/* Actualizar tabla */

refreshTableOthers = () => {
    $("#tblOtros").DataTable().clear();
    $("#tblOtros").DataTable().ajax.reload();
}