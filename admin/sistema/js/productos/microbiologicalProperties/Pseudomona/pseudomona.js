
/* Adicionar Nombre */

$("#AdicionarPseudomona").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar2").slideDown();
    $("#GuardarPseudomona").html("Crear");
    $("#txt-Id2").val("");
    $("#input2").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar2", function(e) {
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
                url: `/api/deletePseudomona/${id}`,
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

    let id = this.id
    let nombre = $(this).parent().parent().children().eq(1).text();
    $("#frmAdicionar2").slideDown();
    $("#GuardarPseudomona").html("Actualizar");

    $("#txt-Id2").val(id);
    $("#input2").val(nombre);
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarPseudomona", function(e) {
        e.preventDefault();
        let id = $('#txt-Id2').val();
        let nombre = $("#input2").val();
        $.ajax({
            type: "POST",
            url: '/api/savePseudomona',
            data: { id: id, nombre: nombre },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable () {
    $("#tblPseudomona").DataTable().clear();
    $("#tblPseudomona").DataTable().ajax.reload();
}