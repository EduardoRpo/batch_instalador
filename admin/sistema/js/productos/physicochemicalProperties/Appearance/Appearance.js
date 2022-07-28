
/* Adicionar Nombre */

$("#btnAdicionarApariencia").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar1").slideDown();
    $("#GuardarApariencia").html("Crear");
    $("#txt-Id1").val("");
    $("#input1").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar1", function(e) {
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
                url: `/api/deleteAppearance/${id}`,
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

    let id = this.id
    let nombre = $(this).parent().parent().children().eq(1).text();
    $("#frmAdicionar1").slideDown();
    $("#GuardarPropietario").html("Actualizar");

    $("#txt-Id1").val(id);
    $("#input1").val(nombre);
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarApariencia", function(e) {
        e.preventDefault();
        let id = $('#txt-Id1').val();
        let nombre = $("#input1").val();
        $.ajax({
            type: "POST",
            url: '/api/saveAppearance',
            data: { id: id, nombre: nombre },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable() {
    $("#tblApariencia").DataTable().clear();
    $("#tblApariencia").DataTable().ajax.reload();
}