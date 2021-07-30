/* seleccionar el batch */
let modulo = 1;
$("#cert_f").hide();
$(".check_cert").hide();
$(".grid-container-micro").hide();
$(".fecha_micro").hide();
$(".grid-container-organo").hide();
$(".fecha_organ").hide();
$(".grid-container-fisico").hide();
$(".grid-container-paramfisico").hide();
$(".grid-container-nota").hide();
$(".observ").hide();

$(document).ready(function () {
  var pathname = window.location.pathname;
  idList = pathname.split("/");
  idBatch = idList[2];
  referencia = idList[3];

  $.get(
    "../../../html/php/certificado/certificado.php",
    (data = { idBatch, op: 3 }),
    function (data, textStatus, jqXHR) {
      if (textStatus == "success") {
        data = JSON.parse(data);
        $(`.product`).html(data.nombre_referencia);
        $(`.titular_id`).html(data.propietario);
        $(`.invima_id`).html(data.notificacion_sanitaria);
        $(`.muestra_id`).html(data.lote_presentacion);
        $(`.lote_id`).html(data.numero_lote);
        $(`#op`).html(data.numero_orden);
      }
    }
  );

  $.get(
    "../../../html/php/certificado/certificado.php",
    (data = { idBatch, op: 1 }),
    function (data, textStatus, jqXHR) {
      if (textStatus == "success") {
        data = JSON.parse(data);
        if (!data.length) return false;
        $(`.fecha_micro`).html(`Fecha Análisis: ${data[0].fecha_registro}`);
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
        $(".grid-container-micro").show();
        $(".fecha_micro").show();
      }
    }
  );

  $.get(
    "../../../html/php/certificado/certificado.php",
    (data = { idBatch, op: 2 }),
    function (data, textStatus, jqXHR) {
      if (textStatus == "success" && data != "false") {
        data = JSON.parse(data);
        if (!data) return false;
        $(`.fecha_organ`).html(`Fecha Análisis: ${data.fecha_registro}`);
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
        $(`.obs`).html(data.observaciones);
        $(".grid-container-organo").show();
        $(".fecha_organ").show();
      }
    }
  );

  $(`#chk_aprobado`).prop("disabled", true);
  $(`#chk_aprobado`).prop("checked", true);
  $(`#chk_rechazado`).prop("disabled", true);

  $.get(
    "../../../html/php/certificado/certificado.php",
    (data = { idBatch, op: 4 }),
    function (data, textStatus, jqXHR) {
      if (textStatus == "success" && data != "false") {
        $(".grid-container-fisico").show();
        $(".grid-container-paramfisico").show();
        $(".grid-container-nota").show();
        $(".observ").show();
        $(".check_cert").show();
        $("#cert_f").show();
      }
    }
  );
});
