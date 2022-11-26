$(document).ready(function () {
  $('#btnLimpiarFirmas').click(function (e) {
    e.preventDefault();
    let data = {};

    alertify
      .confirm(
        'Samara Cosmetics',
        `<p>Ingrese batchs a limpiar:</p>
        <br>
        <div class="row">
          <div class="col">
            <label>Batch minimo:</label>
            <input type="number" id="minBatch" class="form-control text-center">
          </div>
          <div class="col">
            <label>Batch maximo:</label>
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
              'El batch minimo no puede ser mayor al batch maximo'
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
      .set('labels', { ok: 'Guardar', cancel: 'Cancelar' })
      .set({ closableByDimmer: false })
      .resizeTo(300, 300);
  });

  fetchFirmas = async (data) => {
    await message(data);

    setTimeout(alignTHeader, 5000);
  };
});
