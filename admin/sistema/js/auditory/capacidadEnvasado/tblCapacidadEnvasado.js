$(document).ready(function() {
    /*$.ajax({
      url: '/api/capacidadEnvasado',
      success: function (resp) {
        loadTblEnvasado(resp);
      },
    });

    loadTblEnvasado = (data) => {
      // $('#LQturno1').html(data[0]['turno_1']);
      // $('#LQturno2').html(data[0]['turno_2']);
      // $('#LQturno3').html(data[0]['turno_3']);
      // $('#Sturno1').html(data[1]['turno_1']);
      // $('#Sturno2').html(data[1]['turno_2']);
      // $('#Sturno3').html(data[1]['turno_3']);
      // $('#SMturno1').html(data[2]['turno_1']);
      // $('#SMturno2').html(data[2]['turno_2']);
      // $('#SMturno3').html(data[2]['turno_3']);

      // document.getElementById('delete').setAttribute('id', data);
    }*/

    tblCapacidadEnvasado = $('#tblCapacidadEnvasado').DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        ajax: {
            url: '/api/capacidadEnvasado',
            dataSrc: '',
        },

        columns: [{
                title: 'No.',
                data: null,
                className: 'text-center',
                render: function(data, type, full, meta) {
                    return meta.row + 1;
                },
            },
            {
                title: 'Linea',
                data: 'nombre',
            },
            {
                title: 'Turno 1',
                data: 'turno_1',
                className: 'text-center',
                render: $.fn.dataTable.render.number('.', ',', 0, ''),
            },
            {
                title: 'Turno 2',
                data: 'turno_2',
                className: 'text-center',
                render: $.fn.dataTable.render.number('.', ',', 0, ''),
            },
            {
                title: 'Turno 3',
                data: 'turno_3',
                className: 'text-center',
                render: $.fn.dataTable.render.number('.', ',', 0, ''),
            },
            {
                title: 'Acciones',
                data: 'id_capacidad_envasado',
                className: 'text-center',
                render: function(data) {
                    return `<a href='#' <i id=${data} class='updateEnv material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a> `;
                },
            },
        ],
    });
});