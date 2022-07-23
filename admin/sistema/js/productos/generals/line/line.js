
/* Adicionar Nombre */

$("#btnAdicionarlinea").click(function(e) {
    e.preventDefault();

    $("#frmAdicionarLinea").slideDown();
    $("#lineaInput1").val("");
    $("#Guardarlinea").html("Crear");
    $("#lineaInput2").val("");
    $("#lineaInput3").val("");
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
                url: `/api/deleteLinesproducts/${id}`,
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
    let densidad = $(this).parent().parent().children().eq(2).text();
    //editar = 1;

    $("#frmAdicionarLinea").slideDown();
    $("#Guardarlinea").html("Actualizar");

    $("#lineaInput1").val(id);
    $("#lineaInput2").val(nombre);
    $("#lineaInput3").val(densidad);

});

/* Almacenar Registros */

    $(document).on("click", "#Guardarlinea", function(e) {
        e.preventDefault();
        let id = $('#lineaInput1').val();;
        let nombre = $("#lineaInput2").val();
        let densidad = $("#lineaInput3").val();
        let ajuste = 0.02
        $.ajax({
            type: "POST",
            url: '/api/savelinesproducts',
            data: { id: id, nombre: nombre, densidad: densidad, ajuste: ajuste },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable() {
    $("#tblLinea").DataTable().clear();
    $("#tblLinea").DataTable().ajax.reload();
}