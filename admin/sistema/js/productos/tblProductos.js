//Cargue de tablas de Productos

$(document).ready(function() {
    tblProductos = $("#tblProductos").DataTable({
        pageLength: 100,
        language: { url: "admin_componentes/es-ar.json" },

        ajax: {
            url: "/api/getproducts",
            dataSrc: '',
        },

        columns: [{
                title: 'No.',
                data: null,
                className: 'uniqueClassName',
                render: function(data, type, full, meta) {
                    return meta.row + 1;
                },
            },
            {
                title: 'Acciones',
                data: 'referencia',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href='#' <i id="${data}" class='large material-icons link-editar' data-toggle='tooltip' title='Editar' style='color:rgb(255, 165, 0)'>edit</i></a> 
                    <a href='#' <i id="${data}" class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>`;
                },
            },
            { title: 'Referencia', data: "referencia" },
            { title: 'Nombre', data: "nombre_referencia" },
            { title: 'Presentación', data: "presentacion_comercial", className: "centrado" },
            { title: 'Producto', data: "id_nombre_producto", className: "centrado" },
            { title: 'Notificación', data: "id_notificacion_sanitaria", className: "centrado" },
            { title: 'Linea', data: "id_linea", className: "centrado" },
            { title: 'Densidad', data: "densidad_producto", className: "centrado" },
            { title: 'Marca', data: "id_marca", className: "centrado" },
            { title: 'Propietario', data: "id_propietario", className: "centrado" },
            { title: 'Empaque', data: "unidad_empaque", className: "centrado" },
            { title: 'Color', data: "id_color", className: "centrado" },
            { title: 'Olor', data: "id_olor", className: "centrado" },
            { title: 'Apariencia', data: "id_apariencia", className: "centrado" },
            { title: 'Untuosidad', data: "id_untuosidad", className: "centrado" },
            { title: 'Espumoso', data: "id_poder_espumoso", className: "centrado" },
            { title: 'Mesofilos', data: "id_recuento_mesofilos", className: "centrado" },
            { title: 'Pseudomona', data: "id_pseudomona", className: "centrado" },
            { title: 'Escherichia', data: "id_escherichia", className: "centrado" },
            { title: 'Staphylococcus', data: "id_staphylococcus", className: "centrado" },
            { title: 'PH', data: "id_ph", className: "centrado" },
            { title: 'Viscosidad', data: "id_viscosidad", className: "centrado" },
            { title: 'Gravedad', data: "id_densidad_gravedad", className: "centrado" },
            { title: 'Alcohol', data: "id_grado_alcohol", className: "centrado" },
            { title: 'Envase', data: "id_envase", className: "centrado" },
            { title: 'Tapa', data: "id_tapa", className: "centrado" },
            { title: 'Etiqueta', data: "id_etiqueta", className: "centrado" },
            { title: 'Empaque', data: "id_empaque", className: "centrado" },
            { title: 'Otros', data: "id_otros", className: "centrado" },
            { title: 'Instructivo Base', data: "base_instructivo", className: "centrado" },
            { title: 'Instructivo personalizado', data: "instructivo", className: "centrado" },
        ],

        columnDefs: [{ width: "10%", targets: 1 }],
    });
});