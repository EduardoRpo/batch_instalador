//Cargue de tablas de Productos

$(document).ready(function () {

  $('#listarProductos').DataTable({
    scrollY: '50vh',
    scrollCollapse: true,
    paging: false,
    language: { url: 'admin_componentes/es-ar.json' },

    "ajax": {
      "method": "POST",
      "url": "php/listarProductos.php",
    },

    "columns": [
      { "defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
      { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" },
      { "data": "referencia" },
      { "data": "nombre_referencia" },
      { "data": "unidad_empaque" },
      { "data": "producto" },
      { "data": "notificacion" },
      { "data": "linea" },
      /* {"defaultContent": "<a href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a>"}, */
      
    ]
  });
});