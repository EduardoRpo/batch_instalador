$(document).ready(function() {
    /*checkBatch = (data) => {
      $.ajax({
        url: '/api/checkBatch',
        success: function (resp) {
          //resp = Object.entries(resp);
          insertar = resp.insertar;
          actualizar = resp.actualizar;

          alertConfirm(data);
        },
      });
    };*/

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
        producto = data.producto;
        tamanio = data.tamanio;
        cantidad = data.cantidades;

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
        alertify.prompt('Planeación', 'Ingrese la fecha de planeación', '',
            function(evt, value) {
                //alertify.success('You entered: ' + value)
                date = JSON.stringify(value)
                $.ajax({
                    type: 'POST',
                    url: '/api/saveBatch',
                    data: { date: date },
                    success: function(data) {
                        message(data);
                        $('#tablaPreBatch').DataTable().clear();
                        $('#tablaPreBatch').DataTable().ajax.reload();

                        pedidosProgramar.splice(0, pedidosProgramar.length);
                        deleteSession();
                    },
                });
            },
            function() {
                alertify.error('Cancel')
            }).set('type', 'date');
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