/* Cargue tabla especificaciones */
let dataMicro = [];

$(document).ready(function () {
  $(".metodo").html("Siembra Total");
  $(`.microbiologia_verificado`).prop("disabled", true);
});

cargar = (btn, Nobtn) => {
  sessionStorage.setItem("idbtn", Nobtn);
  sessionStorage.setItem("btn", btn.id);
  id = btn.id;
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

guardar_microbiologia = (info) => {
  $.ajax({
    type: "POST",
    url: "../../html/php/microbiologia.php",
    data: { op: 2, dataMicro, modulo, idBatch, info },
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

/* Almacenar firma calidad */

guardar_microbiologia_calidad = (info) => {
  verifico = info[0].id;
  $.ajax({
    type: "POST",
    url: "../../html/php/microbiologia.php",
    data: { op: 3, idBatch, verifico },
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

//Cargar Batch
$(document).ready(function () {
  cargarBatchMicro = () => {
    $.ajax({
      type: "POST",
      url: "../../html/php/microbiologia.php",
      data: { op: 1, idBatch },
      success: function (r) {
        if (r == "") return false;
        data = JSON.parse(r);
        firm = [];
        let incubadora = data[0]["id"];
        setTimeout(() => {
          $(".sel_incubadora").val(incubadora);
          $(".sel_autoclave").val(data[1]["id"]);
          $(".sel_cabina").val(data[2]["id"]);
        }, 1300);
        $("#inputMesofilos").val(data[3]["mesofilos"]);
        $(".pseudomona").val(data[3]["pseudomona"]);
        $(".escherichia").val(data[3]["escherichia"]);
        $(".staphylococcus").val(data[3]["staphylococcus"]);
        $("#fechaSiembra").val(data[3]["fecha_siembra"]);
        $("#fechaResultados").val(data[3]["fecha_resultados"]);
        firm.push(data[4]);
        firmado(firm, 1);
        if (data[5] != "false") {
          firm.push(data[5]);
          firmado(firm, 2);
        }
      },
    });
  };

  cargarBatchMicro();
});

/* Registro de Firma */

function firmado(datos, posicion) {
  let template =
    '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
  let parent;

  btn_id = $("#idbtn").val();

  if (posicion == 1) {
    parent = $("#microbiologia_realizado").parent();
    $("#microbiologia_realizado").remove();
    $("#microbiologia_realizado")
      .css({ background: "lightgray", border: "gray" })
      .prop("disabled", true);
    $(".microbiologia_verificado").prop("disabled", false);
  } else {
    parent = $("#microbiologia_verificado").parent();
    $("#microbiologia_verificado").remove();
    $("#microbiologia_verificado")
      .css({ background: "lightgray", border: "gray" })
      .prop("disabled", true);
  }

  let firma = template.replace(":firma:", datos[0].urlfirma);
  parent.append(firma).html;
}
