$(document).ready(function () {
  alertConfirm = (data) => {
    alertify
      .confirm(
        'Samara Cosmetics',
        `<p>¿Desea programar los lotes?</p><p><br></p>
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
            </table><br>`,
        function () {
          saveBatch();
        },
        function () {
          clearInputArray();
        }
      )
      .set('labels', { ok: 'Si', cancel: 'No' })
      .set({ closableByDimmer: false })
      .set('resizable', true)
      .resizeTo(800, 500);
  };

  addRows = (data) => {
    /* granel = data.granel;
        producto = data.producto;
        tamanio = data.tamanio;
        cantidad = data.cantidades; */

    row = [];
    for (i = 0; i < data.length; i++) {
      row.push(`<tr ${(text = color(data[i].tamanio_lote))}>
                <td>${data[i].granel}</td>
                <td>${data[i].producto}</td>
                <td>${data[i].tamanio_lote.toFixed(2)}</td>
                <td>${data[i].cantidad_acumulada}</td>
                ${(symbol = check(data[i].tamanio_lote))}
                </tr>`);
    }
    return row.join('');
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
    alertify
      .prompt(
        'Planeación',
        'Ingrese la fecha de planeación',
        '',
        function (evt, value) {
          //alertify.success('You entered: ' + value)
          if (!value || value == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese fecha');
            return false;
          }

          date = JSON.stringify(value);
          $.ajax({
            type: 'POST',
            url: '/api/saveBatch',
            data: { date: date },
            success: function (data) {
              message(data);

              pedidosProgramar.splice(0, pedidosProgramar.length);
              deleteSession();
            },
          });
        },
        function () {
          deleteSession();
        }
      )
      .set('type', 'date')
      .set({ closableByDimmer: false });
  };

  // Opcion NO
  clearInputArray = () => {
    $('#tablaPreBatch').DataTable().ajax.reload();
    //saveFecha_insumo(pedidosProgramar);
    deleteSession();
    pedidosProgramar.splice(0, pedidosProgramar.length);
  };

  //Ir al backend y borrar la variable de Session $dataPedidos
  deleteSession = () => {
    $.ajax({
      type: 'GET',
      url: '/api/eliminarLote',
    });
  };
});
