$(document).ready(function () {
  APISEL = '/api/multiref/';
  API = '/api/multi/';

  //Actualizar Multipresentacion

  $(document).on('click', '.link-editarMulti', function (e) {
    editar = true;
    id_batch = this.id;
    $('#insertarRefMulti').empty();

    ref = $(this).parent().parent().children().eq(3).text();

    if (ref == '' || !ref.includes('Granel'))
      ref = $(this).parent().parent().children().eq(2).text();

    multipresentacion();
  });

  multipresentacion = async () => {
    multi = await buscarDataMulti(`${APISEL}${ref}`);
    dataMulti = await buscarDataMulti(`${API}${id_batch}`);
    await adicionarMultipresentaciones(dataMulti.length);
    cargarMultipresentacion(dataMulti);
  };

  cargarMultipresentacion = async (dataMulti) => {
    $('#Modal_Multipresentacion').modal('show');
    let lote = 0;

    for (let i = 0; i < dataMulti.length; i++) {
      $(`#MultiReferencia${i + 1}`).val(dataMulti[i].referencia);
      $(`#cantidadMulti${i + 1}`).val(dataMulti[i].cantidad);
      $(`#tamanioloteMulti${i + 1}`).val(dataMulti[i].total.toFixed(2));
      $(`#densidadMulti${i + 1}`).val(dataMulti[i].densidad);
      $(`#presentacionMulti${i + 1}`).val(dataMulti[i].presentacion);
      lote = lote + dataMulti[i].total;
      $(`#sumaMulti`).val(lote);
    }
  };

  adicionarMultipresentaciones = (length) => {
    for (let i = 0; i < length; i++)
      $('#adicionarMultipresentacion').trigger('click');
  };

  buscarDataMulti = (urlApi) => {
    return searchData(urlApi);
  };
});
