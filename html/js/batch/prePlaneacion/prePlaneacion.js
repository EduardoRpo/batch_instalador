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
    sim = $('#tipoSimulacion').val();

    if (!sim) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Seleccione la simulación para planear');
      return false;
    }

    if (data.length == 0) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('No hay pedidos a planear');
      return false;
    } else {
      /* Cargar datos */
      for (i = 0; i < data.length; i++) {
        if (data[i].sim == sim) dataPrePlaneacion.push({ id: data[i].id });
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

    data = tableBatchPrePlaneacion.row($(this).parents('tr')).data();

    $('#num_pedido').val(data.pedido);
    $('#name_granel').val(data.granel);
    $('#ref_product').val(data.id_producto);
    $('#unity').val(data.unidad_lote);

    densidad = data.densidad;
    ajuste = data.ajuste;
    presentacion = data.presentacion;

    $('.cardUpdatePrePlaneado').toggle(800);
    $('html, body').animate(
      {
        scrollTop: 0,
      },
      500
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

    prePlaneacion = {
      id: id,
      densidad: densidad,
      ajuste: ajuste,
      presentacion: presentacion,
      unidad: unidad,
    };

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
