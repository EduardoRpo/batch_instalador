$(document).ready(function () {
  $('#btnLimpiarFirmas').click(function (e) {
    e.preventDefault();

    $.ajax({
      url: '/api/validacionFirmas',
      success: function (resp) {
        message(resp);
      },
    });
  });
});
