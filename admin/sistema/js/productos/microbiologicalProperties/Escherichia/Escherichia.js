
/* Adicionar Nombre */

$("#AdicionarEscherichia").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar3").slideDown();
    $("#GuardarEscherichia").html("Crear");
    $("#txt-Id3").val("");
    $("#input3").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar3", function(e) {
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
                url: `/api/deleteEscherichia/${id}`,
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

    let id = this.id
    let nombre = $(this).parent().parent().children().eq(1).text();
    $("#frmAdicionar3").slideDown();
    $("#GuardarEscherichia").html("Actualizar");

    $("#txt-Id3").val(id);
    $("#input3").val(nombre);
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarEscherichia", function(e) {
        e.preventDefault();
        let id = $('#txt-Id3').val();
        let nombre = $("#input3").val();
        $.ajax({
            type: "POST",
            url: '/api/saveEscherichia',
            data: { id: id, nombre: nombre },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable () {
    $("#tblEscherichia").DataTable().clear();
    $("#tblEscherichia").DataTable().ajax.reload();
}