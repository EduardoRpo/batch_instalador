$(document).ready(function () {
  pedidosProgramar = [];

  // Seleccionar checkbox
  $(document).on('blur', '.cantProgram', function (e) {
    e.preventDefault();
    id_input = this.id;
    id_checkbox = id_input.substr(5, id_input.length);
    referencia = fila.id_producto;
    numPedido = fila.pedido;
    cantidad = $(`#${id_input}`).val();
    date = $(`#date-${id_checkbox}`).val();

    if (cantidad == 0) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('La cantidad a programar no puede ser cero (0)');
      $(`#${id_checkbox}`).prop('checked', false);
      return false;
    }

    arrayPreprogramados(referencia, cantidad, numPedido);
    if (date) {
      fechaInsumo(id_checkbox, numPedido, referencia, pedidosProgramar, date);
    } else {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese fecha de insumo');
      $(`#${id_checkbox}`).prop('checked', false);
      return false;
    }
    $(`#${id_checkbox}`).prop('checked', true);
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
    pedidos.producto = fila.nombre_referencia;
    pedidos.granel = granel;
    pedidos.cantidad_acumulada = cantidad;

    pedidosProgramar.push(pedidos);
  };

  $(document).on('click', '#calcLote', function (e) {
    e.preventDefault();
    if (date) calcLote(pedidosProgramar);
    else {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese fecha de insumo');
      $(`#${id_checkbox}`).prop('checked', false);
      return false;
    }
  });

  calcLote = (data) => {
    $.ajax({
      type: 'POST',
      url: '/api/calcTamanioLote',
      data: { data: data },
      success: function (resp) {
        //Validar que se puedan guardar pedidos
        if (resp.error) {
          alertify.set('notifier', 'position', 'top-right');
          alertify.error(resp.message);
        }
        // Ventana alert confirm
        alertConfirm(resp);
      },
    });
  };

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
    id_input = id_date.substr(5, id_date.length);
    referencia = fila.id_producto;
    numPedido = fila.pedido;
    date = $(`#${id_date}`).val();

    if (date) {
      calcfechaSugeridas(date, id_input);
      fechaInsumo(id_input, numPedido, referencia, pedidosProgramar, date);
    }
  });

  calcfechaSugeridas = (date, id_input) => {
    //Fecha pesaje
    pesaje = new Date(date);

    pesaje.setDate(pesaje.getDate() + 9);

    $(`#pesaje-${id_input}`).html(
      pesaje.getFullYear() +
        '-' +
        (pesaje.getMonth() + 1 + '-' + pesaje.getDate())
    );

    //Fecha preparacion
    preparacion = new Date(date);
    preparacion.setDate(preparacion.getDate() + 10);

    $(`#preparacion-${id_input}`).html(
      preparacion.getFullYear() +
        '-' +
        (preparacion.getMonth() + 1 + '-' + preparacion.getDate())
    );

    //Fecha envasado
    envasado = new Date(date);
    envasado.setDate(envasado.getDate() + 13);

    $(`#envasado-${id_input}`).html(
      envasado.getFullYear() +
        '-' +
        (envasado.getMonth() + 1 + '-' + envasado.getDate())
    );

    //Fecha entrega
    entrega = new Date(date);
    entrega.setDate(entrega.getDate() + 16);

    $(`#entrega-${id_input}`).html(
      entrega.getFullYear() +
        '-' +
        (entrega.getMonth() + 1 + '-' + entrega.getDate())
    );
  };

  fechaInsumo = (
    id_checkbox,
    numPedido,
    referencia,
    pedidosProgramar,
    date
  ) => {
    cant = $(`#cant-${id_checkbox}`).val();
    if (cant > 0) {
      for (i = 0; i < pedidosProgramar.length; i++) {
        if (
          numPedido == pedidosProgramar[i].numPedido &&
          referencia == pedidosProgramar[i].referencia
        )
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
