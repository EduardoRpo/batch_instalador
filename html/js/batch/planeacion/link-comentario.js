$(document).ready(function () {
  $(document).on('click', '.link-comentario', function (e) {
    e.preventDefault();
    $('#comment').val('');

    observations = loadObservations();

    alertify
      .confirm(
        'Samara Cosmetics',
        `<textarea id="comment" name="comment" class="form-control" placeholder="Observaciones..." minlength="20" maxlength="250" rows="3"></textarea>
        ${observations}`,
        function () {
          comment = $('#comment').val();
          if (!comment || comment == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese comentario');
            return false;
          }
          saveComment(comment);
        },
        function () {
          alertify.error('Cancel');
        }
      )
      .set('labels', { ok: 'Agregar', cancel: 'Cancelar' })
      .set({ closableByDimmer: false })
      .set('resizable', true)
      .resizeTo(500, 300);
  });

  /* Cargar observaciones */
  loadObservations = () => {
    dataBatch = sessionStorage.getItem('dataBatch');
    dataBatch = JSON.parse(dataBatch);
    if (dataBatch.pedido)
      data = {
        pedido: dataBatch.pedido,
        ref: dataBatch.id_producto,
      };

    if (dataBatch.id_batch) data = { batch: dataBatch.id_batch };

    $.ajax({
      type: 'POST',
      url: '/api/observacionesInactivos',
      data: data,
      success: function (r) {
        if (data.empty) {
          observations = '';
          return observations;
        } else {
          observations = `
            <p>Observaciones:</p><br>
            <table class="table table-striped table-bordered dataTable no-footer text-center" aria-describedby="tablaPreBatch_info">
                <thead>
                  <tr>
                    <th class="text-center">Fecha Registro</th>
                    <th class="text-center">Observación</th>
                  </tr>
                </thead>
                <tbody>
                  ${(row = addRows(r))}
                </tbody>
            </table>`;
          return observations;
        }
      },
    });
  };

  addRows = (data) => {
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
  saveComment = (comment) => {
    dataBatch = sessionStorage.getItem('dataBatch');
    dataBatch = JSON.parse(dataBatch);
    if (dataBatch.pedido)
      data = {
        pedido: dataBatch.pedido,
        ref: dataBatch.id_producto,
        comment: comment,
      };

    if (dataBatch.id_batch)
      data = { batch: dataBatch.id_batch, comment: comment };

    $.ajax({
      type: 'POST',
      url: '/api/addObservacion',
      data: data,
      success: function (resp) {
        message(resp);
      },
    });
  };
});
