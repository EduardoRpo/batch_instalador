$(document).ready(function () {
  alertConfirm = (data) => {
    countPrePlaneados = data.countPrePlaneados;

    alertify
      .confirm(
        'Samara Cosmetics',
        `<p>¿Desea programar los lotes?</p><p><br></p>
                <table class="table table-striped table-bordered dataTable no-footer text-center" aria-describedby="tablaPedidos_info">
                <thead>
                  <tr>
                    <th class="text-center">Granel</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Tamaño (Kg)</th>
                    <th class="text-center">Cantidad (Und)</th>
                  </tr>
                </thead>
                <tbody>
                  ${(row = addRows(data.pedidosLotes))}
                </tbody>
            </table><br>`,
        function () {
          saveFechaPlaneacion();
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
    else text = 'aria-describedby="tablaPedidos_info"';

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
  saveFechaPlaneacion = () => {
    alertify
      .prompt(
        'Planeación',
        'Ingrese la fecha de planeación',
        '',
        function (evt, value) {
          if (!value || value == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese fecha de planeación');
            return false;
          }

          dataPrePlaneados = {};

          dataPrePlaneados.date = value;

          if (countPrePlaneados == 0) {
            dataPrePlaneados.simulacion = 1;
            savePrePlaneados(dataPrePlaneados);
          } else {
            alertSimulacion();
          }
        },
        function () {
          deleteSession();
        }
      )
      .set('type', 'date')
      .set({ closableByDimmer: false });
  };

  // Seleccionar tipo de simulación
  alertSimulacion = () => {
    alertify
      .confirm(
        'Samara Cosmetics',
        `<p>Cargar Pedido(s) en simulación:</p><p><br></p>
                  <select id="simulacion" class="form-control">
                    <option selected disabled>Seleccionar</option>
                    <option value="1">Escenario 1</option>
                    <option value="2">Escenario 2</option>
                  </select>`,
        function () {
          val = $('#simulacion').val();
          if (!val || val == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Seleccione tipo de simulación');
            return false;
          }

          dataPrePlaneados.simulacion = val;
          savePrePlaneados(dataPrePlaneados);
        },
        function () {
          deleteSession();
        }
      )
      .set('labels', { ok: 'Guardar', cancel: 'Cancelar' })
      .set({ closableByDimmer: false })
      .set('resizable', true);
    // .resizeTo(800, 500);
  };

  savePrePlaneados = (data) => {
    $.ajax({
      type: 'POST',
      url: '/api/addPrePlaneados',
      data: data,
      success: function (data) {
        message(data);

        pedidosProgramar.splice(0, pedidosProgramar.length);
        deleteSession();
        setTimeout(loadTotalVentas, 7000);
      },
    });
  };

  // Opcion NO
  clearInputArray = () => {
    clearVariables();
    $('#tablaPedidos').DataTable().ajax.reload();
    $('#tablaBatchPlaneados').DataTable().ajax.reload();
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
