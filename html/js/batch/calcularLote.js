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
    id_checkbox = this.id;
    referencia = id_checkbox.substr(-7, 7);
    cantidad = $(`#cant-${id_checkbox}`).val();
    numPedido = id_checkbox.slice(0, -8);

    for (i = 0; i < pedidosProgramar.length; i++) {
      if (
        referencia == pedidosProgramar[i].referencia &&
        //cantidad == pedidosProgramar[i].cantidad &&
        numPedido == pedidosProgramar[i].numPedido
      )
        deleteArray(numPedido);
    }

    if ($(this).is(':checked')) {
      pedidos = {};

      //cantidad = $(`#cant-${referencia}`).val();
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
      pedidos.numPedido = numPedido;

      pedidosProgramar.push(pedidos);
    } else {
      $(`#cant-${id_checkbox}`).val('');

      // Eliminar objeto del array
      deleteArray(numPedido);
    }
  });

  // Seleccionar checkbox
  $(document).on('blur', '.cantProgram', function (e) {
    e.preventDefault();
    id_input = this.id;
    id_checkbox = id_input.substr(5, 13);
    referencia = id_input.substr(-7, 7);
    cantidad = $(`#${id_input}`).val();
    numPedido = id_checkbox.slice(0, -8);

    // Si ya existe una cantidad en esa fila remplazarla
    if (pedidosProgramar.length > 0) {
      // Eliminar objeto del array
      for (i = 0; i < pedidosProgramar.length; i++) {
        if (
          referencia == pedidosProgramar[i].referencia &&
          numPedido == pedidosProgramar[i].numPedido &&
          cantidad != pedidosProgramar[i].cantidad
        ) {
          deleteArray(numPedido);
          $('.checkboxPedidos').change();
        }
      }
    }

    if ($(`#${id_checkbox}`).is(':checked')) {
      if (cantidad == '') $(`#${id_checkbox}`).prop('checked', false);
    } else {
      $(`#${id_checkbox}`).prop('checked', true);
    }
    $('.checkboxPedidos').change();
  });

  $(document).on('click', '#calcLote', function (e) {
    e.preventDefault();
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

  deleteArray = (numPedido) => {
    for (i = 0; i < pedidosProgramar.length; i++) {
      if (pedidosProgramar[i].numPedido == numPedido) {
        pedidosProgramar.splice(i, 1);
      }
    }
  };

  // Fecha inicio
  $(document).on('blur', '.dateInsumos', function (e) {
    e.preventDefault();
    id_date = this.id;
  });
});
