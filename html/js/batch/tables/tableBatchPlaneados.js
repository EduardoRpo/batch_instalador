$(document).ready(function () {
  /* Capacidad Planeada */
  api = '/api/batchPlaneados';

  getDataPlaneacion = async () => {
    resp = await searchData(api);
    loadTblCapacidadPlaneada(resp);
  };

  getDataPlaneacion();

  loadTblCapacidadPlaneada = (data) => {
    semana = sessionStorage.getItem('semana');
    capacidadPlaneada = calcTamanioLoteBySemana(data, parseInt(semana));

    for (i = 0; i < 12; i++) {
      $('.tblCalcCapacidadPlaneadaBody').append(`
                <tr>
                    <td>${capacidadPlaneada[i].semana}</td>
                    <td>${capacidadPlaneada[i].tamanioLoteLQ.toFixed(2)}</td> 
                    <td>${capacidadPlaneada[i].tamanioLoteSL.toFixed(2)}</td>
                    <td>${capacidadPlaneada[i].tamanioLoteSM.toFixed(2)}</td>
                </tr>
            `);
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
    language: { url: '../../../admin/sistema/admin_componentes/es-ar.json' },
    oSearch: { bSmart: false },

    ajax: {
      url: '/api/batchPlaneados',
      dataSrc: '',
    },
    // order: [[1, 'desc']],
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
        title: 'N° Semana',
        data: 'semana',
        className: 'text-center',
        render: function (data) {
          return `S${data}`;
        },
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
      },
      {
        data: 'id',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-trash link-borrar-pre fa-2x' id="delete-${data}" data-toggle='tooltip' title='Eliminar Pre Planeado' style='color:rgb(234, 67, 54)'></i></a>`;
        },
      },
    ],
    rowGroup: {
      dataSrc: 'propietario',
      startRender: function (rows, group) {
        return $('<tr/>').append(
          '<th class="text-center" colspan="13" style="font-weight: bold;">' +
            group +
            '</th>'
        );
      },
      className: 'odd',
    },
  });

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
  setTimeout(loadTotalVentas, 11000);
});
