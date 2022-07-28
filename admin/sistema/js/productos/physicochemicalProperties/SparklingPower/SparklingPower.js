
/* Adicionar Nombre */

$("#AdicionarEspuma").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar9").slideDown();
    $("#GuardarEspuma").html("Crear");
    $("#txt-Id9").val("");
    $("#input9").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar9", function(e) {
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
                url: `/api/deleteSparkPower/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar9", function(e) {
    e.preventDefault();

    let id = this.id
    let nombre = $(this).parent().parent().children().eq(1).text();
    $("#frmAdicionar9").slideDown();
    $("#GuardarEspuma").html("Actualizar");

    $("#txt-Id9").val(id);
    $("#input9").val(nombre);
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarEspuma", function(e) {
        e.preventDefault();
        let id = $('#txt-Id9').val();
        let nombre = $("#input9").val();
        $.ajax({
            type: "POST",
            url: '/api/saveSparkPower',
            data: { id: id, nombre: nombre },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable () {
    $("#tblEspuma").DataTable().clear();
    $("#tblEspuma").DataTable().ajax.reload();
}