let editar;
const tiempos = [];

/* Mostrar Menu seleccionadp */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_menu_horarios").css("background", "coral");
$(".contenedor-menu .menu ul.menu_horarios").show();

$("#btnSeleccionarHorariosBatch").click(function (e) {
  e.preventDefault();

  if (tiempos.length < 2) {
    tiempo = $("#timeOne").val();
    $("#tiempos").append(`<br>${tiempo}`);
    tiempos.push(tiempo);
  } else {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Ingrese máximo dos horas.");
  }
});

$("#btnEliminarHorariosBatch").click(function (e) {
  e.preventDefault();
  tiempos.push(tiempo);
});

$("#btnGuardarHorariosBatch").click(function (e) {
  e.preventDefault();
  $.post("../../../api/pedidos/nuevos", function (data, textStatus, jqXHR) {});
});
