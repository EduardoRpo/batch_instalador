$(document).ready(function () {
  sessionStorage.removeItem('id_envasado');
  /* Ocultar card  */
  $('.cardSaveEnvasado').hide();

  /* Mostrar card capacidad envasado */
  $(document).on('click', '.updateEnv', function () {
    id = this.id;

    sessionStorage.setItem('id_envasado', id);

    env = $(this).parent().parent().children().eq(1).text();
    t_1 = $(this).parent().parent().children().eq(2).text();
    t_2 = $(this).parent().parent().children().eq(3).text();
    t_3 = $(this).parent().parent().children().eq(4).text();

    $('#linea').val(env);
    $('#turno1').val(t_1);
    $('#turno2').val(t_2);
    $('#turno3').val(t_3);

    $('.cardSaveEnvasado').show(800);

    $('html, body').animate(
      {
        scrollTop: 0,
      },
      1000
    );
  });

  /* Guardar envasado */
  $('#saveEnvasado').click(function (e) {
    e.preventDefault();

    t_1 = $('#turno1').val();
    t_2 = $('#turno2').val();
    t_3 = $('#turno3').val();

    data = t_1 * t_2 * t_3;

    if (!data || data == 0) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('ingrese todos los datos');
      return false;
    }

    envasado = $('#formSaveEnvasado').serialize();

    id_envasado = sessionStorage.getItem('id_envasado');

    envasado = `${envasado}&idEnvasado=${id_envasado}`;

    $.post(
      '/api/updateCapacidadEnvasado',
      envasado,
      function (data, textStatus, jqXHR) {
        message(data);
      }
    );
  });

  /* Mensaje de exito */
  message = (data) => {
    alertify.set('notifier', 'position', 'top-right');

    if (data.success == true) {
      actualizarTabla();
      $('.cardSaveEnvasado').hide(800);
      alertify.success(data.message);
    } else if (data.error == true) alertify.error(data.message);
    else if (data.info == true) alertify.info(data.message);
  };

  /* Actualizar tabla */
  actualizarTabla = () => {
    $('#tblCapacidadEnvasado').DataTable().clear();
    $('#tblCapacidadEnvasado').DataTable().ajax.reload();
  };
});
