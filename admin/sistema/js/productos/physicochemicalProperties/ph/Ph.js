
/* Adicionar Nombre */

$("#AdicionarPH").click(function(e) {
    e.preventDefault();

    $("#frmAdicionar6").slideDown();
    $("#GuardarPH").html("Crear");
    $("#txt-Id6").val("");
    $("#min6").val("");
    $("#max6").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar6", function(e) {
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
                url: `/api/deleteph/${id}`,
                success: function(data) {
                    notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar6", function(e) {
    e.preventDefault();

    let id = this.id;
    let nombre = $(this).parent().parent().children().eq(1).text();
    var res = nombre.split(" - ");
    $("#frmAdicionar6").slideDown();
    $("#GuardarPH").html("Actualizar");
    $("#txt-Id6").val(id);
    $("#min6").val(res[0]);
    $("#max6").val(res[1])
});

/* Almacenar Registros */

    $(document).on("click", "#GuardarPH", function(e) {
        e.preventDefault();
        let id = $('#txt-Id6').val();
        let Vmin = $("#min6").val();
        let Vmax = $("#max6").val();
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
            url: '/api/saveph',
            data: { id: id, Vmin:Vmin, Vmax:Vmax },
            success: function(data) {
                notificaciones(data);
            },
        });}
    });

/* Actualizar tabla */

function refreshTable() {
    $("#tblPH").DataTable().clear();
    $("#tblPH").DataTable().ajax.reload();
}
