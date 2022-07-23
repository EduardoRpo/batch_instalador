
/* Adicionar Nombre */

$("#AdicionarPropietario").click(function(e) {
    e.preventDefault();

    $("#frmAdicionarPropietario").slideDown();
    $("#GuardarPropietario").html("Crear");
    $("#txt-Id5").val("");
    $("#input5").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar5", function(e) {
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
                url: `/api/deleteOwner/${id}`,
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

    let id = this.id
    let nombre = $(this).parent().parent().children().eq(1).text();
    $("#frmAdicionarPropietario").slideDown();
    $("#GuardarPropietario").html("Actualizar");

    $("#txt-Id5").val(id);
    $("#input5").val(nombre);
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarPropietario", function(e) {
        e.preventDefault();
        let id = $('#txt-Id5').val();
        let nombre = $("#input5").val();
        $.ajax({
            type: "POST",
            url: '/api/saveOwner',
            data: { id: id, nombre: nombre },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable() {
    $("#tblPropietario").DataTable().clear();
    $("#tblPropietario").DataTable().ajax.reload();
}