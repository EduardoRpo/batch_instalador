$(document).ready(function() {
    alertConfirm = (data) => {
        alertify
            .confirm(
                'Samara Cosmetics',
                `<p>¿Desea programar los lotes?</p><br><p>Cantidad Pedidos: ${data.cantidad_pedidos
        } - Cantidad Referencias: ${data.cantidad_referencias}</p><p><br></p>
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
                function() {
                    saveBatch();
                },
                function() {
                    clearInputArray();
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
            url: '/api/saveBatch',
            success: function(data) {
                message(data);
                $('#tablaPreBatch').DataTable().clear();
                $('#tablaPreBatch').DataTable().ajax.reload();
                saveFecha_insumo(pedidosProgramar);

                pedidosProgramar.pop();
                deleteSession();
            },
        });
    };

    saveFecha_insumo = (data) => {
        for (i = 0; i < data.length; i++) {
            $(`#date-${data[i].numPedido}-${data[i].referencia}`).blur();
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

    // Opcion NO
    clearInputArray = () => {
        $('#tablaPreBatch').DataTable().ajax.reload();
        //saveFecha_insumo(pedidosProgramar);
        deleteSession();
        pedidosProgramar.pop();
    };

    //Ir al backend y borrar la variable de Session $dataPedidos
    deleteSession = () => {
        $.ajax({
            type: 'GET',
            url: '/api/eliminarLote',
        });
    };
});