$(document).ready(function () {
  let dataPlaneacion = [];
  dataTanquesPlaneacion = [];
  idTanque = 0;

  $(document).on('click', '.link-select', function () {
    let id = this.id;
    let idPlan = id.slice(8, id.length);

    if ($(`#${id}`).is(':checked')) {
      let dataPlan = tablaBatchPlaneados.row($(this).parents('tr')).data();

      let estado = dataPlan.estado;

      // El estado puede venir como texto descriptivo o como número
      // Convertir a número para la comparación
      let estadoNumero = estado;
      if (typeof estado === 'string') {
        if (estado === 'Inactivo') {
          estadoNumero = 1;
        } else if (estado === 'Falta Formula e Instructivo') {
          estadoNumero = 0;
        } else {
          estadoNumero = parseInt(estado) || 0;
        }
      }
      
      console.log('🔍 planeacion.js - Estado recibido:', estado, 'Tipo:', typeof estado, 'Convertido a:', estadoNumero);
      
      if (estadoNumero == 1) {
        /* Calculo tamaño lote - ajuste */

        planeacion = {
          id: idPlan,
          granel: dataPlan.granel,
          producto: dataPlan.nombre_referencia,
          referencia: dataPlan.id_producto,
          fecha_planeacion: dataPlan.fecha_programacion,
          fecha_insumo: dataPlan.fecha_insumo,
          numPedido: dataPlan.pedido,
          cantidad_acumulada: dataPlan.unidad_lote,
          tamanio_lote: dataPlan.tamano_lote,
          ajuste: dataPlan.ajuste,
        };

        dataPlaneacion.push(planeacion);
      } else {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('No es posible programar este pedido');
        $(`#${id}`).prop('checked', false);
        return false;
      }
    } else {
      for (i = 0; i < dataPlaneacion.length; i++) {
        if (dataPlaneacion[i].id == idPlan) {
          dataPlaneacion.splice(i, 1);
        }
      }
    }
  });

  $('#btnProgramar').click(function (e) {
    e.preventDefault();

    if (dataPlaneacion.length == 0) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Seleccione pedido para planear');
      return false;
    }

    $('#formCreateTanques').trigger('reset');
    $('#formCreateTanques').css('border-color', '');

    $.ajax({
      type: 'POST',
      url: '/api/programPlan',
      data: { data: dataPlaneacion },
      success: function (resp) {
        alertifyProgramar(resp);
      },
    });
  });

  alertifyProgramar = (data) => {
    console.log('🔍 alertifyProgramar - Datos recibidos:', data);
    console.log('🔍 alertifyProgramar - Tipo de datos:', typeof data);
    console.log('🔍 alertifyProgramar - Es array:', Array.isArray(data));
    
    // Si data es un string, intentar parsearlo
    if (typeof data === 'string') {
      try {
        // Si hay HTML mezclado con JSON, extraer solo el JSON
        if (data.includes('<br />') || data.includes('<b>Warning</b>')) {
          console.log('🔍 alertifyProgramar - Detectado HTML mezclado con JSON');
          // Buscar el JSON válido después del último </b>
          const jsonStart = data.lastIndexOf('</b>') + 4;
          const jsonPart = data.substring(jsonStart).trim();
          console.log('🔍 alertifyProgramar - JSON extraído:', jsonPart);
          data = JSON.parse(jsonPart);
        } else {
          data = JSON.parse(data);
        }
        console.log('🔍 alertifyProgramar - Datos parseados desde string:', data);
      } catch (e) {
        console.error('❌ alertifyProgramar - Error parseando JSON:', e);
        console.error('❌ alertifyProgramar - Datos problemáticos:', data);
        alertify.error('Error en los datos recibidos');
        return;
      }
    }
    
    // Validar que data sea un array
    if (!Array.isArray(data)) {
      console.error('❌ alertifyProgramar - data no es un array:', data);
      alertify.error('Formato de datos incorrecto');
      return;
    }
    
    count = data.length;
    console.log('🔍 alertifyProgramar - Número de registros:', count);

    totalCantAndLote = sumCantAndLote(data);

    alertify
      .confirm(
        'Samara Cosmetics',
        `<p>¿Desea programar los pedidos?</p><p><br></p>
                <table class="table table-striped dataTable text-center" aria-describedby="tablaPedidos_info">
                <thead>
                  <tr>
                    <th class="text-center">Granel</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Cantidad (Und)</th>
                    <th class="text-center">Tamaño (Kg)</th>
                    <th class="text-center" style="width: 131px">Tanques</th>
                    <th class="text-center">Cantidad (Tanques)</th>
                  </tr>
                </thead>
                <tbody>
                  <form id="formCreateTanques">
                    ${(row = addRowsPedidos(data))} 
                  </form>
                </tbody>
                <tfoot>
                  <tr >
                    <th></th>
                    <th></th>
                    <th class="text-center">${
                      totalCantAndLote.totalCantidades
                    }</th>
                    <th class="text-center">${totalCantAndLote.totalLotes.toFixed(
                      2
                    )}</th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
            </table><br>`,
        function () {
          let cant = document.getElementsByClassName('txtCantidad');
          let symbol = document.getElementsByClassName('symbolPedidos');

          save = true;

          for (i = 1; i < cant.length; i++) {
            if (cant[i].disabled == false) {
              cantidad = cant[i].value;

              if (!cantidad || cantidad == null) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('Ingrese fecha de programación');
                $(`#${cant[i].id}`).css('border-color', 'red');
                save = false;
                return false;
              }
            }
          }

          if (save == true)
            for (i = 0; i < symbol.length; i++) {
              if (symbol[i].id == 'correct') {
                break;
              }
              if (symbol[i].id == 'incorrect') {
                save = false;
              }
            }

          if (save == true) saveFechaProgramacion();
          else {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('No es posible programar los pedidos');
            return false;
          }
        },
        function () {
          dataPlaneacion = [];
          unique = [];
          dataTanquesPlaneacion = [];

          clearInputArray();
        }
      )
      .set('labels', { ok: 'Si', cancel: 'No' })
      .set({ closableByDimmer: false })
      .set('resizable', true)
      .resizeTo(1200, 548);

    cargarTanques();
  };

  sumCantAndLote = (data) => {
    console.log('🔍 sumCantAndLote - Datos recibidos:', data);
    console.log('🔍 sumCantAndLote - Tipo de datos:', typeof data);
    console.log('🔍 sumCantAndLote - Es array:', Array.isArray(data));
    
    // Validar que data sea un array
    if (!Array.isArray(data)) {
      console.error('❌ sumCantAndLote - data no es un array:', data);
      return {
        totalCantidades: 0,
        totalLotes: 0,
      };
    }
    
    totalCantidades = 0;
    totalLotes = 0;
    for (i = 0; i < data.length; i++) {
      console.log('🔍 sumCantAndLote - Registro', i, ':', data[i]);
      totalCantidades += (data[i].cantidad_acumulada || 0);
      totalLotes += (data[i].tamanio_lote || 0);
    }

    console.log('🔍 sumCantAndLote - Totales calculados:', { totalCantidades, totalLotes });

    totalCantAndLote = {
      totalCantidades: totalCantidades,
      totalLotes: totalLotes,
    };

    return totalCantAndLote;
  };

  addRowsPedidos = (data) => {
    console.log('🔍 addRowsPedidos - Datos recibidos:', data);
    console.log('🔍 addRowsPedidos - Tipo de datos:', typeof data);
    console.log('🔍 addRowsPedidos - Es array:', Array.isArray(data));
    
    // Si data es un string, intentar parsearlo como JSON
    if (typeof data === 'string') {
      try {
        data = JSON.parse(data);
        console.log('🔍 addRowsPedidos - Datos parseados desde string:', data);
      } catch (e) {
        console.error('❌ addRowsPedidos - Error parseando JSON:', e);
        return '';
      }
    }
    
    // Validar que data sea un array
    if (!Array.isArray(data)) {
      console.error('❌ addRowsPedidos - data no es un array:', data);
      return '';
    }
    
    console.log('🔍 addRowsPedidos - Número de registros:', data.length);
    
    row = [];
    for (i = 0; i < data.length; i++) {
      console.log('🔍 addRowsPedidos - Registro', i, ':', data[i]);
      console.log('🔍 addRowsPedidos - tamanio_lote:', data[i].tamanio_lote, 'Tipo:', typeof data[i].tamanio_lote);
      
      data[i].tamanio_lote > 2500 ? (dis = 'disabled') : (dis = '');

      row.push(`<tr ${(text = color(data[i].tamanio_lote))}>
                <td id="granel-${i}">${data[i].granel}</td>
                <td>${data[i].producto}</td>
                <td>${data[i].cantidad_acumulada}</td>
                <td id="tamanioLote-${i}">${(data[i].tamanio_lote || 0).toFixed(
        2
      )}</td>
                <td>
                  <select class="form-control-updated select-tanque" id="cmbTanque-${i}" ${dis}></select>
                </td>
                <td>
                  <input type="number" class="form-control-updated text-center txtCantidad" id="cantTanque-${i}" ${dis}>
                </td>
                ${(symbol = check(data[i].tamanio_lote))}
                </tr>`);
    }
    return row.join('');
  };

  saveFechaProgramacion = () => {
    let date = new Date();

    let year = date.getFullYear();

    let month = `${date.getMonth() + 1}`.padStart(2, 0);

    let day = `${date.getDate()}`.padStart(2, 0);

    let stringDate = `${[year, month, day].join('-')}`;

    alertify
      .prompt(
        'Programación',
        'Ingrese la fecha de programación',
        '',
        function (evt, value) {
          if (!value || value == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese fecha de programación');
            return false;
          }

          if (value < stringDate) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese una fecha apartir del dia de hoy');
            return false;
          }

          unique = Object.values(
            dataTanquesPlaneacion.reduce((a, c) => {
              a[c.granel] = c;
              return a;
            }, {})
          );

          unique.push({ date: value });

          savePlaneados(unique);
        },
        function () {
          dataPlaneacion = [];
          unique = [];
          dataTanquesPlaneacion = [];

          clearInputArray();
        }
      )
      .set('type', 'date')
      .set({ closableByDimmer: false });
  };

  // Función para determinar el color de la fila basado en el tamaño del lote
  color = (tamanioLote) => {
    if (!tamanioLote || tamanioLote === undefined || tamanioLote === null) {
      return '';
    }
    
    if (tamanioLote > 2500) {
      return 'style="background-color: #ffebee;"'; // Rojo claro
    } else if (tamanioLote > 2000) {
      return 'style="background-color: #fff3e0;"'; // Naranja claro
    } else {
      return ''; // Sin color
    }
  };

  // Función para mostrar símbolos de verificación basado en el tamaño del lote
  check = (tamanioLote) => {
    if (!tamanioLote || tamanioLote === undefined || tamanioLote === null) {
      return '';
    }
    
    if (tamanioLote > 2500) {
      return '<td class="text-center"><i class="fa fa-times-circle text-danger" id="incorrect"></i></td>';
    } else if (tamanioLote > 2000) {
      return '<td class="text-center"><i class="fa fa-exclamation-triangle text-warning" id="warning"></i></td>';
    } else {
      return '<td class="text-center"><i class="fa fa-check-circle text-success" id="correct"></i></td>';
    }
  };

  savePlaneados = (data) => {
    console.log('🚀 savePlaneados - Iniciando con datos:', data);
    console.log('🔍 savePlaneados - URL del endpoint: /api/saveBatchFromPlaneacion');
    
    $.ajax({
      type: 'POST',
      url: '/api/saveBatchFromPlaneacion',
      data: { data: data },
      success: function (response) {
        console.log('✅ savePlaneados - Respuesta exitosa:', response);
        message(response);
        unique = [];
        dataPlaneacion = [];
        dataTanquesPlaneacion = [];
        deleteSession();
        setTimeout(loadTotalVentas, 7000);
        if ($.fn.dataTable.isDataTable('#tblCalcCapacidadPlaneada')) {
          $('#tblCalcCapacidadPlaneada').DataTable().destroy();
        }
        $('#tblCalcCapacidadPlaneadaBody').empty();
        if ($.fn.dataTable.isDataTable('#tblCalcCapacidadProgramada')) {
          $('#tblCalcCapacidadProgramada').DataTable().destroy();
        }
        $('#tblCalcCapacidadProgramadaBody').empty();
        api = '/html/php/batch_planeados_fetch.php';
        getDataPlaneacion();
        api = '/html/php/batch_fetch.php';
        // Recargar la tabla de batch programados
        if ($.fn.DataTable.isDataTable('#tablaBatch')) {
          tablaBatch.ajax.reload();
        }
      },
      error: function(xhr, status, error) {
        console.error('❌ savePlaneados - Error en AJAX:', error);
        console.error('❌ savePlaneados - Status:', status);
        console.error('❌ savePlaneados - Response Text:', xhr.responseText);
        console.error('❌ savePlaneados - Status Code:', xhr.status);
        
        // Mostrar mensaje de error al usuario
        alertify.error('Error al crear el batch: ' + error);
      }
    });
  };
});
