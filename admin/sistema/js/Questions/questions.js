$('#adicionarParametro').click(function (e) {
  e.preventDefault();
  $('#frmadicionarPregunta').slideToggle();
  $('#txtIdPregunta').val('');
  $('#txtPregunta').val('');
  $('#btnAlmacenarPregunta').html('Crear');
});

/* Cargar datos para Actualizar registros */

$('#tblPreguntas tbody').on('click', 'tr', function () {
  datos = tabla.row(this).data();
});

$(document).on('click', '.link-editar', function (e) {
  e.preventDefault();

  let id = this.id;
  let pregunta = $(this).parent().parent().children().eq(2).text();

  $('#frmadicionarPregunta').slideDown();
  $('#btnAlmacenarPregunta').html('Actualizar');

  $('#txtIdPregunta').val(id);
  $('#txtPregunta').val(pregunta);
});

/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
  e.preventDefault();

  const id = this.id;
  var confirm = alertify
    .confirm(
      'Samara Cosmetics',
      '¿Está seguro de eliminar este registro?',
      null,
      null
    )
    .set('labels', { ok: 'Si', cancel: 'No' });

  confirm.set('onok', function (r) {
    if (r) {
      $.ajax({
        url: `/api/deleteQuestions/${id}`,
        data: { id },

        success: function (data) {
          notificaciones(data);
        },
      });
    }
  });
});

/* Almacenar Registros */

$('#btnAlmacenarPregunta').click(function (e) {
  e.preventDefault();

  let id = $('#txtIdPregunta').val();
  let pregunta = $('#txtPregunta').val();

  $.ajax({
    type: 'POST',
    url: '/api/saveQuestions',
    data: { id, pregunta },

    success: function (data) {
      notificaciones(data);
    },
  });
});

/* Actualizar tabla */

function refreshTable() {
  $('#tblPreguntas').DataTable().clear();
  $('#tblPreguntas').DataTable().ajax.reload();
  $('#txtIdPregunta').val('');
  $('#txtPregunta').val('');
  $('#btnAlmacenarPregunta').html('Adicionar');
}
