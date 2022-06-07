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
        //clearInputArray(pedidosProgramar);
        deleteSession();
      }
    )
    .set('labels', { ok: 'Si', cancel: 'No' })
    .set({ closableByDimmer: false })
    .set('resizable', true)
    .resizeTo(800, 500);
};

addRows = (data) => {
  //cantPedidos = data.cantidad_pedidos;
  //cantReferencias = data.cantidad_referencias;
  granel = data.granel;
  tamanio = data.tamanio;
  cantidad = data.cantidades;
  producto = data.producto;

  row = [];
  for (i = 0; i < granel.length; i++) {
    row.push(`<tr ${(text = color(tamanio[i]))}>
                <td>${granel[i]}</td>
                <td>${producto[i]}</td>
                <td>${tamanio[i].toFixed(2)}</td>
                <td>${cantidad[i]}</td>
                ${(symbol = check(tamanio[i]))}
                </tr>`);
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
      $('#tablaPreBatch').DataTable().ajax.reload();

      //saveFecha_insumo(pedidosProgramar);
      deleteSession();
    },
  });
};

saveFecha_insumo = (data) => {
  //$('#tablaPreBatch').DataTable().clear();

  for (i = 0; i < data.length; i++) {
    $(`#date-${data[i].numPedido}-${data[i].referencia}`).val(
      data[i].fecha_insumo
    );

    calcfechaSugeridas(
      data[i].fecha_insumo,
      `${data[i].numPedido}-${data[i].referencia}`
    );
  }
};

/*Limpiar inputs que ya se crearon
$(document).on('click', '.cantProgram', function () {
  //e.preventDefault();
  id_input = this.id;
  id_date = id_input.substr(5, 13);
  cantidad = $(`#${id_input}`).val();

  if (cantidad > 0 && pedidosProgramar.length > 0) {
    numPedido = id_checkbox.slice(0, -8);
    $(`#${id_input}`).val('');
    $(`#date-${id_date}`).val('');
    deleteArray(numPedido);
  }
});*/

/* Opcion NO
clearInputArray = (data) => {
  // Limpiar inputs
  for (i = 0; i < data.length; i++) {
    $(`#cant-${data[i].numPedido}-${data[i].referencia}`).val('');
    $(`#date-${data[i].numPedido}-${data[i].referencia}`).val('');
  }
  // Limpiar Array
  for (i = data.length; i > 0; i--) data.pop();

  //Ir al backend y borrar la variable de Session $dataPedidos
  deleteSession();
}; */

deleteSession = () => {
  $.ajax({
    type: 'GET',
    url: '/api/eliminarLote',
  });
  $('#tablaPreBatch').DataTable().ajax.reload();
};
