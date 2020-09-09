/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link9').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir1').show();

cargarDatosProductos();

//Cargue de tablas de Productos

$(document).ready(function () {

  $('#tblProductos').DataTable({
    scrollY: '45vh',
    scrollCollapse: true,
    paging: false,
    language: { url: 'admin_componentes/es-ar.json' },

    "ajax": {
      method: "POST",
      url: "php/c_productos.php",
      data: { operacion: 1 },
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
      { "data": "marca" },
      { "data": "propietario" },
      { "data": "presentacion" },
      { "data": "color" },
      { "data": "olor" },
      { "data": "apariencia" },
      { "data": "untuosidad" },
      { "data": "poder_espumoso" },
      { "data": "recuento_mesofilos" },
      { "data": "pseudomona" },
      { "data": "escherichia" },
      { "data": "staphylococcus" },
      { "data": "ph" },
      { "data": "viscosidad" },
      { "data": "densidad" },
      { "data": "alcohol" },
    ]
  });
});

/* Cargar Modal para actualizar y Crear productos */

function cargarModalProductos() {
  $('#m_productos').modal('show');
}

/* Cargar selectores y data */

function cargarDatosProductos() {
  let sel = [];
  let j = 0;

  $('select').each(function () {
    sel.push($(this).prop('id'))
  })

  for (i = 1; i <= sel.length; i++) {
    propiedad = sel[j];
    cargarselectores(propiedad);
    j++;
  }
}

function cargarselectores(selector) {

  $.ajax({
    method: 'POST',
    url: 'php/c_productos.php',
    data: { tabla: selector, operacion: 4 },

    success: function (response) {
      var info = JSON.parse(response);

      let $select = $(`#${selector}`);
      $select.empty();

      $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

      $.each(info.data, function (i, value) {
        $select.append('<option value ="' + value.id + '">' + value.nombre + '</option>');
      });
    },
    error: function (response) {
      console.log(response);
    }
  })
}

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
  let j = 1;
  let producto = [];

  $('#m_productos').modal('show');

  for (let i = 2; i < 23; i++) {
    propiedad = $(this).parent().parent().children().eq(i).text();
    producto.push(propiedad);
  }

  for (let i = 0; i <= 2; i++) {
    $(`.n${j}`).val(producto[i]);
    j++;
  }

  for (let i = 3; i < 23; i++) {
    $(`.n${j} option:contains(${producto[i]})`).attr('selected', true);
    j++;
  }
});

/* Eliminar registros */

$(document).on('click', '.link-borrar', function (e) {

  let id = $(this).parent().parent().children().eq(2).text();

  $.ajax({
    type: "POST",
    url: "php/c_productos.php",
    data: { operacion: 2, id: id },

    success: function (response) {
      alertify.set("notifier", "position", "top-right"); alertify.success("Registro Eliminado.");
      refreshTable();
    },

    error: function (response) {
      alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
    }
  })
});

$(document).on('click', '#btnguardarProductos', function (e) {
  e.preventDefault();

  const producto = new FormData($('#frmagregarProductos')[0]);
  producto.set('operacion', 3);

  $.ajax({
    type: "POST",
    url: "php/c_productos.php",
    data: producto,
    processData: false,
    contentType: false,

    success: function (response) {
      debugger;
      if (response == 1) {
        alertify.set("notifier", "position", "top-right"); alertify.success("Datos almacenados.");
        refreshTable();
      }
      else if (response == 2) {
        alertify.set("notifier", "position", "top-right"); alertify.success("El producto ya se encuentra registrado.");
        return false;
      }
      $('#m_productos').modal('hide');
    },
    error: function (response) {
      alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
    }
  })
});


/* Actualizar tabla */

function refreshTable() {
  $('#tblProductos').DataTable().clear();
  $('#tblProductos').DataTable().ajax.reload();
}