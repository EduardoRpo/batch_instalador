$(document).ready(function () {
  /* tabla calculo de capacidad envasado */
  api = '/api/averageCapacidadEnvasado';

  getDataCapacidadEnvasado = async () => {
    resp = await searchData(api);
    loadtblCalcCapacidadEnvasado(resp);
  };

  getDataCapacidadEnvasado();

  loadtblCalcCapacidadEnvasado = (data) => {
    let rowCapacidadEnvasado = document.getElementById(
      'tblCalcCapacidadEnvasadoBody'
    );

    for (i = 0; i < data.length; i++) {
      rowCapacidadEnvasado.insertAdjacentHTML(
        'beforeend',
        `
        <tr>
          <td style="display: none">${i + 1}</td>
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
      `
      );
    }

    $('#tblCalcCapacidadEnvasado').DataTable({
      scrollY: '130px',
      scrollCollapse: true,
      paging: false,
      searching: false,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
      },
    });
  };

  /* tabla envasado */

  loadTblEnvasado = async (fecha) => {
    let url = '/api/programacionEnvasado';

    if (fecha) 
      url = `/api/programacionEnvasado/${fecha}`;

    tablaEnvasado = $('#tablaEnvasado').DataTable({
      destroy: true,
      pageLength: 100,
      order: [[5, 'asc']],
      ajax: {
        url: url,
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
          title: 'Estado',
          data: 'estado',
          className: 'uniqueClassName',
          render: (data, type, row) => {
            'use strict';
            return data == 3
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
                        ? 'Env/Acond'
                        : data == 6
                          ? 'Env/Acond'
                          : 'Env/Acond';
          },
        },
        {
          title: 'Granel',
          data: 'referencia',
          className: 'uniqueClassName',
          // visible: false,
        },
        {
          title: 'Pedido',
          data: 'pedido',
          className: 'uniqueClassName',
        },
        {
          title: 'Fecha Estimada Envasado',
          data: 'fecha_envasado',
          className: 'uniqueClassName',
        },
        {
          title: 'Propietario',
          data: 'propietario',
          className: 'uniqueClassName',
          visible: false,
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
          title: 'fecha Programacion',
          data: 'programacion_envasado',
          className: 'uniqueClassName',
          visible: false,
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
      rowCallback: function (row, data, index) {
        if (data['programacion_envasado'] && data['ok_aprobado'])
          $(row).css('color', 'green');
        else if (data['programacion_envasado'] && !data['ok_aprobado'])
          $(row).css('color', 'orange');
      },
      rowGroup: {
        dataSrc: function (row) {
          return `<th class="text-center" colspan="14" style="font-weight: bold;"> ${row.propietario} </th> `;
        },
        startRender: function (rows, group) {
          return $('<tr/>').append(group);
        },
        className: 'odd',
      },
    });
  }

  loadTblEnvasado(null);

  $(document).on('click', '.table-responsive, .page-link', function () {
    selectChange();
  });

  $(document).on('click', '#btnSearch', async function () { 
    fecha = $('#fechaBusqueda').val(); 
    loadTblEnvasado(fecha);
  });

  $('#btnLimpiar').click(function (e) {
    e.preventDefault();

    $('#fechaBusqueda').val('');

    loadTblEnvasado(null);
  });
});
