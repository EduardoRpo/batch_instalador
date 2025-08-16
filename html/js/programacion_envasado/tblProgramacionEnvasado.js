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
    let url = '/html/php/programacion_envasado_fetch_nocache.php';

    tablaEnvasado = $('#tablaEnvasado').DataTable({
      destroy: true,
      pageLength: 100,
      order: [[5, 'asc']],
      ajax: {
        url: url,
        type: 'POST',
        data: function(d) {
          if (fecha) {
            d.fecha = fecha;
          }
        },
        dataSrc: 'data',
      },
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
      },
      columns: [
        {
          title: 'Batch',
          data: 0,
          className: 'uniqueClassName',
        },
        {
          title: 'Estado',
          data: 1,
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
          data: 2,
          className: 'uniqueClassName',
          // visible: false,
        },
        {
          title: 'Pedido',
          data: 3,
          className: 'uniqueClassName',
        },
        {
          title: 'Fecha Estimada Envasado',
          data: 4,
          className: 'uniqueClassName',
        },
        {
          title: 'Propietario',
          data: 5,
          className: 'uniqueClassName',
          visible: false,
        },
        {
          title: 'Descripción',
          data: 6,
          className: 'uniqueClassName',
        },
        {
          title: 'Ref',
          data: 0,
          className: 'uniqueClassName',
          render: function (data) {
            return `
              <a href="# "<i class="fa fa-superscript link-editarMulti" id="${data}" aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>`;
          },
        },
        {
          title: 'No Lote',
          data: 7,
          className: 'uniqueClassName',
        },
        {
          title: 'Unidades',
          data: 8,
          className: 'uniqueClassName',
          render: $.fn.dataTable.render.number('.', ',', 0, ''),
        },
        {
          title: 'Tamaño Lote(Kg)',
          data: 9,
          className: 'uniqueClassName',
          render: $.fn.dataTable.render.number('.', ',', 0, ''),
        },
      ],
    });
  };

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
