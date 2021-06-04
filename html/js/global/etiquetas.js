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

const imprimirEtiquetasFull = (marmita) => {
  const ref = batch.referencia;
  $.ajax({
    url: `../../api/materiasp/${ref}`,
    success: function (materiaPrima) {
      $.ajax({
        url: `../../api/user/${modulo}/${idBatch}`,
        success: function (usuario) {
          modulo == 2
            ? imprimirEtiquetasPesaje(materiaPrima, usuario)
            : modulo == 3
            ? imprimirEtiquetasPreparacion(marmita, usuario)
            : imprimirEtiquetasAcondicionamiento(usuario);
        },
      });
    },
  });
};

const imprimirEtiquetasPesaje = (materiaPrima, usuario) => {
  operacion = 1;
  arrayData = [];
  for (let i = 0; i < materiaPrima.length; i++) {
    pesaje = {};
    pesaje.orden = batch.numero_orden;
    pesaje.referencia = materiaPrima[i].referencia;
    pesaje.peso =
      ((materiaPrima[i].porcentaje / 100) * batch.tamano_lote) /
      $("#Notanques").val();
    pesaje.producto = batch.nombre_referencia;
    pesaje.user = usuario.nombres;
    arrayData.push(pesaje);
  }
  exportarEtiquetas(operacion, arrayData);
};

const imprimirEtiquetasPreparacion = (marmita, usuario) => {
  operacion = 2;
  let preparacion = batch;
  preparacion.tanque = marmita;
  preparacion.usuario = usuario.nombres;
  exportarEtiquetas(operacion, preparacion);
};

const imprimirEtiquetasAcondicionamiento = (usuario) => {
  operacion = 3;
  batch.usuario = usuario.nombres;
  exportarEtiquetas(operacion, batch);
};

const exportarEtiquetas = (operacion, arrayData) => {
  $.ajax({
    type: "POST",
    url: "../../html/php/exportar.php",
    data: { operacion, array: arrayData },

    success: function (response) {
      alertify.set("notifier", "position", "top-right");
      alertify.success("Datos para etiquetas exportados correctamente");
    },
  });
};

/* Etiquetas virtuales */

$("#btnEtiquetasPrueba").click(function (e) {
  e.preventDefault();
  imprimirEtiquetasVirtuales();
});

$("#btnImprimirTodaslasEtiquetas").click(function (e) {
  e.preventDefault();
  imprimirEtiquetasFull();
});

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
