const alertConfirm = (data) => {
  alertify
    .confirm(
      'Samara Cosmetics',
      `<p>¿Desea programar los lotes?<p><br></p>
                <table class="table table-striped table-bordered dataTable no-footer text-center" aria-describedby="tablaPreBatch_info">
                <thead>
                  <tr>
                    <th class="text-center">Granel</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Tamaño (Kg)</th>
                    <th class="text-center">Cantidad (Und)</th>
                  </tr>
                </thead>
                <tbody>
                  ${(row = addRows(data))}
                </tbody>
            </table>`,
      function () {
        saveBatch();
      },
      function () {
        $('.checkboxPedidos').prop('checked', false);
        clearInputArray(pedidosProgramar);
      }
    )
    .set('labels', { ok: 'Si', cancel: 'No' })
    .set({ closableByDimmer: false })
    .set('resizable', true)
    .resizeTo(800, 500);
};

addRows = (data) => {
  granel = data.granel;
  tamanio = data.tamanio;
  cantidad = data.cantidades;

  row = [];
  for (i = 0; i < granel.length; i++) {
    row.push(
      `<tr ${(text = color(tamanio[i]))}>
                <td>${granel[i]}</td>
                <td>TRATAMIENTO KERATINA PROGRESIVO - KERAMAGIC ALISADOR (200 ML)</td>
                <td>${tamanio[i].toFixed(2)}</td>
                <td>${cantidad[i]}</td>
                ${(symbol = check(tamanio[i]))}
                </tr>`
    );
  }
  return row;
};

color = (tamanio) => {
  if (tamanio > 2500) text = 'style="color: red"';
  else text = 'aria-describedby="tablaPreBatch_info"';

  return text;
};

check = (tamanio) => {
  if (tamanio > 2500) {
    symbol =
      '<td style="font-size:22px; font-weight: bold; color:red;">&#x2716</td>';
  } else
    symbol =
      '<td style="font-size:22px; font-weight: bold; color:green;">&#x2714</td>';

  return symbol;
};

//Opcion SI
saveBatch = () => {
  $.ajax({
    type: 'POST',
    url: '/api/saveBatch',
    success: function (data) {
      message(data);
    },
  });
};

// Opcion NO
clearInputArray = (data) => {
  // Limpiar inputs
  for (i = 0; i < data.length; i++) {
    $(`#cant-${data[i].numPedido}-${data[i].referencia}`).val('');
    $(`#date-${data[i].numPedido}-${data[i].referencia}`).val('');
  }
  // Limpiar Array
  for (i = data.length; i > 0; i--) data.pop();

  //Ir al backend y borrar la variable de Session $dataPedidos
  $.ajax({
    type: 'GET',
    url: '/api/eliminarLote',
  });
};
