/* Consultar referencias */
let refs;

const referenciasGranel = () => {
  $.ajax({
    url: '/api/granel',
    success: function (info) {
      let $selectProductos = $('#cmbReferenciaProductos');
      refs = info;
      cargarSelect(info, $selectProductos);
    },
    error: function (response) {
      console.log(response);
    },
  });
};

const granelNoFormulas = () => {
  $.ajax({
    url: '/api/granelNoFormula',
    success: function (info) {
      let $selectProductos = $('#cmbReferenciaProductos');
      refs = Object.values(info);
      cargarSelect(info, $selectProductos);
    },
    error: function (response) {
      console.log(response);
    },
  });
};

/* Cargue select referencias */

const cargarSelect = (data, select) => {
  select.empty();
  select.append(`<option disabled selected>Seleccione</option>`);

  if (data.superUsuario == 1) select.append(`<option value="1">Todos</option>`);

  $.each(data, function (i, value) {
    select.append(
      `<option value ="${value.referencia}">${value.referencia}</option>`
    );
  });
};

/* Seleccionar referencia cargar Nombre */

$('#cmbReferenciaProductos').change(function (e) {
  e.preventDefault();
  let referencia = $('select option:selected').val();

  if (referencia.includes('Granel')) {
    const resultado = refs.find((refer) => refer.referencia === referencia);

    $('#txtnombreProducto').val('');
    $('#txtnombreProducto').val(resultado.nombre_referencia);
  }
});
