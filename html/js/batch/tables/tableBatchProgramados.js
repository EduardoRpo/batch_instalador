$(document).ready(function () {
  tablaBatch = $('#tablaBatch').DataTable({
    pageLength: 50,
    responsive: true,
    scrollCollapse: true,
    language: { url: '../../../admin/sistema/admin_componentes/es-ar.json' },
    oSearch: { bSmart: false },

    ajax: {
      url: '/api/batch',
      dataSrc: '',
    },
    order: [[1, 'desc']],
    columns: [
      {
        defaultContent:
          "<input type='radio' id='express' name='optradio' class='link-select'>",
      },
      {
        title: 'Batch',
        data: 'id_batch',
      },
      /* {
              title: 'No Orden',
              data: 'numero_orden',
              className: 'uniqueClassName',
            }, */
      {
        title: 'Referencia',
        data: 'referencia',
        className: 'uniqueClassName',
      },
      {
        title: 'Producto',
        data: 'nombre_referencia',
      },
      {
        title: 'No Lote',
        data: 'numero_lote',
      },
      {
        title: 'Tamaño Lote',
        data: 'tamano_lote',
        className: 'uniqueClassName',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
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
        data: 'semana_creacion',
        className: 'uniqueClassName',
        render: function (data) {
          return `S${data}`;
        },
      },
      {
        title: 'Sem Prog',
        data: 'semana_programacion',
        className: 'uniqueClassName',
        render: function (data) {
          return `S${data}`;
        },
      },
      {
        title: 'Fecha Programación',
        data: 'fecha_programacion',
        className: 'uniqueClassName',
      },
      {
        title: 'Estado',
        data: 'estado',
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
