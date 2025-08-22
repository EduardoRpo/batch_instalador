// Función global para mostrar el modal de confirmación
alertConfirm = (data) => {
  console.log('🚀 alertConfirm ejecutándose con datos:', data);
  console.log('🔍 Tipo de data:', typeof data);
  console.log('🔍 data es null/undefined:', data === null || data === undefined);
  console.log('🔍 data.pedidosLotes existe:', data && data.pedidosLotes);
  console.log('🔍 data.pedidosLotes es array:', Array.isArray(data && data.pedidosLotes));
  
  // Validar que data y data.pedidosLotes existan
  if (!data) {
    console.error('❌ Error: data es null o undefined');
    alertify.set('notifier', 'position', 'top-right');
    alertify.error('Error: No se recibieron datos del cálculo de lote');
    return;
  }
  
  if (!data.pedidosLotes) {
    console.error('❌ Error: data.pedidosLotes no existe');
    console.log('🔍 Propiedades disponibles en data:', Object.keys(data));
    alertify.set('notifier', 'position', 'top-right');
    alertify.error('Error: No se encontraron pedidos en la respuesta');
    return;
  }
  
  if (!Array.isArray(data.pedidosLotes)) {
    console.error('❌ Error: data.pedidosLotes no es un array');
    console.log('🔍 Tipo de data.pedidosLotes:', typeof data.pedidosLotes);
    alertify.set('notifier', 'position', 'top-right');
    alertify.error('Error: Formato de datos incorrecto');
    return;
  }

  console.log('✅ Datos válidos, mostrando modal...');
  console.log('🔍 Número de pedidos:', data.pedidosLotes.length);
  console.log('🔍 Primer pedido:', data.pedidosLotes[0]);
  
  countPrePlaneados = data.countPrePlaneados || 0;

  alertify
    .confirm(
      'Samara Cosmetics',
      `<p>¿Desea preplanear los siguientes pedidos?</p><br>
          <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="text-center">Granel</th>
                  <th class="text-center">Producto</th>
                  <th class="text-center">Tamaño Lote (Kg)</th>
                  <th class="text-center">Cantidad (Und)</th>
                </tr>
              </thead>
              <tbody>
                ${(row = addRows(data.pedidosLotes))}
              </tbody>
          </table><br>`,
      function () {
        console.log('✅ Usuario confirmó el modal');
        let symbol = document.getElementsByClassName('symbolPedidos');
        save = true;

        for (i = 0; i < symbol.length; i++) {
          if (symbol[i].id == 'correct') {
            break;
          }
          if (symbol[i].id == 'incorrect') {
            save = false;
          }
        }

        if (save == true) saveFechaPlaneacion();
        else {
          alertify.set('notifier', 'position', 'top-right');
          alertify.error('No es posible preplanear los pedidos');
          return false;
        }
      },
      function () {
        console.log('❌ Usuario canceló el modal');
        clearInputArray();
      }
    )
    .set('labels', { ok: 'Si', cancel: 'No' })
    .set({ closableByDimmer: false })
    .set('resizable', true)
    .resizeTo(800, 500);
    
  console.log('🎯 Modal configurado y mostrado');
};

// Función para agregar filas a la tabla
addRows = (data) => {
  row = [];
  for (i = 0; i < data.length; i++) {
    row.push(`<tr ${(text = color(data[i].tamanio_lote))}>
              <td>${data[i].granel}</td>
              <td>${data[i].producto}</td>
              <td>${data[i].tamanio_lote.toFixed(2)}</td>
              <td>${data[i].cantidad_acumulada}</td>
              ${(symbol = check(data[i].tamanio_lote))}
              </tr>`);
  }
  return row.join('');
};

// Función para determinar el color de la fila
color = (tamanio) => {
  if (tamanio > 2500) text = 'style="color: red"';
  else text = 'aria-describedby="tablaPedidos_info"';

  return text;
};

// Función para mostrar el símbolo de verificación
check = (tamanio) => {
  if (tamanio > 2500) {
    symbol =
      '<td class="symbolPedidos" id="incorrect" style="font-size:22px; font-weight: bold; color:red;">&#x2716</td>';
  } else
    symbol =
      '<td class="symbolPedidos" id="correct" style="font-size:22px; font-weight: bold; color:green;">&#x2714</td>';

  return symbol;
};

$(document).ready(function () {

  //Opcion SI
  saveFechaPlaneacion = () => {
    let date = new Date();

    let year = date.getFullYear();

    let month = `${date.getMonth() + 1}`.padStart(2, 0);

    let day = `${date.getDate()}`.padStart(2, 0);

    let stringDate = `${[year, month, day].join('-')}`;

    alertify
      .prompt(
        'Planeación',
        'Ingrese la fecha de planeación',
        '',
        function (evt, value) {
          if (!value || value == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese fecha de planeación');
            return false;
          }

          if (value < stringDate) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese una fecha apartir del dia de hoy');
            return false;
          }

          dataPrePlaneados = {};

          dataPrePlaneados.date = value;

          if (countPrePlaneados == 0) {
            dataPrePlaneados.simulacion = 1;
            savePrePlaneados(dataPrePlaneados);
          } else {
            // Solo mostrar modal de simulación si NO viene del cálculo de lote
            if (!window.fromCalcLote) {
              alertSimulacion();
            } else {
              dataPrePlaneados.simulacion = 1;
              savePrePlaneados(dataPrePlaneados);
              // Resetear la bandera después de usarla
              window.fromCalcLote = false;
            }
          }
        },
        function () {
          deleteSession();
        }
      )
      .set('type', 'date')
      .setting({ min: stringDate })
      .set({ closableByDimmer: false });
  };

  // Seleccionar tipo de simulación
  alertSimulacion = () => {
    alertify
      .confirm(
        'Samara Cosmetics',
        `<p>Cargar Pedido(s) en simulación:</p><p><br></p>
                  <select id="simulacion" class="form-control">
                    <option selected disabled>Seleccionar</option>
                    <option value="1">Escenario 1</option>
                    <option value="2">Escenario 2</option>
                  </select>`,
        function () {
          val = $('#simulacion').val();
          if (!val || val == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Seleccione tipo de simulación');
            return false;
          }

          dataPrePlaneados.simulacion = val;
          savePrePlaneados(dataPrePlaneados);
        },
        function () {
          deleteSession();
        }
      )
      .set('labels', { ok: 'Guardar', cancel: 'Cancelar' })
      .set({ closableByDimmer: false })
      .set('resizable', true);
    // .resizeTo(800, 500);
  };

  savePrePlaneados = (data) => {
    console.log('🚀 savePrePlaneados ejecutándose con datos:', data);
    
    $.ajax({
      type: 'POST',
      url: '/api/addPrePlaneados',
      data: data,
      success: function (response) {
        console.log('✅ savePrePlaneados - Respuesta exitosa:', response);
        generalPedidos(response);
      },
      error: function (xhr, status, error) {
        console.error('❌ savePrePlaneados - Error AJAX:', {xhr, status, error});
        console.error('❌ savePrePlaneados - Status:', xhr.status);
        console.error('❌ savePrePlaneados - ResponseText:', xhr.responseText);
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Error al guardar pedidos: ' + error);
      }
    });
  };

  generalPedidos = async (data) => {
    console.log('🚀 generalPedidos ejecutándose con datos:', data);
    console.log('🔍 generalPedidos - Tipo de data:', typeof data);
    console.log('🔍 generalPedidos - data.error:', data.error);
    console.log('🔍 generalPedidos - data.message:', data.message);
    
    await message(data);
    console.log('✅ message() completado');

    pedidosProgramar.splice(0, pedidosProgramar.length);
    console.log('✅ pedidosProgramar limpiado');
    
    await deleteSession();
    console.log('✅ deleteSession() completado');
    
    console.log('🔍 Verificando si loadTotalVentas está definida:', typeof loadTotalVentas);
    console.log('🔍 loadTotalVentas:', loadTotalVentas);
    
    if (typeof loadTotalVentas === 'function') {
      console.log('✅ loadTotalVentas es una función, programando ejecución...');
      setTimeout(loadTotalVentas, 7000);
    } else {
      console.error('❌ loadTotalVentas NO está definida como función');
      console.log('🔍 Intentando definir loadTotalVentas como función vacía...');
      loadTotalVentas = () => {
        console.log('⚠️ loadTotalVentas ejecutada como función temporal');
      };
      setTimeout(loadTotalVentas, 7000);
    }
    
    api = '/api/prePlaneados';
    console.log('✅ api configurado:', api);
    
    if ($.fn.dataTable.isDataTable('#tblCalcCapacidadPrePlaneado')) {
      $('#tblCalcCapacidadPrePlaneado').DataTable().destroy();
      console.log('✅ DataTable destruido');
    }
    
    $('#tblCalcCapacidadPrePlaneadoBody').empty();
    console.log('✅ tbody limpiado');
    
    await getDataPrePlaneacion();
    console.log('✅ getDataPrePlaneacion() completado');
    
    setTimeout(alignTHeader, 2000);
    console.log('✅ alignTHeader programado');
    
    console.log('🎯 generalPedidos completado exitosamente');
  };

  // Opcion NO
  clearInputArray = () => {
    clearVariables();
    $('#tablaPedidos').DataTable().ajax.reload();
    $('#tablaBatchPlaneados').DataTable().ajax.reload();
    deleteSession();
    pedidosProgramar.splice(0, pedidosProgramar.length);
  };

  //Ir al backend y borrar la variable de Session $dataPedidos
  deleteSession = () => {
    $.ajax({
      type: 'GET',
      url: '/api/eliminarLote',
    });
  };
});
