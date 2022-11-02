$(document).ready(function () {
  loadTblCapacidadPrePlaneada = () => {
    // capacidadPrePlaneada = calcTamanioLoteBySemana(data, parseInt(semana));

    semana = sessionStorage.getItem('semana');

    for (i = 0; i < 12; i++) {
      $('.tblCalcCapacidadPrePlaneadoBody').append(`
          <tr>
            <td>${parseInt(semana) + i}</td>
            <td>0</td> 
            <td>0</td>
            <td>0</td>
          </tr>
        `);
    }

    $('#tblCalcCapacidadPrePlaneado').dataTable({
      scrollY: '130px',
      scrollCollapse: true,
      paging: false,
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
      },
    });
  };
  loadTblCapacidadPrePlaneada();

  /* calcTamanioLoteBySemana = (data, semana) => {
    let capacidadPrePlaneada = [];

    data.forEach((t) => {
      let repeat = false;
      for (i = 0; i < capacidadPrePlaneada.length; i++) {
        if (capacidadPrePlaneada[i].semana == t.semana) {
          if (capacidadPrePlaneada[i].linea == 1)
            capacidadPrePlaneada[i].tamanioLoteLQ += t.tamano_lote;
          else if (capacidadPrePlaneada[i].linea == 2)
            capacidadPrePlaneada[i].tamanioLoteSM += t.tamano_lote;
          else if (capacidadPrePlaneada[i].linea == 3)
            capacidadPrePlaneada[i].tamanioLoteSL += t.tamano_lote;

          repeat = true;
        }
      }
      if (repeat == false) {
        if (t.id_linea == 1)
          capacidadPrePlaneada.push({
            semana: t.semana,
            linea: t.id_linea,
            tamanioLoteLQ: t.tamano_lote,
            tamanioLoteSM: 0,
            tamanioLoteSL: 0,
          });
        else if (t.id_linea == 2)
          capacidadPrePlaneada.push({
            semana: t.semana,
            linea: t.id_linea,
            tamanioLoteLQ: 0,
            tamanioLoteSM: t.tamano_lote,
            tamanioLoteSL: 0,
          });
        else if (t.id_linea == 1)
          capacidadPrePlaneada.push({
            semana: t.semana,
            linea: t.id_linea,
            tamanioLoteLQ: 0,
            tamanioLoteSM: 0,
            tamanioLoteSL: t.tamano_lote,
          });
      }
    });

    dataCapacidadPrePlaneada = [];

    capacidadPrePlaneada.length < 12
      ? (count = capacidadPrePlaneada.length)
      : (count = 12);

    if (capacidadPrePlaneada[0].semana > semana) {
      dataCapacidadPrePlaneada.push({
        semana: semana ,
        tamanioLoteLQ: 0,
        tamanioLoteSM: 0,
        tamanioLoteSL: 0,
      });
      dataCapacidadPrePlaneada.push({
        semana: capacidadPrePlaneada[0].semana,
        tamanioLoteLQ: capacidadPrePlaneada[].tamanioLoteLQ,
        tamanioLoteSM: capacidadPrePlaneada[i].tamanioLoteSM,
        tamanioLoteSL: capacidadPrePlaneada[i].tamanioLoteSL,
      });
    }

    return capacidadPrePlaneada;
  };*/

  tableBatchPrePlaneacion = $('#tablaPrePlaneacion').DataTable({
    destroy: true,
    pageLength: 50,
    ajax: {
      url: `/api/prePlaneados`,
      dataSrc: '',
    },
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [
      {
        title: 'N° Semana',
        data: 'semana',
        className: 'text-center',
        render: function (data) {
          return `S ${data}`;
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
        width: '500px',
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
        title: 'Estado',
        data: 'estado',
        className: 'text-center',
      },
      {
        title: 'Modificar',
        data: 'id',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-pencil-square-o fa-2x link-editar-pre' id="edit-${data}" data-toggle='tooltip' title='Editar Pre Planeado' style='color:rgb(255, 193, 7)'></i></a>`;
        },
      },
      {
        title: 'Eliminar',
        data: 'id',
        className: 'uniqueClassName',
        render: function (data) {
          return `<a href='#' <i class='fa fa-trash link-borrar-pre fa-2x' id="borrar-${data}" data-toggle='tooltip' title='Eliminar Pre Planeado' style='color:rgb(234, 67, 54)'></i></a>`;
        },
      },
    ],
    rowGroup: {
      dataSrc: 'propietario',
      startRender: function (rows, group) {
        return $('<tr/>').append(
          '<th class="text-center" colspan="11" style="font-weight: bold;">' +
            group +
            '</th>'
        );
      },
      className: 'odd',
    },
  });

  /* Cargar tipo de simulación */

  $('#tipoSimulacion').change(function (e) {
    e.preventDefault();

    let val = this.value;

    let totalVentaPre = 0;

    tableBatchPrePlaneacion.column(8).search(val).draw();

    dataBPreplaneacion = tableBatchPrePlaneacion.rows().data().toArray();

    for (i = 0; i < dataBPreplaneacion.length; i++) {
      if (dataBPreplaneacion[i]['sim'] == val) {
        totalVentaPre =
          totalVentaPre +
          dataBPreplaneacion[i]['unidad_lote'] *
            dataBPreplaneacion[i]['valor_pedido'];
      }
    }

    $('#totalVentaPre').val(`$ ${totalVentaPre.toLocaleString('es-CO')}`);

    semana = sessionStorage.getItem('semana');

    val == 1 ? (semana = parseInt(semana)) : (semana = parseInt(semana) + 1);

    month = calcDateByWeek(semana);

    $('.fechaTipoEscenario').html(`
      <div class="col">
        <label style="margin-top:37px">S${semana} (${month})</label>
      </div>
    `);
  });

  /* Calcular primera y ultima fecha de la semana */
  calcDateByWeek = (semana) => {
    let date = new Date();

    let primerdia = new Date(date.getFullYear(), 0, 1);

    let correccion = 6 - primerdia.getDay();

    let primer = new Date(
      date.getFullYear(),
      0,
      (semana - 1) * 7 + 3 + correccion
    );

    let ultimo = new Date(
      date.getFullYear(),
      0,
      (semana - 1) * 7 + 9 + correccion
    );

    let mesPrimer = primer.toLocaleString(undefined, { month: 'long' });
    let mesUltimo = ultimo.toLocaleString(undefined, { month: 'long' });

    month = `${primer.getDate()} ${mesPrimer} - ${ultimo.getDate()} ${mesUltimo}`;

    return month;
  };
});
