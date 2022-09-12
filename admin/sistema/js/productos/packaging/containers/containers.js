/* Adicionar Nombre */

$("#AdicionarEnvases").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar2").slideDown();
    $("#GuardarEnvases").html("Crear");
    $("#codigo2").val("");
    $("#input2").val("");
    $("#txt-Id2").val("");

});

/* Borrar registros */

$(document).on("click", ".link-borrar2", function(e) {
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
                url: `/api/deleteContainers/${id}`,
                success: function(data) {
                    notificaciones(data);
                    refreshTable();
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar2", function(e) {
    e.preventDefault();

    let ref = $(this).parent().parent().children().eq(0).text();
    let nombre = $(this).parent().parent().children().eq(1).text();

    $("#frmAdicionar2").slideDown();
    $("#GuardarEnvases").html("Actualizar");

    $("#codigo2").val(ref);
    $("#input2").val(nombre);
});

/* Almacenar Registros */

$(document).on("click", "#GuardarEnvases", function(e) {
    e.preventDefault();
    let ref = $('#codigo2').val();
    let nombre = $("#input2").val();

    $.ajax({
        type: "POST",
        url: '/api/saveContainers',
        data: { ref: ref, nombre: nombre },
        success: function(data) {
            $("#frmAdicionar2").slideUp();
            refreshTableContainer();
            notificaciones(data);
        },
    });
});

/* Actualizar tabla */

refreshTableContainer = () => {
    $("#tblEnvases").DataTable().clear();
    $("#tblEnvases").DataTable().ajax.reload();
}