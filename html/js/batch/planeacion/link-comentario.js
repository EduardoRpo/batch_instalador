$(document).ready(function () {
  $(document).on('click', '.link-comentario', function (e) {
    e.preventDefault();
    id_batch = this.id;
    $('#comment').val('');

    alertify
      .confirm(
        'Samara Cosmetics',
        `<textarea id="comment" name="comment" class="form-control" placeholder="Observaciones..." minlength="20" maxlength="250" rows="3"></textarea>`,
        function () {
          comment = $('#comment').val();
          if (!comment || comment == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese comentario');
            return false;
          }
          saveComment(id_batch, comment);
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

  saveComment = (batch, comment) => {
    data = { batch: batch, comment: comment };

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
