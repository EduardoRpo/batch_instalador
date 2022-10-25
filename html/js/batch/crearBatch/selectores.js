$(document).ready(function () {
  /* Llenar el selector de nombres referencias al crear Batch */

  cargarNombresReferencias = () => {
    $.ajax({
      url: '/api/productsGranel',

      success: function (resp) {
        products = resp;
        let $selectRef = $('#cmbNoReferencia');
        $('#cmbNoReferencia').empty();

        let $selectName = $('#nombrereferencia');
        $('#nombrereferencia').empty();

        $selectRef.append(`<option disabled selected>referencia</option>`);
        $selectName.append(
          `<option disabled selected>nombre_referencia</option>`
        );

        $.each(products, function (i, value) {
          $selectRef.append(
            `<option value="${value.referencia}">${value.referencia}</option>`
          );
          $selectName.append(
            `<option value="${value.referencia}">${value.nombre_referencia}</option>`
          );
        });

        $('#modalCrearBatch').modal('show');
        addtnq = 1;
      },
    });
  };

  /* Cargar tanques */

  cargarTanques = () => {
    $.ajax({
      type: 'POST',
      url: 'php/listarBatch.php',
      data: { operacion: '9' },
      success: function (r) {
        var info = JSON.parse(r);

        for (i = 1; i < 6; i++) {
          let $select = $('.select-tanque');
          $select.empty();

          $('#txtCantidad' + i).val(0);
          $('#txtTotal' + i).val(0);

          $select.append('<option disabled selected>Tanque</option>');
          $.each(info, function (i, value) {
            $select.append(
              `<option value =${value.capacidad}>${value.capacidad}</option>`
            );
          });
        }
      },
    });
  };

  /* Eliminar los tanques generados */

  limpiarTanques = () => {
    $('#sumaTanques').val(' ');

    for (i = 1; i < 6; i++) {
      $('#cmbTanque' + i).val('Tanque');
      $('#txtCantidad' + i).val('');
      $('#txtTotal' + i).val('');
    }
  };
});
