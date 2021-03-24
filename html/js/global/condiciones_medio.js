/* Mostrar ventana de Condiciones Medio de acuerdo con el tiempo establecido en la BD*/

function cargar_condiciones_medio() {
  $.ajax({
    type: "POST",
    url: "../../html/php/condicionesmedio.php",
    data: { operacion: "1", modulo: proceso, idBatch },

    success: function (resp) {
      if (resp == 3) return false;

      let t = JSON.parse(resp);

      /* Calculo del tiempo para aparecer la ventana para ingresar las condiciones del medio */

      let tiempo = Math.round(
        Math.random() * (t.data[0].t_max - t.data[0].t_min) +
          parseInt(t.data[0].t_min)
      );

      setTimeout(function () {
        $("#m_CondicionesMedio").modal({
          show: true,
          backdrop: "static",
        });
      }, tiempo * 60000);
    },
  });
}

/* Almacenar informacion de condiciones del medio */

function guardar_condicionesMedio() {
  let proceso = modulo;
  let temperatura = parseInt($("#temperatura").val());
  let humedad = parseInt($("#humedad").val());
  let url = $(location).attr("href");
  let id_batch = url.split("/");

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
      modulo: proceso,
      temperatura: temperatura,
      humedad: humedad,
      id: id_batch[4],
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
}

/* Validar si las condiciones del medio ya fueron almacenadas */

validarCondicionesMedio = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/condicionesmedio.php",
    data: { operacion: 3, modulo, idBatch },

    success: function (response) {
      if (response == 0) {
        return false;
      } else {
        $("#m_CondicionesMedio").modal({ show: true, backdrop: "static" });
      }
    },
  });
};
