modulo = 9;

/* $("#btnRechazado").prop("checked", false);
$("#btnAprobado").prop("checked", false); */

$("#observacionesLote").slideUp();
$(".fisicoquimica_verificado").prop("disabled", true);

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

/* Validar que todos los campos este llenos */

cargar = (btn, idbtn) => {
  sessionStorage.setItem("idbtn", idbtn);
  id = btn.id;

  const desinfectante = $("#sel_producto_desinfeccion").val();
  const observaciones_desinfectante = $("#fisicoq_obs").val();
  const inputs = $("#especificaciones input");
  const selects = $("#especificaciones select");

  if (desinfectante == "Seleccione") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Ingrese el producto de desinfección.");
    return false;
  }

  for (i = 0; i < inputs.length; i++) {
    if (inputs[i].value == "") {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Complete todos los campos.");
      return false;
    }
  }

  for (i = 0; i < selects.length; i++) {
    if (selects[i].value == 0) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Seleccione todos los campos.");
      return false;
    }
  }

  /* Almacenar la data en un array */

  validar = cargarResultadosEspecificaciones();
  if (validar == 0) return false;

  let continuar = validarSeleccion();
  if (continuar != 0) {
    $("#usuario").val("");
    $("#clave").val("");
    $("#m_firmar").modal("show");
  }
};

deshabilitarbtn = () => {
  $(`.fisicoquimica_realizado`)
    .css({ background: "lightgray", border: "gray" })
    .prop("disabled", true);
  $(`.fisicoquimica_verificado`).prop("disabled", false);
};

$(".color").change(function (e) {
  e.preventDefault();
  validar_condicionesMedio();
});

cargarFisicoquimico = () => {
  $.post(
    "../../html/php/fisicoquimica.php",
    { idBatch, modulo },
    function (data, textStatus, jqXHR) {
      let info = JSON.parse(data);
      setTimeout(() => {
        $("#sel_producto_desinfeccion").val(info.desinfectante);
      }, 500);

      $("#in_observaciones").val(info.observaciones);
      if (info.obsBatch != "" && info.obsBatch != undefined) {
        $("#btnRechazado").prop("checked", true);
        $("#btnRechazado").change();
        $("#observacionesLoteRechazado").val(info.obsBatch);
      } else $("#btnAceptado").prop("checked", true);

      firmado(info.realizo, 1);
      if (info.verifico != 0) firmado(info.verifico, 2);
    }
  );
};

/* Carga formulario */

cargarControlProceso();
cargarFisicoquimico();
