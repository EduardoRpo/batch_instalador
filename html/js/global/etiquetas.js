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
      $.ajax({
        url: `../../api/user/${modulo}/${idBatch}`,
        success: function (r) {
          arrayData = [];
          for (let i = 0; i < response.length; i++) {
            pesaje = {};
            pesaje.orden = batch.numero_orden;
            pesaje.referencia = response[i].referencia;
            pesaje.peso =
              ((response[i].porcentaje / 100) * batch.tamano_lote) /
              $("#Notanques").val();
            pesaje.producto = batch.nombre_referencia;
            pesaje.user = r.nombres;
            arrayData.push(pesaje);
          }
          exportarEtiquetas(arrayData);
        },
      });
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

const exportarEtiquetas = (arrayData) => {
  $.ajax({
    type: "POST",
    url: "../../html/php/exportar.php",
    data: { array: arrayData },

    success: function (response) {
      alertify.set("notifier", "position", "top-right");
      alertify.success("Datos para etiquetas exportados correctamente");
    },
  });
};

/* function exportarEtiquetas() {
  const createXLSLFormatObj = [];
  let xlsHeader = ["orden", "referencia", "peso"];

  createXLSLFormatObj.push(xlsHeader);
  $.each(arrayData, function (index, value) {
    var innerRowData = [];
   
    $.each(value, function (ind, val) {
      innerRowData.push(val);
    });
    createXLSLFormatObj.push(innerRowData);
  });

  const filename = "etiquetas_Dispensacion.xlsx";
  const ws_name = "etiquetas_Dispensacion";

  
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
      XLSX.writeFile(wb, filename);
    },
  });
} */

$("#btnEtiquetasPrueba").click(function (e) {
  e.preventDefault();
  imprimirEtiquetasVirtuales();
});

$("#btnImprimirTodaslasEtiquetas").click(function (e) {
  e.preventDefault();
  imprimirEtiquetasFull();
});
