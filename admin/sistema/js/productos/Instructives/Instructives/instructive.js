$("#adicionarInstructivo").click(function(e) {
    e.preventDefault();

    editar = 0;
    $("#frmadInstructivo").slideToggle();
    $("#txtActividad").val("");
    $("#txtTiempo").val("");
    $("#txtguardarInstructivo").html("Crear");
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar", function(e) {
    e.preventDefault();

    editar = 1;
    const id = this.id;
    const actividad = $(this).parent().parent().children().eq(2).text();
    const tiempo = $(this).parent().parent().children().eq(3).text();

    $("#frmadInstructivo").slideDown();
    $("#txtguardarInstructivo").html("Actualizar");
    $("#txtId").val(id);
    $("#txtActividad").val(actividad);
    $("#txtTiempo").val(tiempo);
});

/* Almacenar Registros */

function guardarInstructivo() {
    let id = $("#txtId").val();
    let referencia = $("#cmbReferenciaProductos").val();
    let actividad = $("#txtActividad").val();
    let tiempo = $("#txtTiempo").val();

    if (referencia === null || actividad == "" || tiempo == "") {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Ingrese todos los datos.");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "/api/saveInstructivos",
        data: { editar, referencia, id, actividad, tiempo },

        success: function(data) {
            notificaciones(data);
            refreshTable();
        },
    });
}

/* Borrar registros */

$(document).on("click", ".link-borrar", function(e) {
    e.preventDefault();

    let id = this.id
    let referencia = $("#cmbReferenciaProductos").val();

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
                method: "POST",
                url: "/api/deleteInstructivos",
                data: { id, referencia },
            });
            refreshTable();
            alertify.set("notifier", "position", "top-right");
            alertify.success("Eliminado");
        }
    });
});

/* Actualizar tabla */

refreshTable = () => {
    $("#tblInstructivo").DataTable().clear();
    $("#tblInstructivo").DataTable().ajax.reload();
    $("#txtActividad").val("");
    $("#txtTiempo").val("");
    $("#frmadInstructivo").slideUp();
}