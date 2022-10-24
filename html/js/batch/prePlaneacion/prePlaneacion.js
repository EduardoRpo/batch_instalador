$(document).ready(function () {
  $('.cardUpdatePrePlaneado').hide();
  let dataPrePlaneacion = [];
  sessionStorage.removeItem('id');

  // Limpiar información
  $('#btnLimpiar').click(function (e) {
    e.preventDefault();

    alertify
      .confirm(
        'Samara Cosmetics',
        `<p>Eliminar simulación</p><p><br></p>
                    <select id="simulacion" class="form-control">
                      <option selected disabled>Seleccionar</option>
                      <option value="1">Simulación 1</option>
                      <option value="2">Simulación 2</option>
                    </select>`,
        function () {
          val = $('#simulacion').val();
          if (!val || val == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Seleccione la simulación');
            return false;
          }

          clearData(val);
        },
        function () {
          alertify.error('Cancel');
        }
      )
      .set('labels', { ok: 'Guardar', cancel: 'Cancelar' })
      .set({ closableByDimmer: false })
      .set('resizable', true);
  });

  clearData = (simulacion) => {
    $.get(
      `/api/clearPrePlaneados/${simulacion}`,
      function (data, textStatus, jqXHR) {
        message(data);
      }
    );
  };

  /* Planear pedido */
  $('#btnPlanear').click(function (e) {
    e.preventDefault();
    data = tableBatchPrePlaneacion.rows().data();

    if (data.length == 0) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('No hay pedidos a planear');
      return false;
    } else {
      /* Cargar datos */
      for (i = 0; i < data.length; i++) {
        dataPrePlaneacion.push({ id: data[i].id });
      }

      $.ajax({
        type: 'POST',
        url: '/api/updatePlaneados',
        data: { data: dataPrePlaneacion },
        success: function (resp) {
          dataPrePlaneacion = [];
          message(resp);
        },
      });
    }
  });

  /* Modificar pedido */
  $(document).on('click', '.link-editar-pre', function () {
    id = this.id;
    sessionStorage.setItem('id', id);
    $('.cardPlanning').toggle(800);

    pedido = $(this).parent().parent().children().eq(1).text();
    granel = $(this).parent().parent().children().eq(2).text();
    referencia = $(this).parent().parent().children().eq(3).text();
    unidad = $(this).parent().parent().children().eq(6).text();

    $('#num_pedido').val(pedido);
    $('#name_granel').val(granel);
    $('#ref_product').val(referencia);
    $('#unity').val(unidad);

    $('.cardUpdatePrePlaneado').toggle(800);
    $('html, body').animate(
      {
        scrollTop: 0,
      },
      1000
    );
  });

  $('#savePrePlaneado').click(function (e) {
    e.preventDefault();

    unidad = $('#unity').val();

    if (!unidad || unidad <= 0) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese unidad de lote valida');
      return false;
    }

    id = sessionStorage.getItem('id');

    prePlaneacion = { id: id, unidad: unidad };

    $.post(
      '/api/updateUnidadLote',
      prePlaneacion,
      function (data, textStatus, jqXHR) {
        $('.cardUpdatePrePlaneado').hide(800);
        $('.cardPlanning').show(800);
        $('#formUpdatePrePlaneado').trigger('reset');
        message(data);
      }
    );
  });

  /* Eliminar pedido */
  $(document).on('click', '.link-borrar-pre', function () {
    id = this.id;

    alertify
      .confirm(
        'Samara Cosmetic',
        '<p>¿ Estas seguro de eliminar este pedido ?</p><br>',
        function () {
          $.get(
            `/api/deletePrePlaneacion/${id}`,
            function (data, textStatus, jqXHR) {
              message(data);
            }
          );
        },
        function () {
          alertify.error('Cancel');
        }
      )
      .set('labels', { ok: 'Eliminar', cancel: 'Cancelar' })
      .set({ closableByDimmer: false });
  });
});
