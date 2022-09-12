/* Adicionar Nombre */

$("#AdicionarEtiqueta").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar3").slideDown();
    $("#GuardarEtiqueta").html("Crear");
    $("#codigo3").val("");
    $("#input3").val("");
    $("#txt-Id3").val("");

});

/* Borrar registros */

$(document).on("click", ".link-borrar3", function(e) {
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
                url: `/api/deleteLabel/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar3", function(e) {
    e.preventDefault();

    let ref = $(this).parent().parent().children().eq(0).text();
    let nombre = $(this).parent().parent().children().eq(1).text();

    $("#frmAdicionar3").slideDown();
    $("#GuardarEtiqueta").html("Actualizar");

    $("#codigo3").val(ref);
    $("#input3").val(nombre);
});

/* Almacenar Registros */

$(document).on("click", "#GuardarEtiqueta", function(e) {
    e.preventDefault();
    let ref = $('#codigo3').val();
    let nombre = $("#input3").val();

    $.ajax({
        type: "POST",
        url: '/api/saveLabel',
        data: { ref: ref, nombre: nombre },
        success: function(data) {
            $("#frmAdicionar3").slideUp();
            refreshTableLabel();
            notificaciones(data);
        },
    });
});

/* Actualizar tabla */

refreshTableLabel = () => {
    $("#tblEtiqueta").DataTable().clear();
    $("#tblEtiqueta").DataTable().ajax.reload();
}