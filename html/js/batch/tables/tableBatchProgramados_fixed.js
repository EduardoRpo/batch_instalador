$(document).ready(function () {
  btnDeleteMulti = true;

  // Verificar si la tabla ya está inicializada
  if ($.fn.DataTable.isDataTable('#tablaBatch')) {
    console.log('Tabla tablaBatch ya está inicializada, destruyendo...');
    $('#tablaBatch').DataTable().destroy();
  }
  
  // Configuración de DataTables para tabla de batch programados
  // Definir tablaBatch como variable global para que otros archivos puedan acceder
  tablaBatch = $('#tablaBatch').DataTable({
    pageLength: 50,
    responsive: true,
    scrollCollapse: true,
    language: {
      url: '../../../admin/sistema/admin_componentes/es-ar.json',
    },
    oSearch: { bSmart: false },
    order: [[1, 'desc']], // Ordenar por Batch descendente

    ajax: {
      url: '/html/php/batch_fetch.php',
      type: 'POST',
      dataSrc: function(json) {
        console.log('=== DATOS RECIBIDOS PROGRAMADOS ===');
        console.log('Total registros:', json.recordsTotal);
        console.log('Datos recibidos:', json.data ? json.data.length : 0);
        if (json.data && json.data.length > 0) {
          console.log('Primera fila:', json.data[0]);
        }
        return json.data || [];
      }
    },
    
    columns: [
      /*
      {
        // Columna de selección (radio button)
        title: '',
        data: null,
        orderable: false,
        searchable: false,
        width: '30px',
        defaultContent: '<input type="radio" name="optradio" class="link-select">'
      },
      */
      {
        // Columna Batch
        title: 'Batch',
        data: 1,
        width: '80px'
      },
      {
        // Columna Referencia
        title: 'Referencia',
        data: 2,
        className: 'uniqueClassName',
        width: '120px'
      },
      {
        // Columna Producto
        title: 'Producto',
        data: 3,
        width: '300px'
      },
      {
        // Columna No Lote
        title: 'No Lote',
        data: 4,
        width: '120px'
      },
      {
        // Columna Tamaño Lote
        title: 'Tamaño Lote',
        data: 5,
        className: 'uniqueClassName',
        width: '100px',
        render: $.fn.dataTable.render.number('.', ',', 2, '')
      },
      /*
      {
        // Columna Sem Plan
        title: 'Sem Plan',
        data: 6,
        className: 'uniqueClassName',
        width: '80px',
        render: function (data) {
          return data ? `S${data}` : '';
        }
      },
      {
        // Columna Sem Prog
        title: 'Sem Prog',
        data: 7,
        className: 'uniqueClassName',
        width: '80px',
        render: function (data) {
          return data ? `S${data}` : '';
        }
      },
      */
      {
        // Columna Fecha Programación
        title: 'Fecha Programación',
        data: 8,
        className: 'uniqueClassName',
        width: '120px'
      },
      {
        // Columna Estado
        title: 'Estado',
        data: 9,
        className: 'uniqueClassName',
        width: '150px',
        render: function (data, type, row) {
          if (type === 'display') {
            switch(parseInt(data)) {
              case 1: return 'Sin Formula y/o Instructivo';
              case 2: return 'Inactivo';
              case 3: return 'Pesaje';
              case 3.5: return 'Preparación';
              case 4: return 'Preparación';
              case 4.5: return 'Aprobación';
              case 5: return 'Aprobación';
              case 5.5: return 'Envasado/Acondicionamiento';
              case 6: return 'Envasado/Acondicionamiento';
              case 6.5: return 'Microbiologia/Fisicoquimico';
              case 7: return 'Microbiologia/Fisicoquimico';
              case 7.5: return 'Microbiologia/Fisicoquimico';
              case 8: return 'Microbiologia/Fisicoquimico';
              case 8.5: return 'Microbiologia/Fisicoquimico';
              case 10: return 'Liberacion Lote';
              default: return 'Cerrado';
            }
          }
          return data;
        }
      },
      {
        // Columna Obs (Observaciones)
        title: 'Obs',
        data: 10,
        className: 'uniqueClassName',
        width: '80px',
        orderable: false,
        searchable: false,
        render: function (data) {
          // Verificar si data existe y tiene las propiedades necesarias
          if (data && typeof data === 'object') {
            return `
              <i class="badge badge-danger badge-pill notify-icon-badge ml-3">${data.cant_observations || 0}</i><br>
              <a href='#'><i class="fa fa-file-text fa-1x link-comentario" id="${data.id_batch || ''}" aria-hidden="true" data-toggle="tooltip" title="adicionar observaciones" style="color:rgb(59, 131, 189)"></i></a>
            `;
          } else {
            // Si data no es un objeto válido, mostrar valores por defecto
            return `
              <i class="badge badge-danger badge-pill notify-icon-badge ml-3">0</i><br>
              <a href='#'><i class="fa fa-file-text fa-1x link-comentario" id="" aria-hidden="true" data-toggle="tooltip" title="adicionar observaciones" style="color:rgb(59, 131, 189)"></i></a>
            `;
          }
        }
      },
      {
        // Columna Multi (Múltiple)
        title: 'Multi',
        data: 11,
        className: 'uniqueClassName',
        width: '60px',
        orderable: false,
        searchable: false,
        render: function (data) {
          return `<i class="fa fa-superscript link-editarMulti" id="${data}" aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)"></i>`;
        }
      },
      {
        // Columna Modificar
        title: 'Modificar',
        data: 12,
        className: 'uniqueClassName',
        width: '80px',
        orderable: false,
        searchable: false,
        render: function (data) {
          return `<a href='#'><i class='fa fa-pencil-square-o fa-2x link-editar' id="${data}" data-toggle='tooltip' title='Editar Batch Record' style='color:rgb(255, 193, 7)'></i></a>`;
        }
      },
      {
        // Columna Eliminar (oculta por defecto)
        title: 'Eliminar',
        data: 13,
        className: 'uniqueClassName',
        width: '80px',
        orderable: false,
        searchable: false,
        visible: false,
        render: function (data) {
          return `<a href='#'><i class='fa fa-trash link-borrar fa-2x' id="${data}" data-toggle='tooltip' title='Eliminar Batch Record' style='color:rgb(234, 67, 54)'></i></a>`;
        }
      }
    ],
    
    // Eventos de la tabla
    initComplete: function () {
      console.log('=== TABLA PROGRAMADOS INICIALIZADA ===');
      console.log('Total filas cargadas:', this.api().rows().count());
    }
  });
  
  // Eventos de click para las filas
  $('#tablaBatch tbody').on('click', 'tr', function () {
    $(this).toggleClass('selected');
  });
  
  // Eventos para los botones de acción
  $('#tablaBatch tbody').on('click', '.link-editar', function () {
    var id = $(this).attr('id');
    console.log('Editar batch:', id);
    // Aquí iría la lógica para editar
  });
  
  console.log('Registrando evento para .link-editarMulti...');
  $('#tablaBatch tbody').on('click', '.link-editarMulti', function (e) {
    e.preventDefault();
    e.stopPropagation();
    
    console.log('=== INICIO CLICK MULTI ===');
    
    var id_batch = $(this).attr('id');
    console.log('ID del batch capturado:', id_batch);
    console.log('Tipo de ID:', typeof id_batch);
    
    // Guardar el ID del batch en una variable global
    window.currentBatchId = id_batch;
    console.log('ID guardado en window.currentBatchId:', window.currentBatchId);
    
    // Obtener la referencia del batch desde la fila actual
    var row = tablaBatch.row($(this).closest('tr'));
    console.log('Fila obtenida:', row);
    
    var rowData = row.data();
    console.log('Datos completos de la fila:', rowData);
    console.log('Número de columnas en la fila:', rowData.length);
    
    var codigoReferencia = rowData[2]; // El código de referencia está en la posición 2
    var nombreProducto = rowData[3]; // El nombre del producto está en la posición 3
    console.log('Código de referencia:', codigoReferencia);
    console.log('Nombre del producto:', nombreProducto);
    
    // Verificar si el modal existe
    var modalExists = $('#Modal_Multipresentacion').length > 0;
    console.log('Modal existe en DOM:', modalExists);
    
    if (modalExists) {
      console.log('Intentando abrir modal...');
      $('#Modal_Multipresentacion').modal('show');
      console.log('Modal abierto correctamente');
      
      // Cargar datos de multipresentación para este batch
      cargarMultipresentacionBatch(id_batch, codigoReferencia, nombreProducto);
    } else {
      console.error('ERROR: Modal Modal_Multipresentacion no encontrado en el DOM');
    }
    
    console.log('=== FIN CLICK MULTI ===');
  });
  
  // Función para cargar datos de multipresentación
  function cargarMultipresentacionBatch(id_batch, codigoReferencia, nombreProducto) {
    console.log('=== CARGANDO MULTIPRESENTACIÓN ===');
    console.log('Batch ID:', id_batch);
    console.log('Código de referencia del batch:', codigoReferencia);
    console.log('Nombre del producto del batch:', nombreProducto);
    
    // Limpiar el contenido anterior del modal
    $('#insertarRefMulti').empty();
    
    // Cargar datos reales de multipresentación desde la base de datos
    // Solo usar el id_batch, no los datos del batch
    console.log('Haciendo AJAX a /html/php/get_multipresentacion.php con id_batch:', id_batch);
    
    $.ajax({
      url: '/html/php/get_multipresentacion.php',
      type: 'POST',
      data: { id_batch: id_batch },
      dataType: 'json',
      success: function(response) {
        console.log('=== RESPUESTA AJAX MULTIPRESENTACIÓN ===');
        console.log('Respuesta completa:', response);
        console.log('Success:', response.success);
        console.log('Data length:', response.data ? response.data.length : 'No data');
        
        if (response.success && response.data.length > 0) {
          console.log('Hay datos de multipresentacion, cargando...');
          // Cargar datos reales de multipresentacion
          response.data.forEach(function(multi, index) {
            console.log('Procesando multipresentacion', index + 1, ':', multi);
            console.log('Referencia:', multi.referencia);
            console.log('Referencia completa:', multi.referencia_completa);
            console.log('Cantidad:', multi.cantidad);
            console.log('Tamaño:', multi.tamanio);
            
            var htmlMulti = `
              <tr>
                <td>
                  <select class="form-control" id="MultiReferencia${index + 1}">
                    <option value="">Seleccione una referencia</option>
                    <option value="${multi.referencia}" selected>${multi.referencia_completa}</option>
                  </select>
                </td>
                <td>
                  <input type="number" class="form-control" id="cantidadMulti${index + 1}" placeholder="Cantidad" value="${multi.cantidad}" onchange="calcularTamanioLoteMulti()">
                </td>
                <td>
                  <input type="number" class="form-control" id="tamanioloteMulti${index + 1}" placeholder="Tamaño" value="${multi.tamanio}" readonly>
                </td>
                <td>
                  <button type="button" class="btn btn-danger btn-sm" onclick="eliminarMultipresentacion(this)">
                    <i class="fa fa-times"></i>
                  </button>
                </td>
              </tr>
            `;
            console.log('HTML generado:', htmlMulti);
            $('#insertarRefMulti').append(htmlMulti);
          });
          
          // Calcular el total
          calcularTamanioLoteMulti();
          
        } else {
          console.log('No hay datos en multipresentacion para este batch, creando por defecto');
          console.log('Usando datos del batch como fallback');
          var htmlMulti = `
            <tr>
              <td>
                <select class="form-control" id="MultiReferencia1">
                  <option value="">Seleccione una referencia</option>
                  <option value="${codigoReferencia}" selected>${nombreProducto}</option>
                </select>
              </td>
              <td>
                <input type="number" class="form-control" id="cantidadMulti1" placeholder="Cantidad" value="150" onchange="calcularTamanioLoteMulti()">
              </td>
              <td>
                <input type="number" class="form-control" id="tamanioloteMulti1" placeholder="Tamaño" readonly>
              </td>
              <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="eliminarMultipresentacion(this)">
                  <i class="fa fa-times"></i>
                </button>
              </td>
            </tr>
          `;
          console.log('HTML por defecto generado:', htmlMulti);
          $('#insertarRefMulti').html(htmlMulti);
          
          // Calcular el tamaño del lote inicial
          calcularTamanioLoteMulti();
        }
        
        console.log('Datos de multipresentación cargados');
      },
      error: function(xhr, status, error) {
        console.error('=== ERROR AJAX MULTIPRESENTACIÓN ===');
        console.error('Status:', status);
        console.error('Error:', error);
        console.error('Response Text:', xhr.responseText);
        console.error('Status Code:', xhr.status);
        
        // En caso de error, crear uno por defecto
        console.log('Creando datos por defecto debido al error');
        var htmlMulti = `
          <tr>
            <td>
              <select class="form-control" id="MultiReferencia1">
                <option value="">Seleccione una referencia</option>
                <option value="${codigoReferencia}" selected>${nombreProducto}</option>
              </select>
            </td>
            <td>
              <input type="number" class="form-control" id="cantidadMulti1" placeholder="Cantidad" value="150" onchange="calcularTamanioLoteMulti()">
            </td>
            <td>
              <input type="number" class="form-control" id="tamanioloteMulti1" placeholder="Tamaño" readonly>
            </td>
            <td>
              <button type="button" class="btn btn-danger btn-sm" onclick="eliminarMultipresentacion(this)">
                <i class="fa fa-times"></i>
              </button>
            </td>
          </tr>
        `;
        $('#insertarRefMulti').html(htmlMulti);
        
        // Calcular el tamaño del lote inicial
        calcularTamanioLoteMulti();
      }
    });
  }
  
  // Función para calcular el tamaño del lote
  function calcularTamanioLoteMulti() {
    var total = 0;
    console.log('=== CALCULANDO TOTAL MULTIPRESENTACIÓN ===');
    
    $('[id^="cantidadMulti"]').each(function() {
      var cantidad = parseFloat($(this).val()) || 0;
      var index = $(this).attr('id').replace('cantidadMulti', '');
      
      // Obtener el valor de tamanio (que ahora es el total de la BD)
      var tamanioInput = $('#tamanioloteMulti' + index);
      var tamanio = parseFloat(tamanioInput.val()) || 0;
      
      console.log('Fila ' + index + ': Cantidad=' + cantidad + ', Tamaño=' + tamanio);
      
      // Sumar el tamaño al total
      total += tamanio;
    });
    
    console.log('Total calculado:', total.toFixed(3));
    $('#sumaMulti').val(total.toFixed(3)); // 3 decimales como en la primera imagen
  }
  
  $('#tablaBatch tbody').on('click', '.link-comentario', function (e) {
    e.preventDefault();
    e.stopPropagation();
    
    var id_batch = $(this).attr('id');
    console.log('Cargando observaciones para batch:', id_batch);
    
    // Guardar el ID del batch en una variable global para usarlo al guardar
    window.currentBatchId = id_batch;
    
    // Mostrar el modal
    $('#m_observaciones').modal('show');
    
    // Limpiar el contenido anterior
    $('#comment').val('');
    $('#tBody').empty();
    
    // Cargar las observaciones específicas del batch
    $.ajax({
      url: '/html/php/get_observaciones.php',
      type: 'POST',
      data: { id_batch: id_batch },
      dataType: 'json',
      success: function(response) {
        console.log('Observaciones cargadas:', response);
        
        if (response.success && response.data.length > 0) {
          // Llenar la tabla con las observaciones
          var tbody = $('#tBody');
          tbody.empty();
          
          response.data.forEach(function(obs) {
            var row = `
              <tr>
                <td>${obs.fecha_registro}</td>
                <td>${obs.observacion}</td>
              </tr>
            `;
            tbody.append(row);
          });
        } else {
          // Mostrar mensaje si no hay observaciones
          $('#tBody').html(`
            <tr>
              <td colspan="2" class="text-center">No hay observaciones registradas para este batch</td>
            </tr>
          `);
        }
      },
      error: function(xhr, status, error) {
        console.error('Error al cargar observaciones:', error);
        $('#tBody').html(`
          <tr>
            <td colspan="2" class="text-center text-danger">Error al cargar las observaciones</td>
          </tr>
        `);
      }
    });
  });
  
  // Evento para guardar observaciones
  $('#saveObs').on('click', function() {
    var observacion = $('#comment').val().trim();
    var id_batch = window.currentBatchId;
    
    if (!observacion) {
      alert('Por favor ingrese una observación');
      return;
    }
    
    if (observacion.length < 20) {
      alert('La observación debe tener al menos 20 caracteres');
      return;
    }
    
    if (!id_batch) {
      alert('Error: No se ha seleccionado un batch');
      return;
    }
    
    // Deshabilitar el botón para evitar doble envío
    $('#saveObs').prop('disabled', true).text('Guardando...');
    
    // Enviar la observación al servidor
    $.ajax({
      url: '/html/php/save_observacion.php',
      type: 'POST',
      data: {
        id_batch: id_batch,
        observacion: observacion
      },
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          // Mostrar mensaje de éxito
          alert('Observación guardada correctamente');
          
          // Limpiar el campo de texto
          $('#comment').val('');
          
          // Recargar las observaciones para mostrar la nueva
          $.ajax({
            url: '/html/php/get_observaciones.php',
            type: 'POST',
            data: { id_batch: id_batch },
            dataType: 'json',
            success: function(response) {
              if (response.success && response.data.length > 0) {
                var tbody = $('#tBody');
                tbody.empty();
                
                response.data.forEach(function(obs) {
                  var row = `
                    <tr>
                      <td>${obs.fecha_registro}</td>
                      <td>${obs.observacion}</td>
                    </tr>
                  `;
                  tbody.append(row);
                });
              }
            }
          });
          
          // Actualizar el contador en la tabla principal
          if (tablaBatch) {
            tablaBatch.ajax.reload();
          }
          
        } else {
          alert('Error: ' + response.error);
        }
      },
      error: function(xhr, status, error) {
        console.error('Error al guardar observación:', error);
        alert('Error al guardar la observación. Intente nuevamente.');
      },
      complete: function() {
        // Rehabilitar el botón
        $('#saveObs').prop('disabled', false).text('Agregar');
      }
    });
  });
  
  console.log('=== TABLA PROGRAMADOS CONFIGURADA ===');
}); 