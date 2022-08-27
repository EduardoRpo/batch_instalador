$(document).ready(function() {
    $(document).on('click', '.link-comentario', function(e) {
        e.preventDefault();
        $('#comment').val('');

        /* Mostrar fila de pedidos */
        column = tablaPreBatch.column(1);
        column.visible(!column.visible());

        let col1 = $(this).parent().parent().children().eq(0).text();
        let col2 = $(this).parent().parent().children().eq(1).text();
        let col4 = $(this).parent().parent().children().eq(3).text();

        if (col4.includes('M-'))
            data = {
                pedido: col1,
                ref: col4,
            };
        else data = { batch: col2 };
        ejecucionObservaciones(data);
    });

    ejecucionObservaciones = async(data) => {
        observations = await loadObservations(data);
        loadAlertify(observations, data);
    };

    loadAlertify = (observations, data) => {
        alertify.confirm(
                'Gestión Pedido Pendientes',
                `<textarea id="comment" name="comment" class="form-control" placeholder="Observacion..." minlength="20" maxlength="250" rows="1"></textarea><br>${observations.table}`,
                function() {
                    comment = $('#comment').val();
                    if (!comment || comment == '') {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error('Ingrese comentario');
                        return false;
                    }
                    saveComment(data, comment);
                },
                function() {
                    alertify.error('Cancel');
                }
            )
            .set('labels', { ok: 'Agregar', cancel: 'Cancelar' })
            .set({ closableByDimmer: false })
            .set('resizable', true)
            .resizeTo(500, observations.size);
    };

    /* Cargar observaciones */
    loadObservations = async(data) => {
        response = await sendDataPOST(data);

        if (response.empty) {
            observations = { table: '', size: 300 };
            return observations;
        } else {
            observations = {
                table: `
        <p class="mt-3">Historial Seguimiento</p><br>
        <table class="table table-striped table-bordered dataTable no-footer text-center" aria-describedby="tablaPreBatch_info">
            <thead>
              <tr>
                <th class="text-center">Fecha Registro</th>
                <th class="text-center">Observación</th>
              </tr>
            </thead>
            <tbody>
              ${(row = loadTable(response))}
            </tbody>
        </table>`,
                size: 400,
            };
            return observations;
        }
    };

    sendDataPOST = async(params) => {
        try {
            result = await $.ajax({
                url: '/api/observacionesInactivos',
                type: 'POST',
                data: params,
            });
            return result;
        } catch (error) {
            console.error(error);
        }
    };

    loadTable = (data) => {
        row = [];
        for (i = 0; i < data.length; i++) {
            row.push(`<tr>
                  <td>${data[i].fecha_registro}</td>
                  <td>${data[i].observacion}</td>
                </tr>`);
        }
        return row.join('');
    };

    /* Guardar observacion */
    saveComment = (data, comment) => {
        data['comment'] = comment;

        $.ajax({
            type: 'POST',
            url: '/api/addObservacion',
            data: data,
            success: function(resp) {
                message(resp);
            },
        });
    };
});