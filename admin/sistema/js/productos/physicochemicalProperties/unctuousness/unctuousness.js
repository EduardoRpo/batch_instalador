/* Adicionar Nombre */

$("#Adicionaruntuosidad").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar7").slideDown();
    $("#GuardarUntuosidad").html("Crear");
    $("#txt-Id7").val("");
    $("#input7").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar7", function(e) {
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
                url: `/api/deleteUnctuousness/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar7", function(e) {
    e.preventDefault();

    let id = this.id
    let nombre = $(this).parent().parent().children().eq(1).text();
    $("#frmAdicionar7").slideDown();
    $("#GuardarUntuosidad").html("Actualizar");

    $("#txt-Id7").val(id);
    $("#input7").val(nombre);
});

/* Almacenar Registros */

$(document).on("click", "#GuardarUntuosidad", function(e) {
    e.preventDefault();
    let id = $('#txt-Id7').val();
    let nombre = $("#input7").val();
    $.ajax({
        type: "POST",
        url: '/api/saveUnctuousness',
        data: { id: id, nombre: nombre },
        success: function(data) {
            refreshTableUnctuousness()
            notificaciones(data);
        },
    });
});

/* Actualizar tabla */

function refreshTableUnctuousness() {
    $("#tblUntuosidad").DataTable().clear();
    $("#tblUntuosidad").DataTable().ajax.reload();
}