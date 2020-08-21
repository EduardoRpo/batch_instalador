/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link9').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir1').show();

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

function cargarDatosProductos() {
  var sel = [];
  var j = 0;
  var c = 5;

  $('#m_productos').modal('show');

  $('select').each(function () {
    sel.push($(this).prop('id'))
  })

  for (i = 1; i < sel.length; i++) {
    propiedad = sel[j];
    debugger;
    cargarselectores(propiedad, c);
    //c++;
    j++;
  }

}

function cargarselectores(selector, data) {
  debugger;
  $.ajax({
    method: 'POST',
    url: 'php/c_productos.php',
    data: { tabla: selector, operacion: data },

    success: function (response) {
      var info = JSON.parse(response);
      console.log(info);

      let $select = $(`#${selector}`);
      $select.empty();

      $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

      $.each(info.data, function (i, value) {
        $select.append('<option value ="' + i + '">' + value.nombre + '</option>');
      });
    },
    error: function (response) {
      console.log(response);
    }
  })
}