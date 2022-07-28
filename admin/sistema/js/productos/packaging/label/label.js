

/* Adicionar Nombre */

$("#AdicionarEtiqueta").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar3").slideDown();
    $("#GuardarEtiqueta").html("Crear");
    $("#codigo3").val("");
    $("#input3").val("");
    $("#txt-Id3").val("");

});

/* Borrar registros */

$(document).on("click", ".link-borrar3", function(e) {
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
                url: `/api/deleteLabel/${id}`,
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

    let id = $(this).parent().parent().children().eq(0).text();
    let nombre = $(this).parent().parent().children().eq(1).text();
    let operacion = 1;
    $("#frmAdicionar3").slideDown();
    $("#GuardarEtiqueta").html("Actualizar");

    $("#codigo3").val(id);
    $("#input3").val(nombre);
    $("#txt-Id3").val(operacion)
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarEtiqueta", function(e) {
        e.preventDefault();
        let id = $('#codigo3').val();
        let nombre = $("#input3").val();
        let operacion = $("#txt-Id3").val();
        
        console.log(operacion);
        $.ajax({
            type: "POST",
            url: '/api/saveLabel',
            data: { id: id, nombre: nombre, operacion, operacion },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable() {
    $("#tblEtiqueta").DataTable().clear();
    $("#tblEtiqueta").DataTable().ajax.reload();
}