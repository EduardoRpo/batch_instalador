let filas;

controlFirmas = () => {
  $.ajax({
    type: "POST",
    url: "../../../admin/sistema/php/validacionFirmas.php",
    data: { batch: "1" },
    success: function (r) {
      const data = JSON.parse(r);
      filas = data.length;

      for (let i = 0; i < data.length; i++) {
        $("#tb_firmas").append(` 
        <tr>
          <th class="centrado" id="batch">${batch}</th>
          <th class="centrado" id="pesaje">${data["2"]== undefined ? "" : data["2"]}</th>
          <th class="centrado" id="preparacion">${data["3"]== undefined ? "" : data["3"]}</th>
          <th class="centrado" id="aprobacion">${data["4"]== undefined ? "" : data["4"]}</th>
          <th class="centrado" id="envasado">${data["5"]== undefined ? "" : data["5"]}</th>
          <th class="centrado" id="acondicionamiento">${data["6"]== undefined ? "" : data["6"]}</th>
          <th class="centrado" id="despachos">${data["7"] == undefined ? "" : data["7"]== undefined ? "" : data["7"]}</th>
          <th class="centrado" id="microbiologia">${data["8"]== undefined ? "" : data["8"]}</th>
          <th class="centrado" id="fisicoquimico">${data["9"]== undefined ? "" : data["9"]}</th>
          <th class="centrado" id="liberacionLote">${data["10"]== undefined ? "" : data["10"]}</th>
        </tr>`);
      }
    },
  });
};

controlFirmasBuscar = (batch) => {
  $.ajax({
    type: "POST",
    url: "../../../admin/sistema/php/validacionFirmas.php",
    data: { batch: batch },
    success: function (r) {
      const data = JSON.parse(r);
      for (let i = 0; i <= filas; i++) {
        $(`#fila${i}`).remove();
      }

      /* for (let i = 0; i < data.length; i++) { */
      $("#tb_firmas").append(` 
          <tr>
            <th class="centrado" id="batch">${batch}</th>
            <th class="centrado" id="pesaje">${data["2"]== undefined ? "" : data["2"]}</th>
            <th class="centrado" id="preparacion">${data["3"]== undefined ? "" : data["3"]}</th>
            <th class="centrado" id="aprobacion">${data["4"]== undefined ? "" : data["4"]}</th>
            <th class="centrado" id="envasado">${data["5"]== undefined ? "" : data["5"]}</th>
            <th class="centrado" id="acondicionamiento">${data["6"]== undefined ? "" : data["6"]}</th>
            <th class="centrado" id="despachos">${data["7"] == undefined ? "" : data["7"]== undefined ? "" : data["7"]}</th>
            <th class="centrado" id="microbiologia">${data["8"]== undefined ? "" : data["8"]}</th>
            <th class="centrado" id="fisicoquimico">${data["9"]== undefined ? "" : data["9"]}</th>
            <th class="centrado" id="liberacionLote">${data["10"]== undefined ? "" : data["10"]}</th>
          </tr>`);
      /* } */
    },
  });
};

$("#buscarFirmas").change(function (e) {
  e.preventDefault();
  const buscar_batch = $("#buscarFirmas").val();
  controlFirmasBuscar(buscar_batch);
});

controlFirmas();
