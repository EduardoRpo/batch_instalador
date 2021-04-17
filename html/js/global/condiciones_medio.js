/* Mostrar ventana de Condiciones Medio de acuerdo con el tiempo establecido en la BD*/

const cargar_condicionesMedio = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/condicionesmedio.php",
    data: { operacion: "1", modulo, idBatch },

    success: function (resp) {
      if (resp == 3) return false;
      let t = JSON.parse(resp);
      let tiempo = Math.round(
        Math.random() * (t[0].t_max - t[0].t_min) + parseInt(t[0].t_min)
      );

      setTimeout(function () {
        $("#m_CondicionesMedio").modal({
          show: true,
          backdrop: "static",
          keyboard: false,
        });
      }, tiempo * 60000);
    },
  });
};

/* Validar si las condiciones del medio ya fueron almacenadas */

const validar_condicionesMedio = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/condicionesmedio.php",
    data: { operacion: 3, modulo, idBatch },

    success: function (response) {
      if (response == "true") return false;
      else
        $("#m_CondicionesMedio").modal({
          show: true,
          backdrop: "static",
          keyboard: false,
        });
    },
  });
};

/* Almacenar informacion de condiciones del medio */

const guardar_condicionesMedio = () => {
  let temperatura = parseInt($("#temperatura").val());
  let humedad = parseInt($("#humedad").val());

  /* Validar que existan datos en los campos */

  if (
    temperatura == "" ||
    humedad == "" ||
    isNaN(temperatura) ||
    isNaN(humedad)
  ) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Complete todos los datos para continuar con el proceso.");
    return false;
  }

  /* Validacion del nivel de temperatura y humedad de acuerdo con los valores */

  if (temperatura < 15 || temperatura > 40 || humedad < 55 || humedad > 75) {
    alertify.set("notifier", "position", "top-right");
    alertify.error(
      "La temperatura y/o humedad ingresada están por fuera de los rangos establecidos. Valide nuevamente!!"
    );
    return false;
  }

  $("#m_CondicionesMedio").modal("hide");

  $.ajax({
    type: "POST",
    url: "../../html/php/condicionesmedio.php",
    data: {
      operacion: "2",
      modulo,
      temperatura,
      humedad,
      idBatch,
    },

    success: function (resp) {
      if (resp == 1) {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Condiciones del Medio Almacenado");
      } else {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Error");
      }
    },
  });
};

$("#m_CondicionesMedio").on("hidden.bs.modal", function () {
  modulo == 5 ? muestrasEnvase() : muestras_acondicionamiento();
});
