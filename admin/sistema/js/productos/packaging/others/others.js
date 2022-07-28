

/* Adicionar Nombre */

$("#AdicionarOtros").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar5").slideDown();
    $("#GuardarOtros").html("Crear");
    $("#codigo5").val("");
    $("#input5").val("");
    $("#txt-Id5").val("");

});

/* Borrar registros */

$(document).on("click", ".link-borrar5", function(e) {
    e.preventDefault();
    const id = $(this).parent().parent().children().eq(0).text();

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
                url: `/api/deleteOthers/${id}`,
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

    let id = $(this).parent().parent().children().eq(0).text();
    let nombre = $(this).parent().parent().children().eq(1).text();
    let operacion = 1;
    $("#frmAdicionar5").slideDown();
    $("#GuardarOtros").html("Actualizar");

    $("#codigo5").val(id);
    $("#input5").val(nombre);
    $("#txt-Id5").val(operacion)
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarOtros", function(e) {
        e.preventDefault();
        let id = $('#codigo5').val();
        let nombre = $("#input5").val();
        let operacion = $("#txt-Id5").val();
        
        console.log(operacion);
        $.ajax({
            type: "POST",
            url: '/api/saveOthers',
            data: { id: id, nombre: nombre, operacion, operacion },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable() {
    $("#tblOtros").DataTable().clear();
    $("#tblOtros").DataTable().ajax.reload();
}