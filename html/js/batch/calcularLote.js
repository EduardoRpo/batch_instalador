$(document).ready(function() {
    const pedidosProgramar = [];

    /*    $(document).on('click', '#calcLote', function(e) {
             e.preventDefault();
             $("input:checkbox:checked").each(
                 function() {
                     alert("El checkbox con valor " + this.id + " está seleccionado");
                 }
             );
         });
      */

    /* Cargar la data de la fila */

    $('#tablaPreBatch tbody').on('click', 'tr', function() {
        fila = tablaPreBatch.row(this).data();
    });

    $(document).on('change', '.checkboxPedidos', function(e) {
        e.preventDefault();
        referencia = this.id;

        if ($(this).is(':checked')) {
            pedidos = {};

            cantidad = $(`#cant-${referencia}`).val();
            granel = fila.granel;

            if (cantidad == 0) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('La cantidad a programar no puede ser cero (0)');
                $(this).prop('checked', false);
                return false;
            }

            pedidos.referencia = referencia;
            pedidos.cantidad = cantidad;
            pedidos.granel = granel;

            pedidosProgramar.push(pedidos);
        } else {
            $(`#cant-${referencia}`).val('');

            //borrar referencia en el array y objeto
        }
    });


    /* $(document).on('blur', '.form-control-updated', function(e) {
        id_checkbox = this.id; //M-21516
        id_checkbox = id_checkbox.substr(5, 9)
        $("#id_checkbox").prop("checked", true);
        $('.checkboxPedidos').change();
    }) */


    $(document).on('click', '#calcLote', function(e) {
        $.ajax({
            type: 'POST',
            url: '/api/calcTamanioLote',
            data: { data: pedidosProgramar },
            success: function(resp) {
                resp = Object.entries(resp);

                // Ventana
                alertify.confirm(
                    'Desea crear lote?',
                    `<table class="table table-striped table-bordered dataTable no-footer text-center" aria-describedby="tablaPreBatch_info">
                      <thead>
                        <tr>
                          <th>Granel</th>
                          <th>Tamaño</th>
                        </tr>
                      </thead>
                      <tbody>
                        ${(row = addRows(resp))}
                      </tbody>
                  </table>`,
                    function() {
                        alertify.success('Ok');
                    },
                    function() {
                        alertify.error('Cancel');
                    }
                );
            },
        });
    });

    addRows = (data) => {
        granel = [];
        tamanio = [];
        for (i = 0; i < data.length; i++) {
            granel.push(data[i][0]);
            tamanio.push(data[i][1]);
        }

        row = [];
        for (i = 0; i < data.length; i++) {
            row.push(
                `<tr><td>${granel[i]}</td><td>${tamanio[i]
        }</td><td style="font-size:22px; font-weight: bold">${(symbol = check(
          tamanio[i]
        ))}</td></tr>`
            );
        }

        return row;
    };

    check = (tamanio) => {
        if (tamanio >= 2500) {
            symbol = '&#x2716';
        } else symbol = '&#x2714';

        return symbol;
    };
});