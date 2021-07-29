/* Carga de tabla de propiedades del producto */
$(document).ready(function () {
  $.ajax({
    url: `/api/productsDetails/${referencia}`,
    type: "GET",
  }).done((data, status, xhr) => {
    if (modulo != 8) {
      $("#espec_color").html(data.color);
      $("#espec_olor").html(data.olor);
      $("#espec_apariencia").html(data.apariencia);
      $("#espec_poder_espumoso").html(data.poder_espumoso);
      $("#espec_untosidad").html(data.untosidad);
      $("#espec_ph").html(
        `${data.limite_inferior_ph} a ${data.limite_superior_ph}`
      );
      $("#in_ph").attr("min", data.limite_inferior_ph);
      $("#in_ph").attr("max", data.limite_superior_ph);
      $("#espec_densidad").html(
        `${data.limite_inferior_densidad_gravedad} a ${data.limite_superior_densidad_gravedad}`
      );
      $("#in_densidad").attr("min", data.limite_inferior_densidad_gravedad);
      $("#in_densidad").attr("max", data.limite_superior_densidad_gravedad);
      $("#espec_grado_alcohol").html(
        `${data.limite_inferior_grado_alcohol} a ${data.limite_superior_grado_alcohol}`
      );
      $("#in_grado_alcohol").attr("min", data.limite_inferior_grado_alcohol);
      $("#in_grado_alcohol").attr("max", data.limite_superior_grado_alcohol);
      $("#espec_viscidad").html(
        `${data.limite_inferior_viscosidad} a ${data.limite_superior_viscosidad}`
      );
      $("#in_viscocidad").attr("min", data.limite_inferior_viscosidad);
      $("#in_viscocidad").attr("max", data.limite_superior_viscosidad);
      $("#espec_untosidad").html(data.untuosidad);
    }
    if (modulo == 8 || modulo == 1) {
      $("#mesofilos").html(data.mesofilos);
      $("#pseudomona").html(data.pseudomona);
      $("#escherichia").html(data.escherichia);
      $("#staphylococcus").html(data.staphylococcus);
    }
  });
});
