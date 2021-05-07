/* Validar si existe requerimiento */

buscarRequerimientos = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/requerimiento_ajuste.php",
    data: { operacion: 1, modulo, idBatch },

    success: function (response) {
      data = JSON.parse(response);
      $("#req_materiales").val(data[0].materia_prima);
      $("#req_procedimiento").val(data[0].procedimiento);
    },
  });
};

/* Enviar requerimiento */

function guardarRequerimientoAjuste() {
  let materiales = $("#req_materiales").val();
  let procedimiento = $("#req_procedimiento").val();

  if (materiales == "" || procedimiento == "") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("ingrese todos los datos.");
    return false;
  }

  $.ajax({
    type: "POST",
    url: "../../html/php/requerimiento_ajuste.php",
    data: { operacion: 2, materiales, procedimiento, modulo, idBatch },

    success: function (response) {
      if (response == 1) alertify.set("notifier", "position", "top-right");
      alertify.success("Requerimiento Enviado.");
      $("#m_req_ajuste").modal("hide");
    },
  });
}
