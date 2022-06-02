$(document).ready(function () {
  const pedidosProgramar = [];

  /*    $(document).on('click', '#calcLote', function(e) {
             e.preventDefault();
             $("input:checkbox:checked").each(
                 function() {
                     alert("El checkbox con valor " + this.id + " está seleccionado");
                 }
             );
         });
      */

  /* Cargar la data de la fila */

  $('#tablaPreBatch tbody').on('click', 'tr', function () {
    fila = tablaPreBatch.row(this).data();
  });

  $(document).on('change', '.checkboxPedidos', function (e) {
    e.preventDefault();
    referencia = this.id;
    cantidad = $(`#cant-${referencia}`).val();

    /*for (i = 0; i < pedidosProgramar.length; i++) {
      if (
        referencia == pedidosProgramar[i].referencia &&
        cantidad == pedidosProgramar[i].cantidad
      )
        deleteArray(referencia);
    }*/

    if ($(this).is(':checked')) {
      pedidos = {};

      cantidad = $(`#cant-${referencia}`).val();
      granel = fila.granel;

      if (cantidad == 0) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('La cantidad a programar no puede ser cero (0)');
        $(this).prop('checked', false);
        return false;
      }

      pedidos.referencia = referencia;
      pedidos.cantidad = cantidad;
      pedidos.granel = granel;

      pedidosProgramar.push(pedidos);
    } else {
      $(`#cant-${referencia}`).val('');

      // Eliminar objeto del array
      deleteArray(referencia);
    }
  });

  // Seleccionar checkbox
  $(document).on('blur', '.cantProgram', function (e) {
    id_input = this.id;
    id_checkbox = id_input.substr(5, 9);
    cantidad = $(`#${id_input}`).val();

    // Si ya existe una cantidad en esa fila remplazarla
    if (pedidosProgramar.length > 0) {
      // Eliminar objeto del array
      for (i = 0; i < pedidosProgramar.length; i++) {
        if (
          id_checkbox == pedidosProgramar[i].referencia &&
          cantidad != pedidosProgramar[i].tamanio
        ) {
          deleteArray(id_checkbox);
          $('.checkboxPedidos').change();
        }
      }
    }

    if (!$(`#${id_checkbox}`).is(':checked') && cantidad > 0) {
      $(`#${id_checkbox}`).prop('checked', true);
      $('.checkboxPedidos').change();
    }
  });

  $(document).on('click', '#calcLote', function (e) {
    $.ajax({
      type: 'POST',
      url: '/api/calcTamanioLote',
      data: { data: pedidosProgramar },
      success: function (resp) {
        // Ventana alert confirm
        alertConfirm(resp);
      },
    });
  });

  deleteArray = (referencia) => {
    for (i = 0; i < pedidosProgramar.length; i++) {
      if (pedidosProgramar[i].referencia == referencia) {
        pedidosProgramar.splice(i, 1);
      }
    }
  };
});
