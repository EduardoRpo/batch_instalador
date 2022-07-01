
/* Mostrar Menu seleccionadp */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_procesos").css("background", "coral");
$(".contenedor-menu .menu ul.menu_generales").show();

/* Adicionar Proceso */

$("#adProceso").click(function(e) {
    e.preventDefault();

    editar = 0;

    $("#frmadParametro").slideToggle();
    $("#txtid_Proceso").val("");
    $("#btnguardarModulos").html("Crear");
    $("#txtProceso").val("");
});

/* Borrar registros */

$(document).on("click", ".link-borrar", function(e) {
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
                //method: "POST",
                //url: "php/c_modulos.php",
                //data: { operacion: 2, id: id },
                url: `/api/deleteModules/${id}`,
                success: function(data) {
                   notificaciones(data);
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar", function(e) {
    e.preventDefault();

    let id = this.id
    let proceso = $(this).parent().parent().children().eq(1).text();
    //editar = 1;

    $("#frmadParametro").slideDown();
    $("#btnguardarModulos").html("Actualizar");

    $("#txtid_Proceso").val(id);
    $("#txtProceso").val(proceso);

});

/* Almacenar Registros */

$(document).ready(function() {
    $("#btnguardarModulos").click(function(e) {
        e.preventDefault();
        let id = $("#txtid_Proceso").val();
        let module = $("#txtProceso").val();
        console.log(module);
        console.log(id);

        $.ajax({
            type: "POST",
            //url: "php/c_modulos.php",
            //data: { operacion: 3, id: id, proceso: proceso, editar: editar },
            url: '/api/saveModules',
            data: { id: id, module: module},
            success: function(data) {
                notificaciones(data);
            },
        });
    });
});

/* Actualizar tabla */

function refreshTable() {
    $("#tblModulos").DataTable().clear();
    $("#tblModulos").DataTable().ajax.reload();
}