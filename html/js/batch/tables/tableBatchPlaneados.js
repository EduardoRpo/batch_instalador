// Función global para cargar total de ventas
loadTotalVentas = () => {
  let totalVentaPlan = 0;
  let totalVentaPre = 0;

  let dataBPlaneacion = tablaBatchPlaneados.rows().data().toArray();
  let dataBPreplaneacion = tableBatchPrePlaneacion.rows().data().toArray();

  for (i = 0; i < dataBPlaneacion.length; i++) {
    totalVentaPlan =
      totalVentaPlan +
      dataBPlaneacion[i]['unidad_lote'] * dataBPlaneacion[i]['valor_pedido'];
  }

  for (i = 0; i < dataBPreplaneacion.length; i++) {
    totalVentaPre =
      totalVentaPre +
      dataBPreplaneacion[i]['unidad_lote'] *
        dataBPreplaneacion[i]['valor_pedido'];
  }

  $('#totalVentaPre').val(`$ ${totalVentaPre.toLocaleString('es-CO')}`);
  $('#totalVentaPlan').val(`$ ${totalVentaPlan.toLocaleString('es-CO')}`);
};

$(document).ready(function () {
  /* Capacidad Planeada */
  api = '/html/php/batch_planeados_fetch.php';

  getDataPlaneacion = async () => {
    console.log('🚀 getDataPlaneacion - Iniciando obtención de datos');
    try {
      resp = await searchData(api);
      console.log('✅ getDataPlaneacion - Datos obtenidos:', resp);
      console.log('🔍 getDataPlaneacion - Tipo de resultado:', typeof resp);
      console.log('🔍 getDataPlaneacion - Es array:', Array.isArray(resp));
      if (resp && resp.data) {
        console.log('🔍 getDataPlaneacion - Número de registros:', resp.data.length);
        console.log('🔍 getDataPlaneacion - Primer registro:', resp.data[0]);
      }
      loadTblCapacidadPlaneada(resp);
    } catch (error) {
      console.error('❌ getDataPlaneacion - Error:', error);
    }
  };

  getDataPlaneacion();

  loadTblCapacidadPlaneada = (data) => {
    console.log('🚀 loadTblCapacidadPlaneada - Iniciando con datos:', data);
    semana = sessionStorage.getItem('semana');
    console.log('🔍 loadTblCapacidadPlaneada - Semana de sessionStorage:', semana);
    let capacidadPlaneada = calcTamanioLoteBySemana(data, parseInt(semana));
    console.log('🔍 loadTblCapacidadPlaneada - Capacidad calculada:', capacidadPlaneada);

    let rowPlaneados = document.getElementById('tblCalcCapacidadPlaneadaBody');

    for (i = 0; i < capacidadPlaneada.length; i++) {
      rowPlaneados.insertAdjacentHTML(
        'beforeend',
        `
          <tr>
            <td style="display: none">${i + 1}</td>
            <td class="text-center">${capacidadPlaneada[i].semana}</td>
            <td class="text-center">${capacidadPlaneada[
              i
            ].tamanioLoteLQ.toLocaleString(undefined, {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}</td> 
            <td class="text-center">${capacidadPlaneada[
              i
            ].tamanioLoteSL.toLocaleString(undefined, {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}</td>
            <td class="text-center">${capacidadPlaneada[
              i
            ].tamanioLoteSM.toLocaleString(undefined, {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}</td>
            <td class="text-center">
            ${(
              capacidadPlaneada[i].tamanioLoteLQ +
              capacidadPlaneada[i].tamanioLoteSL +
              capacidadPlaneada[i].tamanioLoteSM
            ).toLocaleString(undefined, {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}
            </td>
          </tr>
        `
      );
    }

    $('#tblCalcCapacidadPlaneada').dataTable({
      scrollY: '130px',
      scrollCollapse: true,
      paging: false,
      searching: false,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
      },
    });
  };

  tablaBatchPlaneados = $('#tablaBatchPlaneados').DataTable({
    pageLength: 50,
    responsive: true,
    scrollCollapse: true,
    language: {
      url: '../../../admin/sistema/admin_componentes/es-ar.json',
    },
    oSearch: { bSmart: false },

    ajax: { 
      url: '/html/php/batch_planeados_fetch.php', 
      type: 'POST',
      dataSrc: 'data',
      dataFilter: function(data) {
        console.log('🔍 tableBatchPlaneados - Datos recibidos del servidor:', data);
        console.log('🔍 tableBatchPlaneados - Tipo de datos:', typeof data);
        
        try {
          const parsedData = JSON.parse(data);
          console.log('🔍 tableBatchPlaneados - Datos parseados:', parsedData);
          console.log('🔍 tableBatchPlaneados - Número de registros:', parsedData.data ? parsedData.data.length : 'No data array');
          
          if (parsedData.data && parsedData.data.length > 0) {
            console.log('🔍 tableBatchPlaneados - Primer registro:', parsedData.data[0]);
            console.log('🔍 tableBatchPlaneados - Estado del primer registro:', parsedData.data[0].estado);
            console.log('🔍 tableBatchPlaneados - Referencia del primer registro:', parsedData.data[0].referencia);
          }
        } catch (e) {
          console.error('❌ tableBatchPlaneados - Error parseando datos:', e);
        }
        
        return data;
      }
    },
    order: [[3, 'asc']],
    columns: [
      {
        title: '',
        data: 'id',
        className: 'text-center',
        render: function (data) {
          return `<input type='checkbox' id="planChk-${data}" class='link-select'>`;
        },
      },
      {
        title: 'N°',
        data: null,
        className: 'text-center',
        render: function (data, type, row, meta) {
          return meta.row + 1;
        },
      },
      {
        title: 'N° Semana',
        data: 'semana',
        className: 'text-center',
        render: function (data) {
          return `S${data}`;
        },
      },
      /*
      {
        width: '350px',
        title: 'Propietario',
        data: 'propietario',
        visible: false,
      },
      */
      {
        title: 'Pedido',
        data: 'pedido',
        className: 'text-center',
      },
      {
        title: 'Granel',
        data: 'granel',
        className: 'text-center',
      },
      {
        title: 'Referencia',
        data: 'referencia',
        className: 'text-center',
      },
      {
        width: '350px',
        title: 'Producto',
        data: 'nombre_referencia',
        className: 'uniqueClassName',
      },
      {
        title: 'Tamaño Lote (Kg)',
        data: 'tamano_lote',
        className: 'text-center',
        render: $.fn.dataTable.render.number('.', ',', 2, ''),
      },
      {
        title: 'Cantidad (Und)',
        data: 'unidad_lote',
        className: 'text-center',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
      },
      {
        title: 'Simulación',
        data: 'sim',
        className: 'text-center',
        visible: false,
      },
      {
        title: 'F. Insumo',
        data: 'fecha_insumo',
        className: 'text-center',
      },
      {
        title: 'F.Sugerida Pesaje',
        data: 'fecha_pesaje',
        className: 'text-center',
      },
      {
        title: 'F.Sugerida Envasado',
        data: 'fecha_envasado',
        className: 'text-center',
      },
      {
        title: 'Estado',
        data: 'estado',
        className: 'text-center',
        render: function (data, type, row) {
          console.log('🔍 Render Estado - Datos recibidos:', { data, type, row });
          console.log('🔍 Render Estado - row.referencia:', row.referencia);
          console.log('🔍 Render Estado - row.estado:', row.estado);
          
          let estadoText = '';
          if (data == 0) {
            estadoText = 'Falta Formula e Instructivo';
          } else if (data == 1) {
            estadoText = 'Inactivo';
          } else {
            estadoText = data; // Para cualquier otro valor, mostrar el valor original
          }
          
          console.log('🔍 Render Estado - Texto generado:', estadoText);
          
          return `
            <div class="d-flex align-items-center justify-content-center">
              <span class="mr-2">${estadoText}</span>
              <button type="button" class="btn btn-sm btn-outline-primary" 
                      onclick="updateEstadoProducto('${row.referencia}')" 
                      title="Actualizar estado">
                <i class="fa fa-refresh"></i>
              </button>
            </div>
          `;
        },
      },
      {
        data: 'id',
        className: 'uniqueClassName',
        render: function (data, type, row) {
          return `
            <div class="d-flex align-items-center justify-content-center">
              <i class='fa fa-pencil link-editar-pre fa-2x mr-2' 
                 id="edit-${data}" 
                 data-toggle='tooltip' 
                 title='Editar Pre Planeado' 
                 style='color:rgb(33, 150, 243); cursor: pointer;'
                 onclick="editarPrePlaneado(${data}, '${row.referencia}', '${row.tamano_lote}', '${row.unidad_lote}')"></i>
              <i class='fa fa-trash link-borrar-pre fa-2x' 
                 id="delete-${data}" 
                 data-toggle='tooltip' 
                 title='Eliminar Pre Planeado' 
                 style='color:rgb(234, 67, 54); cursor: pointer;'></i>
            </div>
          `;
        },
      },
    ],
    rowGroup: {
      dataSrc: function (row) {
        return `<th class="text-center" colspan="13" style="font-weight: bold;"> ${row.propietario || 'Sin Cliente'} </th>`;
      },
      startRender: function (rows, group) {
        return $('<tr/>').append(group);
      },
      className: 'odd',
    },
  });

  setTimeout(loadTotalVentas, 11000);
  
  console.log('🔍 tableBatchPlaneados - Tabla inicializada completamente');
});

// Función para actualizar el estado de un producto
function updateEstadoProducto(referencia) {
  console.log('🚀 updateEstadoProducto - Actualizando estado para:', referencia);
  console.log('🔍 updateEstadoProducto - Tipo de referencia:', typeof referencia);
  console.log('🔍 updateEstadoProducto - Referencia exacta:', JSON.stringify(referencia));
  
  // Mostrar indicador de carga
  alertify.set('notifier', 'position', 'top-right');
  alertify.message('Actualizando estado...');
  
  const dataToSend = { referencia: referencia };
  console.log('🔍 updateEstadoProducto - Datos a enviar:', JSON.stringify(dataToSend));
  
  $.ajax({
    url: '/api/update-estado-producto',
    type: 'POST',
    data: JSON.stringify(dataToSend),
    contentType: 'application/json',
    success: function(resp) {
      console.log('✅ updateEstadoProducto - Respuesta completa:', resp);
      console.log('🔍 updateEstadoProducto - Tipo de respuesta:', typeof resp);
      console.log('🔍 updateEstadoProducto - resp.success:', resp.success);
      console.log('🔍 updateEstadoProducto - resp.estado:', resp.estado);
      console.log('🔍 updateEstadoProducto - resp.descripcion:', resp.descripcion);
      
      if (resp.success) {
        alertify.success('Estado actualizado correctamente');
        console.log('✅ updateEstadoProducto - Estado actualizado a:', resp.estado, '(', resp.descripcion, ')');
        
        // Recargar la tabla para mostrar el nuevo estado
        $('#tablaBatchPlaneados').DataTable().ajax.reload();
        
        console.log('✅ updateEstadoProducto - Tabla recargada');
      } else {
        console.error('❌ updateEstadoProducto - Error en respuesta:', resp.message);
        alertify.error('Error: ' + (resp.message || 'Error desconocido'));
      }
    },
    error: function(xhr, status, error) {
      console.error('❌ updateEstadoProducto - Error AJAX:', {xhr, status, error});
      console.error('❌ updateEstadoProducto - Status:', xhr.status);
      console.error('❌ updateEstadoProducto - StatusText:', xhr.statusText);
      console.error('❌ updateEstadoProducto - ResponseText:', xhr.responseText);
      alertify.error('Error al actualizar estado: ' + error);
    }
  });
}

// Función para editar un pre-planeado
function editarPrePlaneado(id, referencia, tamanoLote, cantidad) {
  console.log('🚀 editarPrePlaneado - Editando registro:', { id, referencia, tamanoLote, cantidad });
  
  // Crear modal de edición
  const modalHtml = `
    <div class="modal fade" id="modalEditarPrePlaneado" tabindex="-1" role="dialog" aria-labelledby="modalEditarPrePlaneadoLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarPrePlaneadoLabel">Editar Pre-Planeado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formEditarPrePlaneado">
              <input type="hidden" id="editId" value="${id}">
              <input type="hidden" id="editReferencia" value="${referencia}">
              
              <div class="form-group">
                <label for="editTamanoLote">Tamaño Lote (Kg):</label>
                <input type="number" class="form-control" id="editTamanoLote" value="${tamanoLote}" step="0.01" min="0" required>
              </div>
              
              <div class="form-group">
                <label for="editCantidad">Cantidad (Und):</label>
                <input type="number" class="form-control" id="editCantidad" value="${cantidad}" step="1" min="0" required>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="guardarEdicionPrePlaneado()">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </div>
  `;
  
  // Remover modal anterior si existe
  $('#modalEditarPrePlaneado').remove();
  
  // Agregar modal al body
  $('body').append(modalHtml);
  
  // Mostrar modal
  $('#modalEditarPrePlaneado').modal('show');
}

// Función para guardar la edición
function guardarEdicionPrePlaneado() {
  const id = $('#editId').val();
  const referencia = $('#editReferencia').val();
  const tamanoLote = $('#editTamanoLote').val();
  const cantidad = $('#editCantidad').val();
  
  console.log('🚀 guardarEdicionPrePlaneado - Guardando cambios:', { id, referencia, tamanoLote, cantidad });
  
  // Validaciones
  if (!tamanoLote || tamanoLote <= 0) {
    alertify.error('El tamaño del lote debe ser mayor a 0');
    return;
  }
  
  if (!cantidad || cantidad <= 0) {
    alertify.error('La cantidad debe ser mayor a 0');
    return;
  }
  
  // Mostrar indicador de carga
  alertify.set('notifier', 'position', 'top-right');
  alertify.message('Guardando cambios...');
  
  const dataToSend = {
    id: id,
    referencia: referencia,
    tamano_lote: parseFloat(tamanoLote),
    cantidad: parseInt(cantidad)
  };
  
  console.log('🔍 guardarEdicionPrePlaneado - Datos a enviar:', JSON.stringify(dataToSend));
  
  $.ajax({
    url: '/api/update-preplaneado',
    type: 'POST',
    data: JSON.stringify(dataToSend),
    contentType: 'application/json',
    success: function(resp) {
      console.log('✅ guardarEdicionPrePlaneado - Respuesta completa:', resp);
      
      if (resp.success) {
        alertify.success('Pre-planeado actualizado correctamente');
        
        // Cerrar modal
        $('#modalEditarPrePlaneado').modal('hide');
        
        // Recargar la tabla
        $('#tablaBatchPlaneados').DataTable().ajax.reload();
        
        console.log('✅ guardarEdicionPrePlaneado - Cambios guardados exitosamente');
      } else {
        console.error('❌ guardarEdicionPrePlaneado - Error en respuesta:', resp.message);
        alertify.error('Error: ' + (resp.message || 'Error desconocido'));
      }
    },
    error: function(xhr, status, error) {
      console.error('❌ guardarEdicionPrePlaneado - Error AJAX:', {xhr, status, error});
      console.error('❌ guardarEdicionPrePlaneado - Status:', xhr.status);
      console.error('❌ guardarEdicionPrePlaneado - StatusText:', xhr.statusText);
      console.error('❌ guardarEdicionPrePlaneado - ResponseText:', xhr.responseText);
      alertify.error('Error al guardar cambios: ' + error);
    }
  });
}
