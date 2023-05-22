$(document).ready(function () {
  $('#btnLimpiarFirmas').click(function (e) {
    e.preventDefault();

    $('#currentState').val('');
    $('#minBatch').val('');
    $('#maxBatch').val('');

    $('.cardInputsFirmas').show();
    $('.spinner').hide();
    $('#btnCloseModalControlFirmas').prop('disabled', false);
    $('#btnSendControlFirmas').prop('disabled', false);

    $('#m_firmar').modal('show');
  });

  $('#btnCloseModalControlFirmas').click(function (e) {
    e.preventDefault();

    $('#m_firmar').modal('hide');
  });

  $('#btnSendControlFirmas').click(function (e) {
    e.preventDefault();

    let data = {};

    minBatch = $('#minBatch').val();
    maxBatch = $('#maxBatch').val();

    if (!minBatch || minBatch == '' || !maxBatch || maxBatch == '') {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese los campos');
      return false;
    }

    if (minBatch > maxBatch) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('El Batch Inicial no puede ser mayor al Batch Final');
      return false;
    }

    data.minBatch = minBatch;
    data.maxBatch = maxBatch;

    $('.spinner').show(800);
    $('.cardInputsFirmas').hide(800);
    $('#btnCloseModalControlFirmas').prop('disabled', true);
    $('#btnSendControlFirmas').prop('disabled', true);
    fetchFirmas(data);
  });

  fetchFirmas = async (data) => {
    let resp = await sendDataPOST('/api/validacionFirmas', data);
    $('#m_firmar').modal('hide');
    await message(resp);

    setTimeout(alignTHeader, 5000);
  };

  $('#maxBatch').keyup(function (e) {
    minBatch = $('#minBatch').val();
    maxBatch = $('#maxBatch').val();

    if (minBatch == maxBatch) {
      $.get(`/api/batch/${minBatch}`, function (data, textStatus, jqXHR) {
        $('#currentState').val(data.estado);

      });
    }



  })



});
