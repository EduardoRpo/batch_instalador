
/* Adicionar Nombre */

$("#AdicionarStaphylococcus").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar7").slideDown();
    $("#GuardarStaphylococcus").html("Crear");
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
                url: `/api/deleteStaphylococcus/${id}`,
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
    $("#GuardarStaphylococcus").html("Actualizar");

    $("#txt-Id7").val(id);
    $("#input7").val(nombre);
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarStaphylococcus", function(e) {
        e.preventDefault();
        let id = $('#txt-Id7').val();
        let nombre = $("#input7").val();
        $.ajax({
            type: "POST",
            url: '/api/saveStaphylococcus',
            data: { id: id, nombre: nombre },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable () {
    $("#tblStaphylococcus").DataTable().clear();
    $("#tblStaphylococcus").DataTable().ajax.reload();
}