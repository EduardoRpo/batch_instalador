tblNombreProductos = $('#tblnombreProductos').dataTable({
    pageLength: 50,
    ajax: {
        url: '/api/nameProducts',
        dataSrc: '',
    },
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [{
            title: 'No.',
            "data": null,
            className: 'uniqueClassName',
            "render": function(data, type, full, meta) {
                return meta.row + 1;
            }
        },
        {
            title: 'Nombre Producto',
            data: 'nombre',
            className: 'uniqueClassName',
        },
        {
            title: 'Acciones',
            data: 'id',
            className: 'Text-center',
            render: function(data) {
                return `<a href='#' <i id=${data} class='large material-icons link-editar1' style='color:rgb(255, 165, 0)'>edit</i></a>
                        <a href='#' <i id=${data} class='large material-icons link-borrar1' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>delete</i></a>`
            },
        },
    ],
})