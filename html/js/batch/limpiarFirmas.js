$(document).ready(function () {
  $('#btnLimpiarFirmas').click(function (e) {
    e.preventDefault();
    let data = {};

    /* Mientras mas sea la diferencia de los batchs, mas tarda en ejecutarse */
    alertify
      .confirm(
        'Comprobar Firmas',
        `<div class="row">
          <div class="col">
            <label>Batch Inicial:</label>
            <input type="number" id="minBatch" class="form-control text-center">
          </div>
          <div class="col">
            <label>Batch Final:</label>
            <input type="number" id="maxBatch" class="form-control text-center">
          </div>
         </div>`,
        function () {
          minBatch = $('#minBatch').val();
          maxBatch = $('#maxBatch').val();
          if (!minBatch || minBatch == '' || !maxBatch || maxBatch == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese los campos');
            return false;
          }

          if (minBatch > maxBatch) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error(
              'El Batch Inicial no puede ser mayor al Batch Final'
            );
            return false;
          }

          data.minBatch = minBatch;
          data.maxBatch = maxBatch;

          $.ajax({
            type: 'POST',
            url: '/api/validacionFirmas',
            data: data,
            success: function (resp) {
              fetchFirmas(resp);
            },
          });
        },
        function () {}
      )
      .set('labels', { ok: 'Ejecutar', cancel: 'Cancelar' })
      .set({ closableByDimmer: false })
      .resizeTo(300, 300);
  });

  fetchFirmas = async (data) => {
    await message(data);

    setTimeout(alignTHeader, 5000);
  };
});
