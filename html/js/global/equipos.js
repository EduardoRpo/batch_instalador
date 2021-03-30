/* carga de maquinas */

function cargarEquipos() {
  $.ajax({
    method: "POST",
    url: "../../html/php/cargarMaquinas.php",
    data: { modulo, idBatch },

    success: function (response) {
      if (response == "") return false;
      const info = JSON.parse(response);

      if (modulo == 3) {
        $("#sel_agitador").val(info[0].equipo);
        $("#sel_marmita").val(info[1].equipo);
      }
      if (modulo == 6) {
        $(`#sel_banda${id_multi}`).val(info[0].equipo);
        $(`#sel_etiquetadora${id_multi}`).val(info[1].equipo);
        $(`#sel_tunel${id_multi}`).val(info[2].equipo);
      }
    },
    error: function (response) {
      console.log(response);
    },
  });
}
