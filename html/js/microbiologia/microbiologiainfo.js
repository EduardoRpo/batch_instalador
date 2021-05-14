/* Cargue tabla especificaciones */
let dataMicro = [];

$(document).ready(function () {
  $(".metodo").html("Siembra Total");
});

cargar = (btn, Nobtn) => {
  /* Validacion de equipos */

  let sel_incubadora = $(".sel_incubadora").val();
  let sel_autoclave = $(".sel_autoclave").val();
  let sel_cabina = $(".sel_cabina").val();
  let mesofilos = $("#inputMesofilos").val();
  let pseudomona = $(".pseudomona").val();
  let escherichia = $(".escherichia").val();
  let staphylococcus = $(".staphylococcus").val();
  let fechaSiembra = $("#fechaSiembra").val();
  let fechaResultados = $("#fechaResultados").val();

  equipos = sel_incubadora * sel_autoclave * sel_cabina;
  analisis = pseudomona * escherichia * staphylococcus;

  if (mesofilos == "" || equipos === 0) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione los Equipos");
    return false;
  }

  if (analisis === 0) {
    alertify.set("notifier", "position", "top-right");
    alertify.error(
      "Seleccione e Ingrese los datos del análisis Microbiológico"
    );
    return false;
  }

  if (fechaSiembra === "" || fechaResultados == "") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Selecciones las fechas de Siembra y Resultados");
    return false;
  }

  /*  equipos = [];
  equipos.push(sel_incubadora);
  equipos.push(sel_autoclave);
  equipos.push(sel_cabina); */

  let dataMicrobiologia = {};
  dataMicrobiologia.equipo1 = sel_incubadora;
  dataMicrobiologia.equipo2 = sel_autoclave;
  dataMicrobiologia.equipo3 = sel_cabina;
  dataMicrobiologia.mesofilos = mesofilos;
  dataMicrobiologia.pseudomona = pseudomona;
  dataMicrobiologia.escherichia = escherichia;
  dataMicrobiologia.staphylococcus = staphylococcus;
  dataMicrobiologia.fechaSiembra = fechaSiembra;
  dataMicrobiologia.fechaResultados = fechaResultados;
  dataMicro.push(dataMicrobiologia);

  /* Carga el modal para la autenticacion */

  $("#usuario").val("");
  $("#clave").val("");
  $("#m_firmar").modal("show");
};

/* Almacenar info */

guardar_microbiologia = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/microbiologia.php",
    data: { op: 2, dataMicro, modulo, batch },
    success: function (r) {
      if (r == "true") {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Datos almacenados correctamente");
      }

      if (r == "false") {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Valide nuevamente. Datos No almacenados");
      }
    },
  });
};
