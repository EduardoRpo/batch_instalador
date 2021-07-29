/* seleccionar el batch */
let modulo = 1;
$(document).ready(function () {
  var pathname = window.location.pathname;
  idList = pathname.split("/");
  //idBatch = pathname.substr(13, 5);
  idBatch = idList[2];
  referencia = idList[3];
  $.get(
    "../../../html/php/certificado/certificado.php",
    (data = { idBatch, op: 1 }),
    function (data, textStatus, jqXHR) {
      if (textStatus == "success") {
        data = JSON.parse(data);
        $("#result_mesofilos").html(data[0].mesofilos);

        data[0].pseudomona == 1
          ? (result1 = "Ausencia")
          : (data[0].pseudomona = 2
              ? (result1 = "Presencia")
              : (result1 = "No Aplica"));

        data[0].escherichia == 1
          ? (result2 = "Ausencia")
          : (data[0].escherichia = 2
              ? (result2 = "Presencia")
              : (result2 = "No Aplica"));

        data[0].staphylococcus == 1
          ? (result3 = "Ausencia")
          : (data[0].staphylococcus = 2
              ? (result3 = "Presencia")
              : (result3 = "No Aplica"));

        $("#result_pseudomona").html(result1);
        $("#result_escherichia").html(result2);
        $("#result_staphylococcus").html(result3);
      }
    }
  );

  $.get(
    "../../../html/php/certificado/certificado.php",
    (data = { idBatch, op: 2 }),
    function (data, textStatus, jqXHR) {
      if (textStatus == "success") {
        data = JSON.parse(data);

        data.olor == 1
          ? (result1 = "Cumple")
          : (data[0].pseudomona = 2
              ? (result1 = "No Cumple")
              : (result1 = "No Aplica"));

        data.color == 1
          ? (result2 = "Cumple")
          : (data[0].escherichia = 2
              ? (result2 = "No Cumple")
              : (result2 = "No Aplica"));

        data.apariencia == 1
          ? (result3 = "Cumple")
          : (data[0].staphylococcus = 2
              ? (result3 = "No Cumple")
              : (result3 = "No Aplica"));

        data.untuosidad == 1
          ? (result4 = "Cumple")
          : (data[0].staphylococcus = 2
              ? (result4 = "No Cumple")
              : (result4 = "No Aplica"));

        data.espumoso == 1
          ? (result5 = "Cumple")
          : (data[0].staphylococcus = 2
              ? (result5 = "No Cumple")
              : (result5 = "No Aplica"));

        $("#result_olor").html(result1);
        $("#result_color").html(result2);
        $("#result_apariencia").html(result3);
        $("#result_ph").html(data.ph);
        $("#result_densidad").html(data.densidad);
        $("#result_viscosidad").html(data.viscosidad);
        $("#result_untuosidad").html(result4);
        $("#result_poder").html(result5);
        $("#result_alcohol").html(data.alcohol);
      }
    }
  );
});
