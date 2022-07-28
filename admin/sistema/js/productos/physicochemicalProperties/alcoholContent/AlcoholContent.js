
/* Adicionar Nombre */

$("#AdicionarAlcohol").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar5").slideDown();
    $("#GuardarAlcohol").html("Crear");
    $("#txt-Id5").val("");
    $("#min5").val("");
    $("#max5").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar5", function(e) {
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
                url: `/api/deleteAlcoholContent/${id}`,
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

    let id = this.id;
    let nombre = $(this).parent().parent().children().eq(1).text();
    var res = nombre.split(" - ");
    $("#frmAdicionar5").slideDown();
    $("#GuardarAlcohol").html("Actualizar");
    $("#txt-Id5").val(id);
    $("#min5").val(res[0]);
    $("#max5").val(res[1])
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarAlcohol", function(e) {
        e.preventDefault();
        let id = $('#txt-Id5').val();
        let Vmin = $("#min5").val();
        let Vmax = $("#max5").val();
        let dataRespose = dataVerification(Vmin, Vmax);
        if(dataRespose == 1){
            alertify.set("notifier", "position", "top-right");
            alertify.error("El valor mínimo no puede ser mayor o igual que el valor máximo");
        }
        else if(dataRespose == 2 ){
            alertify.set("notifier", "position", "top-right");
            alertify.error("ingrese todos los datos");
        }else{$.ajax({
            type: "POST",
            url: '/api/saveAlcoholContent',
            data: { id: id, Vmin:Vmin, Vmax:Vmax },
            success: function(data) {
                notificaciones(data);
            },
        });}
    });

/* Actualizar tabla */

function refreshTable() {
    $("#tblAlcohol").DataTable().clear();
    $("#tblAlcohol").DataTable().ajax.reload();
}