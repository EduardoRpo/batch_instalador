$(document).ready(function () {
  /* Adicionar referencia para crear multipresentacion en un batch*/

  $('#adicionarMultipresentacion').on('click', function () {
    objetos = $('.multi').length;
    !objetos ? (index = 1) : index++;
    createMulti(index);
  });

  /* Crear objetos multi */
  createMulti = (index) => {
    $('.insertarRefMulti').empty();

    if (index < 5) {
      $('.insertarRefMulti').append(
        `<select class="form-control multi" name="MultiReferencia" id="MultiReferencia${index}" onchange="cargarReferenciaM(${index});"></select>
            <input type="text" class="form-control text-center" id="cantidadMulti${index}" name="cantidadMulti" onkeyup="CalculoloteMulti(${index});">
            <input type="text" class="form-control text-center" id="tamanioloteMulti${index}" name="tamanioloteMulti" readonly placeholder="Lote">
            <input type="text" class="form-control" id="densidadMulti${index}" name="densidadMulti" placeholder="Densidad" hidden>
            <input type="text" class="form-control" id="presentacionMulti${index}" name="presentacionMulti" placeholder="Presentación" hidden>
            <button class="btn btn-warning btneliminarMulti${index}" onclick="eliminarMulti(${index});" type="button">X</button>`
      );
      cargarSelectMulti(multi);
    }
  };

  //Cargar Select Referencias con Multipresentacion

  cargarSelectMulti = (multi) => {
    let $select = $(`#MultiReferencia${index}`);

    $select.empty();
    // $select.append('<option disabled selected>Multipresentación</option>');

    $.each(multi, function (i, value) {
      $select.append(
        `<option value="${value.referencia}">${value.referencia} - ${value.nombre}</option>`
      );
    });
  };

  //cargar datos de acuerdo con la seleccion de multipresentacion

  cargarReferenciaM = (id) => {
    const referencia = $(`#MultiReferencia${id}`).val();
    const resultado = multi.find((obj) => obj.referencia === referencia);

    $(`#presentacionMulti${id}`).val(resultado.presentacion);
    $(`#densidadMulti${id}`).val(resultado.densidad);
    CalculoloteMulti(id);
  };
});
