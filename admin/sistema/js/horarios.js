let hora1;
let hora2;
const tiempos = [];

/* Mostrar Menu seleccionadp */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_menu_horarios").css("background", "coral");
$(".contenedor-menu .menu ul.menu_horarios").show();

/* Cargar horarios */

$(document).ready(function () {
  $.ajax({
    type: "POST",
    url: "php/horarios.php",
    data: { operacion: 1 },
    success: function (response) {
      if (response == "0") return false;
      data = JSON.parse(response);

      tiempos.push(data[0].hora);
      tiempos.push(data[1].hora);
      $("#hora1").html(data[0].hora);
      $("#hora2").html(data[1].hora);
      hora1 = data[0].hora.split(":");
      hora2 = data[1].hora.split(":");
    },
  });
});

$("#btnSeleccionarHorariosBatch").click(function (e) {
  e.preventDefault();

  if (tiempos.length < 2) {
    tiempo = $("#timeOne").val();

    if (tiempo == "") {
      alertify.set("notifier", "position", "top-right");alertify.error("Ingrese una hora.");
      return false;
    }

    if (tiempos.length < 1) {
      $("#hora1").html(tiempo);
    } else if (tiempo == tiempos[0]) {
      alertify.set("notifier", "position", "top-right");alertify.error("Los horarios son iguales, seleccionar otra hora.");
      return false;
    } else {
      $("#hora2").html(tiempo);
    }
    tiempos.push(tiempo);
  } else {
    alertify.set("notifier", "position", "top-right");alertify.error("Ingrese máximo dos horarios.");
  }
});

$(document).on("click", ".link-eliminar", function (e) {
  e.preventDefault();
  id = $(this).prop("id");
  id == 1 ? tiempos.shift() : tiempos.pop();
  id == 1 ? $("#hora1").html("") : $("#hora2").html("");
});

$("#btnEliminarHorariosBatch").click(function (e) {
  e.preventDefault();
  tiempos.push(tiempo);
});

$("#btnGuardarHorariosBatch").click(function (e) {
  e.preventDefault();

  $.ajax({
    type: "POST",
    url: "php/horarios.php",
    data: { tiempos, operacion: 3 },
    success: function (response) {
      if (response == 1) {
        alertify.set("notifier", "position", "top-right");alertify.success("Horarios Almacenados Correctamente.");
      } else {
        alertify.set("notifier", "position", "top-right");alertify.success("Error al almacenar los horarios, intente de nuevo.");
      }
    },
  });
});

//setTimeout("ejecutarPedidos", primeraHora());
//setTimeout("ejecutarPedidos", segundaHora());

function primeraHora() {
  horaActual = new Date();
  horaProgramada = new Date();
  horaProgramada.setHours(hora1[0]);
  horaProgramada.setMinutes(hora1[1]);
  horaProgramada.setSeconds(0);
  tiempoEjecucion = horaProgramada.getTime() - horaActual.getTime();
  return tiempoEjecucion;
}

function segundaHora() {
  horaActual = new Date();
  horaProgramada = new Date();
  horaProgramada.setHours(hora2[0]);
  horaProgramada.setMinutes(hora2[1]);
  horaProgramada.setSeconds(0);
  tiempoEjecucion = horaProgramada.getTime() - horaActual.getTime();
  return tiempoEjecucion;
}

function ejecutarPedidos() {
  $.post("../../../api/pedidos/nuevos", function (data, textStatus, jqXHR) {});
}
