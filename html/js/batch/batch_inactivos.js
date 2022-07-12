$(document).ready(function () {
  $(document).on('click', '.link-comentario', function (e) {
    e.preventDefault();
    debugger;
    let id_batch = this.id;

    alertify
      .confirm(
        'Comentario',
        `<p>Ingrese comentario:</p><br>
        <textarea name="comment" class="form-control-updated" placeholder="Comentario..." minlength="1" maxlength="150" cols="120" rows="5"></textarea>`,
        function () {
          alertify.success('Ok');
        },
        function () {
          alertify.error('Cancel');
        }
      )
      .set('labels', { ok: 'Agregar', cancel: 'Cancelar' })
      .set({ closableByDimmer: false })
      .set('resizable', true)
      .resizeTo(800, 500);
  });
});
