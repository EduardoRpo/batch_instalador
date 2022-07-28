
/* Adicionar Nombre */

$("#AdicionarViscosidad").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar8").slideDown();
    $("#GuardarViscosidad").html("Crear");
    $("#txt-Id8").val("");
    $("#min8").val("");
    $("#max8").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar8", function(e) {
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
                url: `/api/deleteViscosity/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar8", function(e) {
    e.preventDefault();

    let id = this.id;
    let nombre = $(this).parent().parent().children().eq(1).text();
    var res = nombre.split(" - ");
    $("#frmAdicionar8").slideDown();
    $("#GuardarViscosidad").html("Actualizar");
    $("#txt-Id8").val(id);
    $("#min8").val(res[0]);
    $("#max8").val(res[1])
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarViscosidad", function(e) {
        e.preventDefault();
        let id = $('#txt-Id8').val();
        let Vmin = $("#min8").val();
        let Vmax = $("#max8").val();
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
            url: '/api/saveViscosity',
            data: { id: id, Vmin:Vmin, Vmax:Vmax },
            success: function(data) {
                notificaciones(data);
            },
        });}
    });

/* Actualizar tabla */

function refreshTable() {
    $("#tblViscosidad").DataTable().clear();
    $("#tblViscosidad").DataTable().ajax.reload();
}