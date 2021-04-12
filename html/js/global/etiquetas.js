$(document).ready(function () {
  imprimirEtiquetas = (data) => {
    tablePesaje.on("click", "tbody tr", function (e) {
      e.preventDefault();
      $(this).toggleClass("tr_hover ");

      arrayData = [];
      JSONData = {};
      let codMateriaPrima = $(this).find("td:first").html();
      let peso = $(this).find("td:nth-child(4)").html();
      JSONData.orden = batch.numero_orden;
      JSONData.referencia = codMateriaPrima;
      JSONData.peso = peso;
      arrayData.push(JSONData);
      $("#imprimirEtiquetas").modal("show");
    });
  };
});

$("#btnimprimirEtiquetas").click(function (e) {
  e.preventDefault();
  imprimirEtiquetasJSON();
});

function imprimirEtiquetasJSON() {
  const createXLSLFormatObj = [];
  let xlsHeader = ["orden", "referencia", "peso"];

  createXLSLFormatObj.push(xlsHeader);
  $.each(arrayData, function (index, value) {
    var innerRowData = [];
    $("tbody").append(
      "<tr><td>" + value.orden + "</td><td>" + value.referencia + "</td></tr>"
    );
    $.each(value, function (ind, val) {
      innerRowData.push(val);
    });
    createXLSLFormatObj.push(innerRowData);
  });

  const filename = "etiquetas_Dispensacion.xlsx";
  const ws_name = "etiquetas_Dispensacion";

  if (typeof console !== "undefined") console.log(new Date());
  var wb = XLSX.utils.book_new(),
    ws = XLSX.utils.aoa_to_sheet(createXLSLFormatObj);

  XLSX.utils.book_append_sheet(wb, ws, ws_name);

  $.ajax({
    type: "POST",
    url: "../../html/php/deleteFiles.php",
    success: function (response) {
      alertify.set("notifier", "position", "top-right");
      alertify.success(
        "Para imprimir las <b>Etiquetas</b> ingrese a labelJoy y actualice"
      );
      $("#cantidadEtiquetas").val("");
      $("#imprimirEtiquetas").modal("hide");
      XLSX.writeFile(wb, filename);
    },
  });
}
