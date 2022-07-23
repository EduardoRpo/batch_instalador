
/* Adicionar Nombre */

$("#btnAdicionarPresentacion").click(function(e) {
    e.preventDefault();

    $("#frmAdicionarPresentacion").slideDown();
    $("#GuardarPresentacion").html("Crear");
    $("#txt-Id6").val("");
    $("#input6").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar6", function(e) {
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
                url: `/api/deletePresentation/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar6", function(e) {
    e.preventDefault();

    let id = this.id
    let nombre = $(this).parent().parent().children().eq(1).text();
    $("#frmAdicionarPresentacion").slideDown();
    $("#GuardarPresentacion").html("Actualizar");

    $("#txt-Id6").val(id);
    $("#input6").val(nombre);
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarPresentacion", function(e) {
        e.preventDefault();
        let id = $('#txt-Id6').val();
        let nombre = $("#input6").val();
        $.ajax({
            type: "POST",
            url: '/api/savePresentation',
            data: { id: id, nombre: nombre },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable() {
    $("#tblPresentacion").DataTable().clear();
    $("#tblPresentacion").DataTable().ajax.reload();
}