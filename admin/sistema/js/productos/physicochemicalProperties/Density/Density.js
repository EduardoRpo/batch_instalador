/* Adicionar Nombre */

$("#AdicionarDensidad").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar4").slideDown();
    $("#GuardarDensidad").html("Crear");
    $("#txt-Id4").val("");
    $("#min4").val("");
    $("#max4").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar4", function(e) {
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
                url: `/api/deleteDensity/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar4", function(e) {
    e.preventDefault();

    let id = this.id;
    let nombre = $(this).parent().parent().children().eq(1).text();
    var res = nombre.split(" - ");
    $("#frmAdicionar4").slideDown();
    $("#GuardarDensidad").html("Actualizar");
    $("#txt-Id4").val(id);
    $("#min4").val(res[0]);
    $("#max4").val(res[1])
});

/* Almacenar Registros */

$(document).on("click", "#GuardarDensidad", function(e) {
    e.preventDefault();
    let id = $('#txt-Id4').val();
    let Vmin = $("#min4").val();
    let Vmax = $("#max4").val();
    let dataRespose = dataVerification(Vmin, Vmax);
    if (dataRespose == 1) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("El valor mínimo no puede ser mayor o igual que el valor máximo");
    } else if (dataRespose == 2) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("ingrese todos los datos");
    } else {
        $.ajax({
            type: "POST",
            url: '/api/saveDensity',
            data: { id: id, Vmin: Vmin, Vmax: Vmax },
            success: function(data) {
                refreshTableDensity()
                notificaciones(data);
            },
        });
    }
});

/* Actualizar tabla */

function refreshTableDensity() {
    $("#tblDensidad").DataTable().clear();
    $("#tblDensidad").DataTable().ajax.reload();
}