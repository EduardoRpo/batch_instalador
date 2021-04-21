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
      sessionStorage.setItem("batch", batch);
      //window.open("../../html/modal/m_plantillaEtiquetas.php", "_blank");
      $("#imprimirEtiquetas").modal("show");
    });
  };
});

$("#btnimprimirEtiquetas").click(function (e) {
  e.preventDefault();
  exportarEtiquetas();
  //imprimirEtiquetasVirtuales();
});

const imprimirEtiquetasFull = () => {
  const ref = batch.referencia;
  $.ajax({
    url: `../../api/materiasp/${ref}`,
    success: function (response) {
      arrayData = [];
      for (let i = 0; i < response.length; i++) {
        pesaje = {};
        pesaje.orden = batch.numero_orden;
        pesaje.referencia = response[i].referencia;
        pesaje.peso =
          ((response[i].porcentaje / 100) * batch.tamano_lote) /
          $("#Notanques").val();
        arrayData.push(pesaje);
      }
      exportarEtiquetas();
    },
  });
};

imprimirEtiquetasVirtuales = () => {
  batch = sessionStorage.getItem("batch");
  const ref = batch.referencia;
  $.ajax({
    url: `../../api/materiasp/${ref}`,

    success: function (response) {
      //$(location).prop("href", "");

      //window.open("../../html/modal/m_plantillaEtiquetas.php", "_blank");
      response.forEach((element) => {
        $("#contenedorEtiquetas").append(
          `<div class="etiquetasVirtuales" style="margin-bottom: 10px;width:500px">
            <p><b>ORDEN PROD:</b></p>
            <p id="orden">${element.numero_orden}</p>
            <p><b>PESO:</b></p>
            <p id="peso">80 kg</p>
            <p><b>REFERENCIA:</b></p>
            <p id="ref">20003</p>
            <p><b>FECHA</b></p>
            <p id="fecha">13/04/2021</p>
            <p><b>DISPENSÓ:</b></p>
            <p id="dispenso">Sergio Velandia</p>
            <p><b>VoBo QC:</b></p>
            <p id="fqc">Martha Olmos</p>
          </div>`
        );
      });
    },
  });
};

function exportarEtiquetas() {
  const createXLSLFormatObj = [];
  let xlsHeader = ["orden", "referencia", "peso"];

  createXLSLFormatObj.push(xlsHeader);
  $.each(arrayData, function (index, value) {
    var innerRowData = [];
    /* $("tbody").append(
      "<tr><td>" + value.orden + "</td><td>" + value.referencia + "</td></tr>"
    ); */
    $.each(value, function (ind, val) {
      innerRowData.push(val);
    });
    createXLSLFormatObj.push(innerRowData);
  });

  const filename = "etiquetas_Dispensacion.xlsx";
  const ws_name = "etiquetas_Dispensacion";

  //if (typeof console !== "undefined") console.log(new Date());
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
      if ($("#imprimirEtiquetas").is(":visible"))
        $("#imprimirEtiquetas").modal("hide");
      //if (typeof console !== "undefined") console.log(new Date());
      XLSX.writeFile(wb, filename);
      //if (typeof console !== "undefined") console.log(new Date());
    },
  });
}

$("#btnEtiquetasPrueba").click(function (e) {
  e.preventDefault();
  imprimirEtiquetasVirtuales();
});

$("#btnImprimirTodaslasEtiquetas").click(function (e) {
  e.preventDefault();
  imprimirEtiquetasFull();
});
