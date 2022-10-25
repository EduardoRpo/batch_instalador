$(document).ready(function () {
  tablaBatchPlaneados = $('#tablaBatchPlaneados').DataTable({
    pageLength: 50,
    responsive: true,
    scrollCollapse: true,
    language: { url: '../../../admin/sistema/admin_componentes/es-ar.json' },
    oSearch: { bSmart: false },

    ajax: {
      url: '/api/batchInactivos',
      dataSrc: '',
    },
    // order: [[1, 'desc']],
    columns: [
      {
        title: '',
        data: null,
        className: 'text-center',
        render: function (data) {
          return `<input type='checkbox' id=${data.id} class='link-select'>`;
        },
      },
      {
        title: 'N° Semana',
        data: 'semana',
        className: 'text-center',
      },
      {
        width: '350px',
        title: 'Propietario',
        data: 'propietario',
        visible: false,
      },
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
        data: 'id_producto',
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
        render: $.fn.dataTable.render.number('.', ',', 1, ''),
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
        title: 'F.Sugerida Pesaje',
        data: 'sim',
        className: 'text-center',
      },
      {
        title: 'F.Sugerida Envasado',
        data: 'sim',
        className: 'text-center',
      },
      {
        title: 'Estado',
        data: 'estado',
        className: 'text-center',
      },
      {
        data: 'id',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-trash link-borrar-pre fa-2x' id=${data} data-toggle='tooltip' title='Eliminar Pre Planeado' style='color:rgb(234, 67, 54)'></i></a>`;
        },
      },
    ],
    rowGroup: {
      dataSrc: 'propietario',
      startRender: function (rows, group) {
        return $('<tr/>').append(
          '<th class="text-center" colspan="12" style="font-weight: bold;">' +
            group +
            '</th>'
        );
      },
      className: 'odd',
    },
    /*
        columns: [
          {
            title: 'No.',
            data: null,
            className: 'text-center',
            render: function (data, type, full, meta) {
              return meta.row + 1;
            },
          },
          {
            title: 'Batch',
            data: 'id_batch',
            className: 'text-center',
          },
          {
            title: 'Orden',
            data: 'numero_orden',
            className: 'uniqueClassName',
          },
          {
            title: 'Referencia',
            data: 'referencia',
            className: 'uniqueClassName',
          },
          {
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
            title: 'Producto',
            data: 'nombre_referencia',
          },
          {
            title: 'Numero Lote',
            data: 'numero_lote',
          },
          {
            title: 'Tamaño Lote',
            data: 'tamano_lote',
            className: 'uniqueClassName',
            render: $.fn.dataTable.render.number('.', ',', 0, ''),
          },
          {
            title: 'Propietario',
            data: 'nombre',
          },
          {
            title: 'Fecha Planeación',
            data: 'fecha_creacion',
            className: 'uniqueClassName',
          },
          {
            title: 'No Semana',
            data: 'semanas',
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
                : 'Multimodulo';
            },
          },
          {
            title: '',
            data: 'id_batch',
            className: 'uniqueClassName',
            render: function (data) {
              return ``;
            },
          },
          {
            data: 'id_batch',
            className: 'uniqueClassName',
            render: function (data) {
              return `
                   <i class="fa fa-superscript fa-1x link-editarMulti" id=${data} aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i>`;
            },
          },
          {
            title: 'Acciones',
            data: 'id_batch',
            className: 'uniqueClassName',
            render: function (data) {
              return `
                   <a href='#' <i class='fa fa-pencil-square-o fa-2x link-editar' id=${data} data-toggle='tooltip' title='Editar Batch Record' style='color:rgb(255, 193, 7);'></i></a>
                   <a href='#' <i class='fa fa-trash link-borrar fa-2x' id=${data} data-toggle='tooltip' title='Eliminar Batch Record' style='color:rgb(234, 67, 54)'></i></a>`;
            },
          },
        ],
        rowCallback: function (row, data, index) {
          fecha_batch = moment(data.fecha_actual);
          hoy = moment(Date());

          dias = hoy.diff(fecha_batch, 'days');

          if (dias > 15) $(row).css('color', 'orange');
          if (dias > 30) $(row).css('color', 'red');

          if (data.fecha_registro) {
            fecha_observacion = moment(data.fecha_registro);
            hoy = moment(Date());

            dias = hoy.diff(fecha_observacion, 'days');

            if (dias > 15) $(row).css('color', 'red');
          }
        },*/
  });
});
