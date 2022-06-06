$(document).ready(function () {
  pedidosProgramar = [];

  // Seleccionar checkbox
  $(document).on('blur', '.cantProgram', function (e) {
    e.preventDefault();
    id_input = this.id;
    id_checkbox = id_input.substr(5, 13);
    referencia = id_input.substr(-7, 7);
    cantidad = $(`#${id_input}`).val();
    numPedido = id_checkbox.slice(0, -8);

    if (cantidad == 0) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('La cantidad a programar no puede ser cero (0)');
      $(`#${id_checkbox}`).prop('checked', false);
      return false;
    }

    arrayPreprogramados(referencia, cantidad, numPedido);

    date = $(`#date-${id_checkbox}`).val();
    if (date)
      fechaInsumo(
        `date-${id_checkbox}`,
        id_checkbox,
        numPedido,
        pedidosProgramar
      );
    else {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese fecha de insumo');
      $(`#${id_checkbox}`).prop('checked', false);
      return false;
    }
    $(`#${id_checkbox}`).prop('checked', true);
    /*for (i = 0; i < pedidosProgramar.length; i++) {
      if (pedidosProgramar[i].fecha_insumo == undefined)
        fechaInsumo(
          `date-${id_checkbox}`,
          id_checkbox,
          numPedido,
          pedidosProgramar
        );
    }*/
    //}
  });

  //Eliminar registros en el array

  $(document).on('change', '.checkboxPedidos', function (e) {
    e.preventDefault();
    id_checkbox = this.id;
    numPedido = id_checkbox.slice(0, -8);

    if (pedidosProgramar.length > 0) {
      $(`#cant-${id_checkbox}`).val('');
      $(`#date-${id_checkbox}`).val('');
      deleteArray(numPedido);
    } else $(`#${id_checkbox}`).prop('checked', false);
  });

  arrayPreprogramados = (referencia, cantidad, numPedido) => {
    /* validar que el numero de pedido y referencia no esten en el array e insertar 
          de los contrario actualizar la cantidad */

    for (i = 0; i < pedidosProgramar.length; i++) {
      if (
        (referencia == pedidosProgramar[i].referencia &&
          numPedido == pedidosProgramar[i].numPedido &&
          cantidad != pedidosProgramar[i].cantidad) ||
        cantidad == pedidosProgramar[i].cantidad
      )
        deleteArray(numPedido);
    }

    pedidos = {};
    granel = fila.granel;

    pedidos.numPedido = numPedido;
    pedidos.referencia = referencia;
    pedidos.granel = granel;
    pedidos.cantidad_acumulada = cantidad;

    pedidosProgramar.push(pedidos);
  };

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
    id_input = id_date.substr(5, 13);
    numPedido = id_date.slice(5, -8);

    fechaInsumo(id_date, id_input, numPedido, pedidosProgramar);
  });

  fechaInsumo = (id_date, id_checkbox, numPedido, pedidosProgramar) => {
    cant = $(`#cant-${id_checkbox}`).val();

    if (cant > 0) {
      date = $(`#${id_date}`).val();
      for (i = 0; i < pedidosProgramar.length; i++) {
        if (numPedido == pedidosProgramar[i].numPedido)
          pedidosProgramar[i]['fecha_insumo'] = date;
      }
      $(`#${id_checkbox}`).prop('checked', true);
    } else {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese cantidad a programar');
      return false;
    }
  };
});
