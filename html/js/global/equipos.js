/* Carga Equipos */

$.ajax({
  url: `/api/equipos`,
  type: "GET",
}).done((data, status, xhr) => {
  $(".sel_equipos").append(
    `<option value="0" selected disabled>Seleccionar</option>`
  );

  data.forEach((equipo) => {
    if (modulo == 3) {
      if (equipo.tipo == "agitador")
        $("#sel_agitador").append(
          `<option value="${equipo.id}">${equipo.descripcion}</option>`
        );
      if (equipo.tipo == "marmita")
        $("#sel_marmita").append(
          `<option value="${equipo.id}">${equipo.descripcion}</option>`
        );
    }

    if (modulo == 5) {
      if (equipo.tipo == "envasadora")
        $(`.sel_envasadora`).append(
          `<option value="${equipo.id}">${equipo.descripcion}</option>`
        );
      if (equipo.tipo == "loteadora")
        $(`.sel_loteadora`).append(
          `<option value="${equipo.id}">${equipo.descripcion}</option>`
        );
    }

    if (modulo == 6) {
      if (equipo.tipo == "banda")
        $(".banda").append(
          `<option value="${equipo.id}">${equipo.descripcion}</option>`
        );
      if (equipo.tipo == "etiquetadora")
        $(".etiquetadora").append(
          `<option value="${equipo.id}">${equipo.descripcion}</option>`
        );
      if (equipo.tipo == "tunel")
        $(".tunel").append(
          `<option value="${equipo.id}">${equipo.descripcion}</option>`
        );
    }

    if (modulo == 8) {
      if (equipo.tipo == "incubadora")
        $(".sel_incubadora").append(
          `<option value="${equipo.id}">${equipo.descripcion}</option>`
        );
      if (equipo.tipo == "autoclave")
        $(".sel_autoclave").append(
          `<option value="${equipo.id}">${equipo.descripcion}</option>`
        );
      if (equipo.tipo == "cabina")
        $(".sel_cabina").append(
          `<option value="${equipo.id}">${equipo.descripcion}</option>`
        );
    }
  });
});

/* Carga de maquinas guardadas */

function cargarEquipos() {
  $.ajax({
    method: "POST",
    url: "../../html/php/cargarMaquinas.php",
    data: { modulo, idBatch },

    success: function (response) {
      const info = JSON.parse(response);
      if (info.length < 1) return false;

      if (modulo == 3) {
        $("#sel_agitador").val(info[0].equipo);
        $("#sel_marmita").val(info[1].equipo);
      }

      if (modulo == 5) {
        $("#sel_envasadora").val(info[0].equipo);
        $("#sel_loteadora").val(info[1].equipo);
      }

      if (modulo == 6) {
        $(`#sel_banda${id_multi}`).val(info[0].equipo);
        $(`#sel_etiquetadora${id_multi}`).val(info[1].equipo);
        $(`#sel_tunel${id_multi}`).val(info[2].equipo);
      }

      if (modulo == 8) {
        $(`#sel_incubadora${id_multi}`).val(info[0].equipo);
        $(`#sel_autoclave${id_multi}`).val(info[1].equipo);
        $(`#sel_cabina${id_multi}`).val(info[2].equipo);
      }
    },
    error: function (response) {
      console.log(response);
    },
  });
}

/* Validar que la linea ha sido seleccionada */

function validarEquipos() {
  const equipo1 = $("#sel_agitador").val();
  const equipo2 = $("#sel_marmita").val();

  if (equipo1 * equipo2 == 0) {
    alertify.set("notifier", "position", "top-right");
    alertify.error(
      "Antes de continuar, seleccione los Equipos a usar para la linea de producción"
    );
    return 0;
  }
}
