const alertConfirm = (data) => {
    alertify
        .confirm(
            'Samara Cosmetics',
            `<p>¿Desea programar los lotes?<p><br></p><table class="table table-striped table-bordered dataTable no-footer text-center" aria-describedby="tablaPreBatch_info">
                <thead>
                  <tr>
                    <th>Granel</th>
                    <th>Tamaño (Kg)</th>
                    <th>Cantidad (Und)</th>
                  </tr>
                </thead>
                <tbody>
                  ${(row = addRows(data))}
                </tbody>
            </table>`,
            function() {
                alertify.success('Ok');
            },
            function() {
                //alertify.error('Cancel');
                $('.checkboxPedidos').prop('checked', false);
                //$('.checkboxPedidos').change();
            }
        )
        .set('labels', { ok: 'Si', cancel: 'No' });
};

addRows = (data) => {
    granel = data.granel;
    tamanio = data.tamanio;
    cantidad = data.cantidades;

    row = [];
    for (i = 0; i < granel.length; i++) {
        row.push(
            `<tr>
          <td>${granel[i]}</td>
          <td>${tamanio[i].toFixed(2)}</td>
          <td>${cantidad[i]}</td>
          ${(symbol = check(tamanio[i]))}
        </tr>`
        );
    }
    return row;
};

check = (tamanio) => {
    if (tamanio >= 2500) {
        symbol =
            '<td style="font-size:22px; font-weight: bold; color:red;">&#x2716</td>';
    } else
        symbol =
        '<td style="font-size:22px; font-weight: bold; color:green;">&#x2714</td>';

    return symbol;
};