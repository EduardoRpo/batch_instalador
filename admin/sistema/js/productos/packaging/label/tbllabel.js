tblEtiqueta = $('#tblEtiqueta').DataTable({
    destroy: true,
    scrollY: "50vh",
    scrollCollapse: true,
    paging: false,
    language: { url: "admin_componentes/es-ar.json" },

    ajax: {
        url: "/api/Label",
        dataSrc: ''
    },

    columns: [{
            title: "Codigo",
            data: "id"
        },
        {
            title: "Etiquetas",
            data: "nombre"
        },
        {
            title: 'Acciones',
            data: 'id',
            className: 'uniqueClassName',
            render: function(data) {
                return `<a href='#' <i id=${data} class='large material-icons link-editar3' style='color:rgb(255, 165, 0)'>edit</i></a>
                        <a href='#' <i id=${data} class='large material-icons link-borrar3' data-toggle='tooltip'  title='Eliminar' style='color:rgb(255, 0, 0)'>delete</i></a>`
            },

        },
    ],
});