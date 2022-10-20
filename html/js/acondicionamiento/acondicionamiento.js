$(document).ready(function() {
    urlObs = '/api/observaciones';

    $('.adicionarMulti').hide();
    $('.footSaveMulti').hide();
    $('.addComment').hide();
    $('#saveObs').attr('style', 'display:none');

    $('#preparacionTable').dataTable({
        pageLength: 50,
        order: [
            [1, 'desc']
        ],
        ajax: {
            url: '/api/acondicionamiento',
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
                title: 'Ref',
                data: 'id_batch',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                      <a href="# "<i class="fa fa-superscript link-editarMulti" id="${data}" aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>`;
                },
            },
            {
                title: 'Unidades',
                data: 'unidad_lote',
                className: 'uniqueClassName',
                render: $.fn.dataTable.render.number('.', ',', 0, ''),
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
                title: 'Obs',
                data: null,
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <i class="badge badge-danger badge-pill notify-icon-badge ml-3">${data.cant_observations}</i><br>
                    <a href='#' <i class="fa fa-file-text fa-1x link-comentario" id="${data.id_batch}-${data.modulo}" aria-hidden="true" data-toggle="tooltip" title="adicionar observaciones" style="color:rgb(59, 131, 189)" aria-hidden="true"></i></a>
                  `;
                },
            },
            {
                title: 'Ingresar',
                className: 'uniqueClassName',
                data: '',
                render: (data, type, row) => {
                    'use strict';
                    return `<a href="acondicionamientoinfo/${row.id_batch}/${row.referencia}"><i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">exit_to_app</i></a>`;
                },
            },
        ],
    });
});