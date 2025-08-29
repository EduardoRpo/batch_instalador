$(document).ready(function () {
  pedidosProgramar = [];
  let date;
  let cantidad;

  // Seleccionar checkbox
  $(document).on('blur', '.cantProgram', function (e) {
    e.preventDefault();
    id_input = this.id.trim();
    num = fila.num;
    referencia = fila.id_producto.trim();
    numPedido = fila.pedido;
    cantidad = $(`#${id_input}`).val();
    date = $(`#date-${numPedido}-${referencia}`).val();

    if (cantidad == 0) {
      deleteArray(numPedido);
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('La cantidad a programar no puede ser cero (0)');
      return false;
    }

    arrayPreprogramados(num, referencia, cantidad, numPedido);
    if (date) {
      fechaInsumo(numPedido, referencia, pedidosProgramar, date);
    } else {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese fecha de insumo');
      return false;
    }
  });

  arrayPreprogramados = (num, referencia, cantidad, numPedido) => {
    /* validar que el numero de pedido y referencia no esten en el array e insertar 
              de los contrario actualizar la cantidad */

    for (i = 0; i < pedidosProgramar.length; i++) {
      if (num == pedidosProgramar[i].num) deleteArray(num);
    }

    pedidos = {};

    pedidos.num = num;
    pedidos.numPedido = numPedido;
    pedidos.referencia = referencia;
    pedidos.producto = fila.nombre_referencia;
    pedidos.granel = fila.granel;
    pedidos.cantidad_acumulada = cantidad;
    pedidos.valor_pedido = fila.valor_pedido;

    pedidosProgramar.push(pedidos);
  };

  $(document).on('click', '#calcLote', function (e) {
    e.preventDefault();
    console.log('🚀 Botón Calcular Lote clickeado');
    console.log('🔍 date:', date);
    console.log('🔍 cantidad:', cantidad);
    console.log('🔍 pedidosProgramar.length:', pedidosProgramar.length);
    console.log('🔍 pedidosProgramar:', pedidosProgramar);
    
    if (date && cantidad && pedidosProgramar.length > 0) {
      console.log('✅ Validaciones pasadas, llamando a calcLote...');
      calcLote(pedidosProgramar);
    } else {
      console.log('❌ Validaciones fallaron');
      alertify.set('notifier', 'position', 'top-right');
      alertify.error(
        'Ingrese la cantidad a programar y fecha de recepción de insumos'
      );
      return false;
    }
  });

  calcLote = (data) => {
    console.log('🚀 calcLote ejecutándose con datos:', data);
    console.log('🔍 Referencias en data:', data.map(item => item.referencia || item.granel));
    console.log('🔍 Datos completos:', JSON.stringify(data, null, 2));
    
    // Log detallado de cada pedido
    data.forEach((pedido, index) => {
      console.log(`🔍 Pedido ${index}:`, {
        referencia: pedido.referencia,
        granel: pedido.granel,
        cantidad_acumulada: pedido.cantidad_acumulada,
        producto: pedido.producto
      });
    });
    
    // Establecer bandera para evitar modal de simulación
    window.fromCalcLote = true;
    
    console.log('📤 Enviando datos a /api/calc-lote-directo...');
    
    $.ajax({
      url: '/api/calc-lote-directo',
      type: 'POST',
      data: JSON.stringify(data),
      contentType: 'application/json',
      processData: false,
      success: function (resp) {
        console.log('✅ Respuesta de la API calc-lote-directo:', resp);
        console.log('🔍 Referencias en respuesta:', resp.pedidosLotes?.map(item => item.referencia || item.granel));
        
        // Log temporal para debugging completo
        console.log('🔍 RESPUESTA COMPLETA DE LA API:', JSON.stringify(resp, null, 2));
        
        // Log detallado de la respuesta
        if (resp.pedidosLotes && Array.isArray(resp.pedidosLotes)) {
          console.log('🔍 Tamaños de lote calculados:');
          resp.pedidosLotes.forEach((pedido, index) => {
            console.log(`  - ${pedido.referencia || pedido.granel}: ${pedido.tamanio_lote} kg`);
            console.log(`    Datos del pedido:`, {
              densidad: pedido.densidad,
              presentacion: pedido.presentacion,
              ajuste: pedido.ajuste,
              cantidad: pedido.cantidad_acumulada
            });
          });
        }
        
        // Debug: ver qué está devolviendo la API
        // Validar que se puedan guardar pedidos
        if (resp.error) {
          alertify.set('notifier', 'position', 'top-right');
          alertify.error(resp.message);
        }
        // Ventana alert confirm
        alertConfirm(resp);
      },
      error: function (xhr, status, error) {
        console.error('❌ Error en AJAX:', {xhr, status, error});
        console.error('❌ Status:', xhr.status);
        console.error('❌ StatusText:', xhr.statusText);
        console.error('❌ ResponseText:', xhr.responseText);
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Error al calcular lote: ' + error + ' (Status: ' + xhr.status + ')');
      }
    });
  };

  deleteArray = (num) => {
    for (i = 0; i < pedidosProgramar.length; i++) {
      if (pedidosProgramar[i].num == num) {
        pedidosProgramar.splice(i, 1);
      }
    }
  };

  // Fecha inicio
  $(document).on('change', '.dateInsumos', function (e) {
    e.preventDefault();
    id_date = this.id.trim();
    id_input = id_date.substr(5, id_date.length);
    referencia = fila.id_producto.trim();
    numPedido = fila.pedido;
    date = $(`#${id_date}`).val();

    if (date) {
      calcfechaSugeridas(date, id_input);
      fechaInsumo(numPedido, referencia, pedidosProgramar, date);
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

  fechaInsumo = (numPedido, referencia, pedidosProgramar, date) => {
    cantidad = $(`#cant-${numPedido}-${referencia}`).val();
    if (cantidad > 0) {
      for (i = 0; i < pedidosProgramar.length; i++) {
        if (
          numPedido == pedidosProgramar[i].numPedido &&
          referencia == pedidosProgramar[i].referencia
        )
          pedidosProgramar[i]['fecha_insumo'] = date;
      }
      // $(`#${id_checkbox}`).prop('checked', true);
    } else {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese cantidad a programar');
      return false;
    }
  };

  clearVariables = () => {
    date = null;
    cantidad = 0;
  };
});
