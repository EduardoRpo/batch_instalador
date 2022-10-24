$(document).ready(function () {
  /* tabla calculo de capacidad envasado */
  api = '/api/averageCapacidadEnvasado';

  getDataCapacidadEnvasado = async () => {
    resp = await searchData(api);
    loadtblCalcCapacidadEnvasado(resp);
  };

  getDataCapacidadEnvasado();

  loadtblCalcCapacidadEnvasado = (data) => {
    for (i = 0; i < data.length; i++) {
      $('.tblCalcCapacidadEnvasadoBody').append(`
            <tr>
                <td>${data[i].semana}</td>
                <td style="width:10%;">${data[i].plan_liquido_1} %</td>
                <td style="width:10%;">${data[i].plan_liquido_2} %</td>
                <td style="width:10%;">${data[i].plan_liquido_3} %</td>
                <td>${data[i].total_liquido.toLocaleString()}</td>
                <td style="width:10%;">${data[i].plan_solido_1} %</td>
                <td style="width:10%;">${data[i].plan_solido_2} %</td>
                <td style="width:10%;">${data[i].plan_solido_3} %</td>
                <td>${data[i].total_solido.toLocaleString()}</td>
                <td style="width:10%;">${data[i].plan_semi_solido_1} %</td>
                <td style="width:10%;">${data[i].plan_semi_solido_2} %</td>
                <td style="width:10%;">${data[i].plan_semi_solido_3} %</td>
                <td>${data[i].total_semi_solido.toLocaleString()}</td>
            </tr>
      `);
    }

    $('#tblCalcCapacidadEnvasado').dataTable({
      scrollY: '130px',
      scrollCollapse: true,
      paging: false,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
      },
    });
  };

  /* tabla envasado */
  $('#tablaEnvasado').dataTable({
    pageLength: 50,
    order: [[1, 'desc']],
    ajax: {
      url: '/api/programacionEnvasado',
      dataSrc: '',
    },
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [
      {
        title: 'Batch',
        data: 'id_batch',
        className: 'uniqueClassName',
      },
      {
        title: 'No de Orden',
        data: 'numero_orden',
        className: 'uniqueClassName',
      },
      {
        title: 'Nombre Producto',
        data: 'referencia',
        className: 'uniqueClassName',
      },
      {
        title: 'Descripción',
        data: 'nombre_referencia',
        className: 'uniqueClassName',
      },
      {
        title: 'Ref',
        data: 'id_batch',
        className: 'uniqueClassName',
        render: function (data) {
          return `
              <a href="# "<i class="fa fa-superscript link-editarMulti" id="${data}" aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>`;
        },
      },
      {
        title: 'No Lote',
        data: 'numero_lote',
        className: 'uniqueClassName',
      },
      {
        title: 'Unidades',
        data: 'unidad_lote',
        className: 'uniqueClassName',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
      },
      {
        title: 'Tamaño Lote(Kg)',
        data: 'tamano_lote',
        className: 'uniqueClassName',
        render: $.fn.dataTable.render.number('.', ',', 0, ''),
      },
      {
        title: 'Programacion',
        data: null,
        className: 'uniqueClassName',
        render: function (data) {
          !data.programacion_envasado
            ? (fecha = '')
            : (fecha = data.programacion_envasado);
          return `
                      <input type="datetime-local" class="fechaProgramar form-control-updated text-center" id="date-${data.id_batch}" value="${fecha}" />`;
        },
      },
      {
        title: 'Obs',
        data: null,
        className: 'uniqueClassName',
        render: function (data) {
          return `
                      <i class="badge badge-danger badge-pill notify-icon-badge ml-3">${data.cant_observations}</i><br>
                      <a href='#' <i class="fa fa-file-text fa-1x link-comentario" id="${data.id_batch}" aria-hidden="true" data-toggle="tooltip" title="adicionar observaciones" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>
                    `;
        },
      },
      {
        title: 'Aprob',
        data: 'ok_aprobado',
        className: 'uniqueClassName',
        render: function (data) {
          if (data)
            return `<i class='fa fa-check fa-2x' style='color:green'></i>`;
          else return `<i class='fa fa-close fa-2x' style='color:red'></i>`;
        },
      },
    ],
  });

  $(document).on('click', '.table-responsive, .page-link', function () {
    selectChange();
  });
});
