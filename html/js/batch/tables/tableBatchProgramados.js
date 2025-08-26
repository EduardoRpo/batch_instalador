$(document).ready(function () {
  btnDeleteMulti = true;
  
  // Verificar si la tabla ya está inicializada
  if ($.fn.DataTable.isDataTable('#tablaBatch')) {
    console.log('Tabla tablaBatch ya está inicializada, destruyendo...');
    $('#tablaBatch').DataTable().destroy();
  }
  
  // Configuración de DataTables para tabla de batch programados
  tablaBatchProgramados = $('#tablaBatch').DataTable({
    pageLength: 50,
    responsive: true,
    scrollCollapse: true,
    language: {
      url: '../../../admin/sistema/admin_componentes/es-ar.json',
    },
    oSearch: { bSmart: false },

    ajax: {
      url: '/html/php/batch_fetch.php',
      type: 'POST',
      dataSrc: function(json) {
        console.log('=== DEBUG DATATABLES PROGRAMADOS ===');
        console.log('JSON recibido:', json);
        console.log('Data count:', json.data ? json.data.length : 'No data');
        if (json.data && json.data.length > 0) {
          console.log('First row:', json.data[0]);
          console.log('First row columns:', json.data[0].length);
        }
        return json.data || [];
      }
    },
    order: [[1, 'desc']],
    columns: [
      {
        defaultContent:
          "<input type='radio' id='express' name='optradio' class='link-select'>",
      },
      {
        title: 'Batch',
        data: 1,
        render: function(data, type, row) {
          console.log('Columna Batch - data:', data, 'row:', row);
          return data;
        }
      },
      /* {
                    title: 'No Orden',
                    data: 'numero_orden',
                    className: 'uniqueClassName',
                  }, */
      {
        title: 'Referencia',
        data: 2,
        className: 'uniqueClassName',
        render: function(data, type, row) {
          console.log('Columna Referencia - data:', data, 'row:', row);
          return data;
        }
      },
      {
        title: 'Producto',
        data: 3,
        render: function(data, type, row) {
          console.log('Columna Producto - data:', data, 'row:', row);
          return data;
        }
      },
      {
        title: 'No Lote',
        data: 4,
        render: function(data, type, row) {
          console.log('Columna No Lote - data:', data, 'row:', row);
          return data;
        }
      },
      {
        title: 'Tamaño Lote',
        data: 5,
        className: 'uniqueClassName',
        render: $.fn.dataTable.render.number('.', ',', 2, ''),
      },
      /* {
                      title: 'Propietario',
                      data: 'nombre',
                  }, */
      /* {
                      title: 'Fecha Planeación',
                      data: 'fecha_creacion',
                      className: 'uniqueClassName',
                  }, */
      {
        title: 'Sem Plan',
        data: 6,
        className: 'uniqueClassName',
        render: function (data) {
          return `S${data}`;
        },
      },
      {
        title: 'Sem Prog',
        data: 7,
        className: 'uniqueClassName',
        render: function (data) {
          return `S${data}`;
        },
      },
      {
        title: 'Fecha Programación',
        data: 8,
        className: 'uniqueClassName',
      },
      {
        title: 'Estado',
        data: 9,
        className: 'uniqueClassName',
        render: (data, type, row) => {
          'use strict';
          return data == 1
            ? 'Sin Formula y/o Instructivo'
            : data == 2
            ? 'Inactivo'
            : data == 3
            ? 'Pesaje'
            : data == 3.5
            ? 'Preparación'
            : data == 4
            ? 'Preparación'
            : data == 4.5
            ? 'Aprobación'
            : data == 5
            ? 'Aprobación'
            : data == 5.5
            ? 'Envasado/Acondicionamiento'
            : data == 6
            ? 'Envasado/Acondicionamiento'
            : data == 6.5
            ? 'Microbiologia/Fisicoquimico'
            : data == 7
            ? 'Microbiologia/Fisicoquimico'
            : data == 7.5
            ? 'Microbiologia/Fisicoquimico'
            : data == 8
            ? 'Microbiologia/Fisicoquimico'
            : data == 8.5
            ? 'Microbiologia/Fisicoquimico'
            : data == 10
            ? 'Liberacion Lote'
            : 'Cerrado';
        },
      },
      {
        title: 'Obs',
        data: null,
        className: 'uniqueClassName',
        render: function (data) {
          return `
                    <i class="badge badge-danger badge-pill notify-icon-badge ml-3">${data.cant_observations}</i><br>
                    <a href='#' <i class="fa fa-file-text fa-1x link-comentario" id=${data.id_batch} aria-hidden="true" data-toggle="tooltip" title="adicionar observaciones" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>
                  `;
        },
      },
      {
        title: 'Multi',
        data: 'id_batch',
        className: 'uniqueClassName',
        render: function (data) {
          return `<i class="fa fa-superscript link-editarMulti" id=${data} aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i>`;
        },
      },

      {
        title: 'Modificar',
        data: 'id_batch',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-pencil-square-o fa-2x link-editar' id=${data} data-toggle='tooltip' title='Editar Batch Record' style='color:rgb(255, 193, 7)'></i></a>`;
        },
      },
      {
        title: 'Eliminar',
        data: 'id_batch',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-trash link-borrar fa-2x' id=${data} data-toggle='tooltip' title='Eliminar Batch Record' style='color:rgb(234, 67, 54)'></i></a>`;
        },
      },
    ],
  });
});
