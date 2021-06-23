modulo = 10;
let radio;
$(document).ready(function () {
  const cargarLiberacion = () => {
    $.post("url", data, function (data, textStatus, jqXHR) {}, "dataType");
  };

  cargar = (btn, idbtn) => {
    sessionStorage.setItem("idbtn", idbtn);
    id = btn.id;

    radio = $("input:radio[name=liberacion]:checked").val();
    if (radio == undefined) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Seleccione una opción para liberar el producto");
      return false;
    }

    $("#usuario").val("");
    $("#clave").val("");
    $("#m_firmar").modal("show");
  };
});

const guardarLiberacion = () => {
  let obs = $("#observacioneslote").val();
  $.post(
    "../../html/php/liberacion.php",
    { radio, id, info, obs, idBatch, op: 1 },
    function (data, textStatus, jqXHR) {
      alertify.set("notifier", "position", "top-right");
      alertify.success("Firmado exitosamente");
      id = sessionStorage.getItem("idbtn");
      if (id == "firma1")
        $(".produccion_realizado")
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);
      else if (id == "firma2")
        $(".calidad_verificado")
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);
      else
        $(".tecnica_realizado")
          .css({ background: "lightgray", border: "gray" })
          .prop("disabled", true);
    }
  );
};

const cargarBatch = () => {
  $.post(
    "../../html/php/liberacion.php",
    { idBatch, op: 2 },
    function (data, textStatus, jqXHR) {
      info = JSON.parse(data);
      if (info == false) return false;
      $("#observacioneslote").val(info.observaciones);
      if (info.aprobacion == 0) $("#radioLiberacionNo").prop("checked", true);
      else $("#radioLiberacionSi").prop("checked", true);
      if (info.produccion != null) firmado(info.produccion, 1);
      if (info.calidad != null) firmado(info.calidad, 2);
      if (info.tecnica != null) firmado(info.tecnica, 3);
    }
  );
};

const firmado = (datos, posicion) => {
  let template =
    '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
  let parent;

  btn_id = $("#idbtn").val();

  if (posicion == 1) {
    parent = $("#produccion_realizado").parent();
    $("#produccion_realizado").remove();
    $(".produccion_realizado")
      .css({ background: "lightgray", border: "gray" })
      .prop("disabled", true);
  }

  if (posicion == 2) {
    parent = $("#calidad_verificado").parent();
    $("#calidad_verificado").remove();
    $(".calidad_verificado")
      .css({ background: "lightgray", border: "gray" })
      .prop("disabled", true);
  }

  if (posicion == 3) {
    parent = $("#tecnica_realizado").parent();
    $("#tecnica_realizado").remove();
    $(".tecnica_realizado")
      .css({ background: "lightgray", border: "gray" })
      .prop("disabled", true);
  }

  let firma = template.replace(":firma:", datos);
  parent.append(firma).html;
};
