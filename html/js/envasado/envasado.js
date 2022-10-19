$('#tablaEnvasado').dataTable({
    pageLength: 50,
    order: [
        [1, 'desc']
    ],
    ajax: {
        url: '/api/envasado',
        dataSrc: '',
    },
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [{
            title: 'Batch',
            data: 'id_batch',
            className: 'uniqueClassName',
        },
        {
            width: '20%',
            title: 'Fecha Programación',
            data: 'programacion_envasado',
            className: 'uniqueClassName',
            render: function(data) {
                date = new Date(data);
                year = date.getFullYear();

                month = `${date.getMonth() + 1}`.padStart(2, 0);

                day = `${date.getDate()}`.padStart(2, 0);

                hour = date.toLocaleTimeString(undefined, {
                    hour: '2-digit',
                    minute: '2-digit',
                });

                stringDate = `${[year, month, day].join('-')} ${hour}`;

                return stringDate;
            },
        },
        /* {
          title: 'No de Orden',
          data: 'numero_orden',
          className: 'uniqueClassName',
        }, */
        {
            title: 'Referencia',
            data: 'referencia',
            className: 'uniqueClassName',
        },
        {
            width: '400px',
            title: 'Nombre Referencia',
            data: 'nombre_referencia',
            className: 'uniqueClassName',
        },
        {
            title: 'Unidades',
            data: 'unidad_lote',
            className: 'uniqueClassName',
        },
        {
            title: 'No Lote',
            data: 'numero_lote',
            className: 'uniqueClassName',
        },
        {
            title: 'Firmas G',
            data: 'cantidad_firmas',
            className: 'uniqueClassName',
        },
        {
            title: 'Firmas T',
            data: 'total_firmas',
            className: 'uniqueClassName',
        },
        {
            title: 'Ingresar',
            className: 'uniqueClassName',
            data: '',
            render: (data, type, row) => {
                'use strict';
                return `<a href="envasadoinfo/${row.id_batch}/${row.referencia}"><i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">touch_app</i></a>`;
            },
        },
    ],
});