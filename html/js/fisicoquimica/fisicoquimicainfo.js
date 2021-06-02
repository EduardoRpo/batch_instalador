modulo = 9;

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

desinfectantes();
/* Validar qque todos los campos este llenos */

cargar = (btn, idbtn) => {
  sessionStorage.setItem("idbtn", idbtn);
  id = btn.id;

  const inputs = $("#especificaciones input");
  const selects = $("#especificaciones select");

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

/* Carga formulario */

cargarControlProceso();
cargarfirma2daSeccion();
