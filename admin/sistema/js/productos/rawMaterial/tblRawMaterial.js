tblMateriaPrima = $('#tblMateriaPrima').DataTable({
    destroy: true,
    scrollY: "50vh",
    scrollCollapse: true,
    paging: false,
    language: { url: "admin_componentes/es-ar.json" },

    ajax: {
        url: "/api/RawMaterial",
        dataSrc: ''
    },

    columns: [
        {
            data: "referencia",
            title: "Codigo"
        },
        { 
            data: "nombre",
            title: "Materia Prima"
        },
        {
            data: "alias",
            title: "alias"
        
        },
        {
            title: 'Acciones',
            data: 'referencia',
            className: 'uniqueClassName',
            render: function(data) {
                return `<a href='#' <i id=${data} class='large material-icons link-editar-mp' style='color:rgb(255, 165, 0)'>edit</i></a>
                        <a href='#' <i id=${data} class='large material-icons link-borrar-mp' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>delete</i></a>`
            },
        
        },
    ],
});