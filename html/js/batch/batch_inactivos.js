$(document).ready(function () {
  $(document).on('click', '.link-comentario', function (e) {
    e.preventDefault();
    let id_batch = this.id;

    alertify
      .confirm(
        'Comentario',
        `<p>Ingrese comentario:</p><br>
        <textarea id="comment" name="comment" class="form-control-updated" placeholder="Comentario..." minlength="1" maxlength="150" cols="120" rows="5"></textarea>`,
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
