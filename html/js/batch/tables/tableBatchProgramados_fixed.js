$(document).ready(function () {
  console.log('=== INICIALIZANDO TABLA PROGRAMADOS ===');
  
  // Verificar si la tabla ya está inicializada y destruirla
  if ($.fn.DataTable.isDataTable('#tablaBatch')) {
    console.log('Destruyendo tabla existente...');
    $('#tablaBatch').DataTable().destroy();
  }
  
  // Configuración completa de DataTables para tabla de batch programados
  tablaBatchProgramados = $('#tablaBatch').DataTable({
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
          return `
            <i class="badge badge-danger badge-pill notify-icon-badge ml-3">${data.cant_observations || 0}</i><br>
            <a href='#'><i class="fa fa-file-text fa-1x link-comentario" id="${data.id_batch}" aria-hidden="true" data-toggle="tooltip" title="adicionar observaciones" style="color:rgb(59, 131, 189)"></i></a>
          `;
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
  
  $('#tablaBatch tbody').on('click', '.link-editarMulti', function () {
    var id = $(this).attr('id');
    console.log('Editar multipresentación:', id);
    // Aquí iría la lógica para editar multipresentación
  });
  
  $('#tablaBatch tbody').on('click', '.link-comentario', function () {
    var id = $(this).attr('id');
    console.log('Agregar observaciones:', id);
    // Aquí iría la lógica para agregar observaciones
  });
  
  console.log('=== TABLA PROGRAMADOS CONFIGURADA ===');
}); 