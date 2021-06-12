/* Cargue tabla especificaciones */
let dataMicro = [];
modulo = 8;
$("#observacionesLote").slideUp();

$(document).ready(function () {
  $(".metodo").html("Siembra Total");
  $(`.microbiologia_verificado`).prop("disabled", true);

  $("#btnRechazado").change(function (e) {
    e.preventDefault();
    $("#observacionesLote").slideDown();
  });

  $("#btnAceptado").change(function (e) {
    e.preventDefault();
    $("#observacionesLote").slideUp();
  });
});

cargar = (btn, Nobtn) => {
  sessionStorage.setItem("idbtn", Nobtn);
  sessionStorage.setItem("btn", btn.id);
  id = btn.id;

  /* Validacion de equipos */

  let desinfectante = $("#sel_producto_desinfeccion").val();
  let desinfectante_observaciones = $("#desinfectante_obs").val();
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

  if (desinfectante == "Seleccione") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione el producto para desinfección");
    return false;
  }

  if (equipos === 0) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione los Equipos");
    return false;
  }

  if (mesofilos == "") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Ingrese el resultado para el Recuento de Mesofilos");
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
    alertify.error("Seleccione las fechas de Siembra y Resultados");
    return false;
  }

  let continuar = validarSeleccion();

  if (continuar != 0) {
    let dataMicrobiologia = {};
    dataMicrobiologia.desinfectante = desinfectante;
    dataMicrobiologia.desinfectante_observaciones = desinfectante_observaciones;
    dataMicrobiologia.equipo1 = sel_incubadora;
    dataMicrobiologia.equipo2 = sel_autoclave;
    dataMicrobiologia.equipo3 = sel_cabina;
    dataMicrobiologia.mesofilos = mesofilos;
    dataMicrobiologia.pseudomona = pseudomona;
    dataMicrobiologia.escherichia = escherichia;
    dataMicrobiologia.staphylococcus = staphylococcus;
    dataMicrobiologia.fechaSiembra = fechaSiembra;
    dataMicrobiologia.fechaResultados = fechaResultados;
    dataMicrobiologia.observaciones = text;
    dataMicro.push(dataMicrobiologia);

    if (dataMicro.length > 1) dataMicro.shift();

    //validar_condicionesMedio();

    /* Carga el modal para la autenticacion */

    $("#usuario").val("");
    $("#clave").val("");
    $("#m_firmar").modal("show");
  }
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
        $(".microbiologia_realizado")
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);
        $(".microbiologia_verificado").prop("disabled", false);
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
    data: { op: 3, idBatch, verifico, modulo },
    success: function (r) {
      if (r == "true") {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Datos almacenados correctamente");
        $(".microbiologia_verificado")
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);
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
      data: { op: 1, idBatch, modulo },
      success: function (r) {
        if (r == "") return false;
        data = JSON.parse(r);
        firm = [];
        $("#sel_producto_desinfeccion").val(data[0].desinfectante);
        $("#desinfectante_obs").val(data[0].observaciones);

        $(".sel_incubadora").val(data[1]["id"]);
        $(".sel_autoclave").val(data[2]["id"]);
        $(".sel_cabina").val(data[3]["id"]);

        $("#inputMesofilos").val(data[4]["mesofilos"]);
        $(".pseudomona").val(data[4]["pseudomona"]);
        $(".escherichia").val(data[4]["escherichia"]);
        $(".staphylococcus").val(data[4]["staphylococcus"]);
        $("#fechaSiembra").val(data[4]["fecha_siembra"]);
        $("#fechaResultados").val(data[4]["fecha_resultados"]);

        observaciones = data[4]["observaciones"];
        if (observaciones != "") {
          $("#observacionesLote").slideDown();
          $("#observacionesLoteRechazado").val(data[3]["observaciones"]);
          $("#btnRechazado").prop("checked", true);
        } else {
          $("#btnAceptado").prop("checked", true);
        }

        firm.push(data[5]);
        firmado(firm, 1);
        if (data[6] != "false") {
          firm.push(data[6]);
          firmado(firm, 2);
        }
      },
    });
  };

  //cargarBatchMicro();
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
