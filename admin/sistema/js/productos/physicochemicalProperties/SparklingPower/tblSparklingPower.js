tblEspuma = $('#tblEspuma').DataTable({
    destroy: true,
    scrollY: "50vh",
    scrollCollapse: true,
    paging: false,
    language: { url: "admin_componentes/es-ar.json" },

    ajax: {
        url: "/api/SparkPower",
        dataSrc: ''
    },

    columns: [
        {
            title: 'No.',
            "data": null,
            className: 'uniqueClassName',
            "render": function(data, type, full, meta) {
                return meta.row + 1;
            }  
        },
        { 
            data: "nombre",
            title: "Poder Espumoso"
        },
        {
            title: 'Acciones',
            data: 'id',
            className: 'uniqueClassName',
            render: function(data) {
                return `<a href='#' <i id=${data} class='large material-icons link-editar9' style='color:rgb(255, 165, 0)'>edit</i></a>
                        <a href='#' <i id=${data} class='large material-icons link-borrar9' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>delete</i></a>`
            },
        
        },
    ],
});
