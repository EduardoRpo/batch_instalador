var tabla;
var editar;

/* Mostrar Menu seleccionado */

$(".contenedor-menu .menu a").removeAttr("style");
$(".contenedor-menu .menu ul.menu_productos").show();
$(".contenedor-menu .menu ul.menu_productos ul.menu_instructivos").show();
$("#link_bases").css("background", "coral");

//$(".contenedor-menu .menu a").removeAttr("style");
//$("#link_formulas").css("background", "coral");
$(".contenedor-menu .menu ul.menu_instructivos").show();
$(".link_bases").css("background", "coral");

/* Cargue select referencias */

$.ajax({

  url: "/api/baseInstructive",


  success: function (data) {
    let $selectProductos = $("#cmbReferenciaProductos");

    $selectProductos.empty();
    $selectProductos.append(
      "<option disabled selected>" + "Seleccionar" + "</option>"
    );

    $.each(data, function (i, value) {
      $selectProductos.append(
        '<option value ="' + value.id + '">' + value.nombre + "</option>"
      );
    });
  },
  error: function (response) {
    console.log(response);
  },
});

/* Cargue de Parametros de Control en DataTable */

//function cargarTablaFormulas(referencia) {


/* Ocultar */

$("#adicionarInstructivo").click(function (e) {
  e.preventDefault();

  editar = 0;
  $("#frmadInstructivo").slideToggle();
  $("#txtActividad").val("");
  $("#txtTiempo").val("");
  $("#txtguardarInstructivo").html("Crear");
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar", function (e) {
  e.preventDefault();

  editar = 1;
  const id = $(this).parent().parent().children().eq(2).text();
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
    url: "/api/saveBaseInstructive",
    data: { referencia, actividad, tiempo, id },

    success: function (data) {
      notificaciones(data);
      },
  });
}

/* Borrar registros */

$(document).on("click", ".link-borrar", function (e) {
  e.preventDefault();
  let referencia = $("#cmbReferenciaProductos").val();
  let id = $(this).parent().parent().children().eq(2).text();

  let confirm = alertify
    .confirm(
      "Samara Cosmetics",
      "¿Está seguro de eliminar este registro?",
      null,
      null
    )
    .set("labels", { ok: "Si", cancel: "No" });
  confirm.set("onok", function (r) {
    if (r) {
      $.ajax({
        method: "POST",
        url: "/api/deleteBaseInstructive",
        data: { id, referencia },
      success: function(data){
        notificaciones(data)
      }},
      );
    }
  });
});

/* Actualizar tabla */

refreshTable = () => {
  $("#tabla_bases_instructivo").DataTable().clear();
  $("#tabla_bases_instructivo").DataTable().ajax.reload();
}

limpiar_campos = () => {
  $("#txtActividad").val("");
  $("#txtTiempo").val("");
}
