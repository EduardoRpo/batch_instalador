$(document).ready(function () {
    


tblOtros = $('#tblOtros').DataTable({
    destroy: true,
    scrollY: "50vh",
    scrollCollapse: true,
    paging: false,
    language: { url: "admin_componentes/es-ar.json" },

    ajax: {
        url: "/api/Others",
        dataSrc: ''
        
    },

    columns: [
        {
            data: "id",
            title: "Codigo"
        },
        { 
            data: "nombre",
            title: "Otros"
        },
        {
            title: 'Acciones',
            data: 'id',
            className: 'uniqueClassName',
            render: function(data) {
                return `<a href='#' <i id=${data} class='large material-icons link-editar5' style='color:rgb(255, 165, 0)'>edit</i></a>
                        <a href='#' <i id=${data} class='large material-icons link-borrar5' data-toggle='tooltip'  title='Eliminar' style='color:rgb(255, 0, 0)'>delete</i></a>`
            },
        
        },
    ],
});
});