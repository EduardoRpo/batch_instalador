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
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar2", function(e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().eq(0).text();
    let nombre = $(this).parent().parent().children().eq(1).text();
    let operacion = 1;
    $("#frmAdicionar2").slideDown();
    $("#GuardarEnvases").html("Actualizar");

    $("#codigo2").val(id);
    $("#input2").val(nombre);
    $("#txt-Id2").val(operacion)
});

/* Almacenar Registros */

$(document).on("click", "#GuardarEnvases", function(e) {
    e.preventDefault();
    let ref = $('#codigo2').val();
    let nombre = $("#input2").val();
    //let operacion = $("#txt-Id2").val();

    $.ajax({
        type: "POST",
        url: '/api/saveContainers',
        data: { id: id, ref: ref, nombre: nombre },
        success: function(data) {
            notificaciones(data);
        },
    });
});

/* Actualizar tabla */

function refreshTable() {
    $("#tblEnvases").DataTable().clear();
    $("#tblEnvases").DataTable().ajax.reload();
}