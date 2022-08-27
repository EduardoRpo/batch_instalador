
let id;

/* Adicionar Nombre */

$("#btnAdicionarMarca").click(function(e) {
    e.preventDefault();

    $("#frmAdicionarMarcas").slideDown();
    $("#Guardarmarca").html("Crear");
    $("#txt-Id4").val("");
    $("#NombreMarca").val("");
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
                url: `/api/deletebrand/${id}`,
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
    //editar = 1;
    $("#frmAdicionarMarcas").slideDown();
    $("#Guardarmarca").html("Actualizar");
    $("#txt-Id4").val(id);
    $("#NombreMarca").val(nombre);
});

/* Almacenar Registros */

    $(document).on("click", ".Guardarmarca", function(e) {
        e.preventDefault();
        let id = $("#txt-Id4").val();
        let nombre = $("#NombreMarca").val();
        console.log(id);
        $.ajax({
            type: "POST",
            url: '/api/savebrand',
            data: { nombre:nombre , id: id },
            success: function(data) {
                notificaciones(data);
            },
        });
    });

/* Actualizar tabla */

function refreshTable() {
    $("#tblmarca").DataTable().clear();
    $("#tblmarca").DataTable().ajax.reload();
}